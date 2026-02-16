<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $fields = ['freelancer_hero_title', 'freelancer_hero_sub', 'freelancer_hero_image'];

    if (!empty($_FILES['freelancer_hero_image']['name'])) {
        try { $_POST['freelancer_hero_image'] = upload_image($_FILES['freelancer_hero_image'], 'banner'); } catch (RuntimeException $e) {}
    }

    $stmt = $pdo->prepare('INSERT INTO site_contents (page_key, content_val) VALUES (?, ?) ON DUPLICATE KEY UPDATE content_val = VALUES(content_val)');
    foreach ($fields as $field) {
        if (isset($_POST[$field])) $stmt->execute([$field, $_POST[$field]]);
    }
    $message = '저장되었습니다.';
}

$keys = ['freelancer_hero_title','freelancer_hero_sub','freelancer_hero_image'];
$placeholders = implode(',', array_fill(0, count($keys), '?'));
$stmt = $pdo->prepare("SELECT page_key, content_val FROM site_contents WHERE page_key IN ($placeholders)");
$stmt->execute($keys);
$contents = [];
foreach ($stmt->fetchAll() as $row) $contents[$row['page_key']] = $row['content_val'];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>프리랜서 관리 | 삼마디자인 관리자</title>
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
        <li class="active"><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header"><h1>프리랜서 페이지 관리</h1></div>

    <?php if ($message): ?><div class="alert alert--success"><?php echo h($message); ?></div><?php endif; ?>

    <form method="post" enctype="multipart/form-data" class="admin-form">
      <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
      <div class="admin-section">
        <h2>Hero 섹션</h2>
        <div class="form-group">
          <label>제목</label>
          <input type="text" name="freelancer_hero_title" value="<?php echo h($contents['freelancer_hero_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="freelancer_hero_sub" value="<?php echo h($contents['freelancer_hero_sub'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>배경 이미지</label>
          <?php if (!empty($contents['freelancer_hero_image'])): ?>
          <img src="<?php echo h($contents['freelancer_hero_image']); ?>" style="max-width:300px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="freelancer_hero_image" accept="image/*">
          <input type="hidden" name="freelancer_hero_image" value="<?php echo h($contents['freelancer_hero_image'] ?? ''); ?>">
        </div>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn--primary">저장</button>
        <a href="/freelancer.php" target="_blank" class="btn">프론트 미리보기</a>
      </div>
    </form>
  </main>
</div>
</body>
</html>
