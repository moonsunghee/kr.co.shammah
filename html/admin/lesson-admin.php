<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id         = (int)($_POST['id'] ?? 0);
        $title      = trim($_POST['title'] ?? '');
        $category   = trim($_POST['category'] ?? '');
        $hours      = trim($_POST['hours'] ?? '');
        $figmaLevel = trim($_POST['figma_level'] ?? '');
        $price      = (int)($_POST['price'] ?? 0);
        $sortOrder  = (int)($_POST['sort_order'] ?? 0);
        $isActive   = isset($_POST['is_active']) ? 1 : 0;

        // subjects: textarea 한 줄씩 → JSON
        $subjectsRaw = trim($_POST['subjects'] ?? '');
        $subjects = array_filter(array_map('trim', explode("\n", $subjectsRaw)));
        $subjectsJson = json_encode(array_values($subjects), JSON_UNESCAPED_UNICODE);

        $thumbnail = trim($_POST['current_thumbnail'] ?? '');
        if (!empty($_FILES['thumbnail']['name'])) {
            try { $thumbnail = upload_image($_FILES['thumbnail'], 'lesson'); } catch (RuntimeException $e) {}
        }

        if ($id) {
            $pdo->prepare('
                UPDATE lessons SET title=?, category=?, subjects=?, hours=?, figma_level=?, thumbnail=?, price=?, sort_order=?, is_active=?
                WHERE id=?
            ')->execute([$title, $category, $subjectsJson, $hours, $figmaLevel, $thumbnail, $price, $sortOrder, $isActive, $id]);
        } else {
            $pdo->prepare('
                INSERT INTO lessons (title, category, subjects, hours, figma_level, thumbnail, price, sort_order, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
            ')->execute([$title, $category, $subjectsJson, $hours, $figmaLevel, $thumbnail, $price, $sortOrder, $isActive]);
        }
        header('Location: /admin/lesson-admin.php');
        exit;

    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $pdo->prepare('DELETE FROM lessons WHERE id=?')->execute([$id]);
        header('Location: /admin/lesson-admin.php');
        exit;
    }
}

$lessons = $pdo->query('SELECT * FROM lessons ORDER BY sort_order ASC, created_at DESC')->fetchAll();

$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM lessons WHERE id=?');
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}

$lessonCategories = ['디자인 방법론', 'UX UI 제작/조작', 'HTML/CSS', 'JavaScript/jQuery', 'JavaScript/React', '파이썬', '업무효율/보조'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>교육 관리 | 삼마디자인 관리자</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-page">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li><a href="/admin/">대시보드</a></li>
        <li><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li class="active"><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header">
      <h1>교육 강좌 관리</h1>
      <a href="?edit=0" class="btn btn--primary btn--sm">+ 강좌 추가</a>
    </div>

    <?php if (isset($_GET['edit'])): ?>
    <div class="admin-section">
      <h2><?php echo $edit ? '강좌 수정' : '강좌 추가'; ?></h2>
      <form method="post" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?php echo (int)($edit['id'] ?? 0); ?>">
        <input type="hidden" name="current_thumbnail" value="<?php echo h($edit['thumbnail'] ?? ''); ?>">

        <div class="form-group">
          <label>강좌명 *</label>
          <input type="text" name="title" value="<?php echo h($edit['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
          <label>카테고리 *</label>
          <select name="category">
            <?php foreach ($lessonCategories as $cat): ?>
            <option value="<?php echo h($cat); ?>" <?php echo ($edit['category'] ?? '') === $cat ? 'selected' : ''; ?>><?php echo h($cat); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>과목 목록 (한 줄에 하나씩)</label>
          <textarea name="subjects" rows="5" placeholder="과목1&#10;과목2&#10;과목3"><?php
            if ($edit) {
                $subs = json_decode($edit['subjects'], true) ?? [];
                echo h(implode("\n", $subs));
            }
          ?></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>시간</label>
            <input type="text" name="hours" value="<?php echo h($edit['hours'] ?? ''); ?>" placeholder="예: 20시간">
          </div>
          <div class="form-group">
            <label>Figma 등급</label>
            <input type="text" name="figma_level" value="<?php echo h($edit['figma_level'] ?? ''); ?>" placeholder="예: Beginner">
          </div>
          <div class="form-group">
            <label>수강료 (원)</label>
            <input type="number" name="price" value="<?php echo (int)($edit['price'] ?? 0); ?>">
          </div>
        </div>
        <div class="form-group">
          <label>썸네일 이미지</label>
          <?php if (!empty($edit['thumbnail'])): ?>
          <img src="<?php echo h($edit['thumbnail']); ?>" style="max-width:200px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="thumbnail" accept="image/*">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>정렬 순서</label>
            <input type="number" name="sort_order" value="<?php echo (int)($edit['sort_order'] ?? 0); ?>">
          </div>
          <div class="form-group">
            <label class="checkbox-label">
              <input type="checkbox" name="is_active" <?php echo ($edit['is_active'] ?? 1) ? 'checked' : ''; ?>> 공개
            </label>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn--primary">저장</button>
          <a href="/admin/lesson-admin.php" class="btn">취소</a>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <div class="admin-section">
      <table class="admin-table">
        <thead>
          <tr><th>썸네일</th><th>강좌명</th><th>카테고리</th><th>시간</th><th>공개</th><th>관리</th></tr>
        </thead>
        <tbody>
          <?php if (empty($lessons)): ?>
          <tr><td colspan="6" class="empty">등록된 강좌가 없습니다.</td></tr>
          <?php else: ?>
          <?php foreach ($lessons as $l): ?>
          <tr>
            <td><?php if ($l['thumbnail']): ?><img src="<?php echo h($l['thumbnail']); ?>" style="width:60px; height:40px; object-fit:cover;"><?php endif; ?></td>
            <td><?php echo h($l['title']); ?></td>
            <td><?php echo h($l['category']); ?></td>
            <td><?php echo h($l['hours']); ?></td>
            <td><?php echo $l['is_active'] ? '✅' : '❌'; ?></td>
            <td>
              <a href="?edit=<?php echo (int)$l['id']; ?>" class="btn btn--sm">수정</a>
              <form method="post" style="display:inline" onsubmit="return confirm('삭제하시겠습니까?');">
                <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$l['id']; ?>">
                <button type="submit" class="btn btn--sm btn--danger">삭제</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </main>
</div>
</body>
</html>
