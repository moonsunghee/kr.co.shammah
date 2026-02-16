<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? h($pageTitle) : h(SITE_NAME); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Pretendard:wght@400;500;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <?php if (isset($pageCSS)): ?>
  <link rel="stylesheet" href="/css/pages/<?php echo h($pageCSS); ?>">
  <?php endif; ?>
</head>
<body>

<!-- GNB -->
<header class="gnb" id="gnb">
  <div class="gnb__inner">
    <a href="/" class="gnb__logo">
      <img src="/images/logo/logo.svg" alt="<?php echo h(SITE_NAME); ?>" onerror="this.style.display='none'; this.nextElementSibling.style.display='block'">
      <span style="display:none; font-weight:700; font-size:1.4rem;">SHAMMAH</span>
    </a>

    <nav class="gnb__nav" id="gnbNav">
      <ul class="gnb__menu">
        <li><a href="/" class="<?php echo nav_active('index', $currentPage ?? ''); ?>">홈</a></li>
        <li><a href="/freelancer.php" class="<?php echo nav_active('freelancer', $currentPage ?? ''); ?>">프리랜서안내</a></li>
        <li><a href="/portfolio.php" class="<?php echo nav_active('portfolio', $currentPage ?? ''); ?>">포트폴리오</a></li>
        <li><a href="/lesson.php" class="<?php echo nav_active('lesson', $currentPage ?? ''); ?>">교육</a></li>
        <li><a href="/quote.php" class="<?php echo nav_active('quote', $currentPage ?? ''); ?>">견적요청</a></li>
      </ul>
    </nav>

    <?php if (isset($_SESSION['admin_id'])): ?>
    <a href="/admin/" class="gnb__admin-btn">관리자</a>
    <?php endif; ?>

    <button class="gnb__hamburger" id="gnbHamburger" aria-label="메뉴 열기">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>
<!-- /GNB -->

<main class="main">
