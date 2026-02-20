<!DOCTYPE html>
<html lang="ko">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo isset($pageTitle) ? h($pageTitle) : h(SITE_NAME); ?></title>
  <!-- Europa: html/fonts/ 에 자체 호스팅 (_fonts.scss에서 로드) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;500;700&family=Noto+Serif+KR:wght@400;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="/css/style.css">
  <?php if (isset($pageCSS)): ?>
    <link rel="stylesheet" href="/css/pages/<?php echo h($pageCSS); ?>">
  <?php endif; ?>
</head>

<body>

  <!-- GNB -->
  <div class="site-header" id="siteHeader">
    <header class="site-header-inner">
      <h1 class="logo"><a href="/">SHAM<span>MAH</span></a></h1>
      <nav class="gnb" id="gnbNav">
        <ul class="gnb__menu">
          <li class="<?php echo nav_active('index', $currentPage ?? ''); ?>"><a href="/">홈</a></li>
          <li class="<?php echo nav_active('freelancer', $currentPage ?? ''); ?>"><a href="/freelancer.php" >프리랜서안내</a></li>
          <li class="<?php echo nav_active('portfolio', $currentPage ?? ''); ?>"><a href="/portfolio.php">포트폴리오</a></li>
          <li class="<?php echo nav_active('lesson', $currentPage ?? ''); ?>"><a href="/lesson.php">교육</a></li>          
          <li class="<?php echo nav_active('quote', $currentPage ?? ''); ?>"><a href="/quote.php">견적요청</a></li>
        </ul>
      </nav>

      <button class="site-header__hamburger" id="gnbHamburger" aria-label="메뉴 열기">
        <span></span><span></span><span></span>
      </button>
    </header>
  </div>

  <!-- /GNB -->