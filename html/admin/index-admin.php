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
        'index_cta_title', 'index_cta_sub', 'index_cta_image',
        'index_lesson_title', 'index_lesson_sub',
        'index_portfolio_title', 'index_portfolio_sub', 'index_portfolio_image',
    ];

    // 이미지 업로드 처리
    $imageFields = [
        'index_hero_image'      => 'banner',
        'index_about_image'     => 'banner',
        'index_cta_image'       => 'banner',
        'index_portfolio_image' => 'banner',
    ];
    foreach ($imageFields as $key => $dir) {
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
$keys = [
    'index_hero_title', 'index_hero_sub', 'index_hero_image',
    'index_about_title', 'index_about_text', 'index_about_image',
    'index_cta_title', 'index_cta_sub', 'index_cta_image',
    'index_lesson_title', 'index_lesson_sub',
    'index_portfolio_title', 'index_portfolio_sub', 'index_portfolio_image',
];
$contents = [];
$placeholders = implode(',', array_fill(0, count($keys), '?'));
$stmt = $pdo->prepare("SELECT page_key, content_val FROM site_contents WHERE page_key IN ($placeholders)");
$stmt->execute($keys);
foreach ($stmt->fetchAll() as $row) {
    $contents[$row['page_key']] = $row['content_val'];
}

// 이미지 미리보기 헬퍼
function preview_image(array $contents, string $key): void {
    if (!empty($contents[$key])) {
        echo '<img src="' . htmlspecialchars($contents[$key], ENT_QUOTES, 'UTF-8') . '" style="max-width:300px; display:block; margin-bottom:8px;">';
    }
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

      <!-- ① Hero 섹션 -->
      <div class="admin-section">
        <h2>① Hero 섹션</h2>
        <div class="form-group">
          <label>제목 텍스트</label>
          <input type="text" name="index_hero_title"
                 value="<?php echo h($contents['index_hero_title'] ?? '웹기획 · 디자인 · 개발 · IT교육'); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_hero_sub"
                 value="<?php echo h($contents['index_hero_sub'] ?? '삼마디자인이 함께합니다'); ?>">
        </div>
        <div class="form-group">
          <label>이미지</label>
          <?php preview_image($contents, 'index_hero_image'); ?>
          <input type="file" name="index_hero_image" accept="image/*">
          <input type="hidden" name="index_hero_image"
                 value="<?php echo h($contents['index_hero_image'] ?? ''); ?>">
        </div>
      </div>

      <!-- ② About 섹션 -->
      <div class="admin-section">
        <h2>② About 섹션</h2>
        <div class="form-group">
          <label>제목 텍스트</label>
          <input type="text" name="index_about_title"
                 value="<?php echo h($contents['index_about_title'] ?? 'ABOUT SHAMMAH'); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_about_text"
                 value="<?php echo h($contents['index_about_text'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>이미지</label>
          <?php preview_image($contents, 'index_about_image'); ?>
          <input type="file" name="index_about_image" accept="image/*">
          <input type="hidden" name="index_about_image"
                 value="<?php echo h($contents['index_about_image'] ?? ''); ?>">
        </div>
      </div>

      <!-- ③ 견적(CTA) 섹션 -->
      <div class="admin-section">
        <h2>③ 견적 섹션</h2>
        <div class="form-group">
          <label>제목 텍스트</label>
          <input type="text" name="index_cta_title"
                 value="<?php echo h($contents['index_cta_title'] ?? '프로젝트를 시작할 준비가 되셨나요?'); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_cta_sub"
                 value="<?php echo h($contents['index_cta_sub'] ?? '삼마디자인에 문의하시면 빠르게 견적을 안내해 드립니다.'); ?>">
        </div>
        <div class="form-group">
          <label>배경 이미지 <small>(컨테이너 background-image로 적용됩니다)</small></label>
          <?php preview_image($contents, 'index_cta_image'); ?>
          <input type="file" name="index_cta_image" accept="image/*">
          <input type="hidden" name="index_cta_image"
                 value="<?php echo h($contents['index_cta_image'] ?? ''); ?>">
        </div>
      </div>

      <!-- ④ Lesson 섹션 -->
      <div class="admin-section">
        <h2>④ Lesson 섹션</h2>
        <div class="form-group">
          <label>제목 텍스트</label>
          <input type="text" name="index_lesson_title"
                 value="<?php echo h($contents['index_lesson_title'] ?? 'SHAMMAH Lesson'); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_lesson_sub"
                 value="<?php echo h($contents['index_lesson_sub'] ?? '필요한 분야의 전문적 지식을 가장 빠른 활용방법 확인 하기 과정도 진행 중입니다'); ?>">
        </div>
      </div>

      <!-- ⑤ Portfolio 섹션 -->
      <div class="admin-section">
        <h2>⑤ Portfolio 섹션</h2>
        <div class="form-group">
          <label>제목 텍스트</label>
          <input type="text" name="index_portfolio_title"
                 value="<?php echo h($contents['index_portfolio_title'] ?? 'SHAMMAH Portfolio'); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="index_portfolio_sub"
                 value="<?php echo h($contents['index_portfolio_sub'] ?? '삼마디자인의 작업물을 소개합니다'); ?>">
        </div>
        <div class="form-group">
          <label>이미지</label>
          <?php preview_image($contents, 'index_portfolio_image'); ?>
          <input type="file" name="index_portfolio_image" accept="image/*">
          <input type="hidden" name="index_portfolio_image"
                 value="<?php echo h($contents['index_portfolio_image'] ?? ''); ?>">
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
