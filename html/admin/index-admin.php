<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

$message = '';

// 콘텐츠 저장
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $fields = [
        'index_hero_title', 'index_hero_sub', 'index_hero_image',
        'index_about_title', 'index_about_text', 'index_about_image',
    ];

    // 이미지 업로드 처리
    foreach (['index_hero_image' => 'banner', 'index_about_image' => 'banner'] as $key => $dir) {
        if (!empty($_FILES[$key]['name'])) {
            try {
                $_POST[$key] = upload_image($_FILES[$key], $dir);
            } catch (RuntimeException $e) {
                // 업로드 실패 시 기존 값 유지
            }
        }
    }

    $stmt = $pdo->prepare('
        INSERT INTO site_contents (page_key, content_val)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE content_val = VALUES(content_val)
    ');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            $stmt->execute([$field, $_POST[$field]]);
        }
    }
    $message = '저장되었습니다.';
}

// 현재 콘텐츠 조회
$contents = [];
$keys = ['index_hero_title','index_hero_sub','index_hero_image','index_about_title','index_about_text','index_about_image'];
$placeholders = implode(',', array_fill(0, count($keys), '?'));
$stmt = $pdo->prepare("SELECT page_key, content_val FROM site_contents WHERE page_key IN ($placeholders)");
$stmt->execute($keys);
foreach ($stmt->fetchAll() as $row) {
    $contents[$row['page_key']] = $row['content_val'];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>인덱스 관리 | 삼마디자인 관리자</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-page">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li><a href="/admin/">대시보드</a></li>
        <li class="active"><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header"><h1>인덱스 페이지 관리</h1></div>

    <?php if ($message): ?>
    <div class="alert alert--success"><?php echo h($message); ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="admin-form">
      <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">

      <div class="admin-section">
        <h2>Hero 섹션</h2>
        <div class="form-group">
          <label>헤드라인 텍스트</label>
          <input type="text" name="index_hero_title" value="<?php echo h($contents['index_hero_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_hero_sub" value="<?php echo h($contents['index_hero_sub'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>배경 이미지</label>
          <?php if (!empty($contents['index_hero_image'])): ?>
          <img src="<?php echo h($contents['index_hero_image']); ?>" style="max-width:300px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="index_hero_image" accept="image/*">
          <input type="hidden" name="index_hero_image" value="<?php echo h($contents['index_hero_image'] ?? ''); ?>">
        </div>
      </div>

      <div class="admin-section">
        <h2>About 섹션</h2>
        <div class="form-group">
          <label>제목</label>
          <input type="text" name="index_about_title" value="<?php echo h($contents['index_about_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>본문 텍스트</label>
          <textarea name="index_about_text" rows="5"><?php echo h($contents['index_about_text'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
          <label>이미지</label>
          <?php if (!empty($contents['index_about_image'])): ?>
          <img src="<?php echo h($contents['index_about_image']); ?>" style="max-width:300px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="index_about_image" accept="image/*">
          <input type="hidden" name="index_about_image" value="<?php echo h($contents['index_about_image'] ?? ''); ?>">
        </div>
      </div>

      <div class="form-actions">
        <button type="submit" class="btn btn--primary">전체 저장</button>
        <a href="/" target="_blank" class="btn">프론트 미리보기</a>
      </div>
    </form>
  </main>
</div>
</body>
</html>
