<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    if ($action === 'save') {
        $id          = (int)($_POST['id'] ?? 0);
        $title       = trim($_POST['title'] ?? '');
        $category    = trim($_POST['category'] ?? '');
        $linkUrl     = trim($_POST['link_url'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $sortOrder   = (int)($_POST['sort_order'] ?? 0);
        $isActive    = isset($_POST['is_active']) ? 1 : 0;

        // 썸네일 업로드
        $thumbnail = trim($_POST['current_thumbnail'] ?? '');
        if (!empty($_FILES['thumbnail']['name'])) {
            try {
                $thumbnail = upload_image($_FILES['thumbnail'], 'portfolio');
            } catch (RuntimeException $e) {
                // 에러는 무시하고 기존 이미지 유지
            }
        }

        if ($id) {
            $pdo->prepare('
                UPDATE portfolios SET title=?, category=?, thumbnail=?, link_url=?, description=?, sort_order=?, is_active=?
                WHERE id=?
            ')->execute([$title, $category, $thumbnail, $linkUrl, $description, $sortOrder, $isActive, $id]);
        } else {
            $pdo->prepare('
                INSERT INTO portfolios (title, category, thumbnail, link_url, description, sort_order, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ')->execute([$title, $category, $thumbnail, $linkUrl, $description, $sortOrder, $isActive]);
        }
        header('Location: /admin/portfolio-admin.php');
        exit;

    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $pdo->prepare('DELETE FROM portfolios WHERE id=?')->execute([$id]);
        header('Location: /admin/portfolio-admin.php');
        exit;
    }
}

$portfolios = $pdo->query('SELECT * FROM portfolios ORDER BY sort_order ASC, created_at DESC')->fetchAll();

// 편집 대상
$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM portfolios WHERE id=?');
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch();
}
$categories = ['웹기획', '웹디자인', '웹개발'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>포트폴리오 관리 | 삼마디자인 관리자</title>
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
        <li class="active"><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header">
      <h1>포트폴리오 관리</h1>
      <a href="?edit=0" class="btn btn--primary btn--sm">+ 새 항목 추가</a>
    </div>

    <?php if (isset($_GET['edit'])): ?>
    <!-- 추가/편집 폼 -->
    <div class="admin-section">
      <h2><?php echo $edit ? '포트폴리오 수정' : '새 포트폴리오 추가'; ?></h2>
      <form method="post" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?php echo (int)($edit['id'] ?? 0); ?>">
        <input type="hidden" name="current_thumbnail" value="<?php echo h($edit['thumbnail'] ?? ''); ?>">

        <div class="form-group">
          <label>제목 *</label>
          <input type="text" name="title" value="<?php echo h($edit['title'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
          <label>카테고리 *</label>
          <select name="category" required>
            <?php foreach ($categories as $cat): ?>
            <option value="<?php echo h($cat); ?>" <?php echo ($edit['category'] ?? '') === $cat ? 'selected' : ''; ?>><?php echo h($cat); ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label>썸네일 이미지</label>
          <?php if (!empty($edit['thumbnail'])): ?>
          <img src="<?php echo h($edit['thumbnail']); ?>" style="max-width:200px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="thumbnail" accept="image/*">
        </div>
        <div class="form-group">
          <label>링크 URL</label>
          <input type="url" name="link_url" value="<?php echo h($edit['link_url'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>설명</label>
          <textarea name="description" rows="3"><?php echo h($edit['description'] ?? ''); ?></textarea>
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>정렬 순서</label>
            <input type="number" name="sort_order" value="<?php echo (int)($edit['sort_order'] ?? 0); ?>">
          </div>
          <div class="form-group">
            <label class="checkbox-label">
              <input type="checkbox" name="is_active" <?php echo ($edit['is_active'] ?? 1) ? 'checked' : ''; ?>>
              공개
            </label>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn--primary">저장</button>
          <a href="/admin/portfolio-admin.php" class="btn">취소</a>
        </div>
      </form>
    </div>
    <?php endif; ?>

    <!-- 목록 -->
    <div class="admin-section">
      <table class="admin-table">
        <thead>
          <tr><th>썸네일</th><th>제목</th><th>카테고리</th><th>공개</th><th>관리</th></tr>
        </thead>
        <tbody>
          <?php if (empty($portfolios)): ?>
          <tr><td colspan="5" class="empty">등록된 포트폴리오가 없습니다.</td></tr>
          <?php else: ?>
          <?php foreach ($portfolios as $p): ?>
          <tr>
            <td><?php if ($p['thumbnail']): ?><img src="<?php echo h($p['thumbnail']); ?>" style="width:60px; height:40px; object-fit:cover;"><?php endif; ?></td>
            <td><?php echo h($p['title']); ?></td>
            <td><?php echo h($p['category']); ?></td>
            <td><?php echo $p['is_active'] ? '✅' : '❌'; ?></td>
            <td>
              <a href="?edit=<?php echo (int)$p['id']; ?>" class="btn btn--sm">수정</a>
              <form method="post" style="display:inline" onsubmit="return confirm('삭제하시겠습니까?');">
                <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$p['id']; ?>">
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
