<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '프리랜서 안내 | 삼마디자인';
$currentPage = 'freelancer';
$pageCSS     = 'freelancer.css';

$heroTitle = get_content($pdo, 'freelancer_hero_title', '프리랜서 서비스');
$heroSub   = get_content($pdo, 'freelancer_hero_sub',   '전문적인 웹 서비스를 합리적인 가격으로');

include 'includes/header.php';
?>

<!-- Hero -->
<section class="hero hero--sub" style="background-image: url('/images/banner/freelancer-hero.jpg');">
  <div class="hero__inner">
    <h1 class="hero__title"><?php echo h($heroTitle); ?></h1>
    <p class="hero__sub"><?php echo h($heroSub); ?></p>
  </div>
</section>

<!-- 서비스 소개 -->
<div class="container service">
  <header>
    <h3><strong>SERVICE</strong></h3>
    <p>삼마디자인이 제공하는 서비스</p>
  </header>
  <section class="service-grid">
    <article class="service-card">
      <div class="service-card__icon"><i class="fa-solid fa-sitemap"></i></div>
      <h4>웹기획</h4>
      <p>사용자 경험을 중심으로 한 체계적인 웹 기획</p>
    </article>
    <article class="service-card">
      <div class="service-card__icon"><i class="fa-solid fa-palette"></i></div>
      <h4>웹디자인</h4>
      <p>감각적이고 브랜드에 맞는 UI/UX 디자인</p>
    </article>
    <article class="service-card">
      <div class="service-card__icon"><i class="fa-solid fa-code"></i></div>
      <h4>웹개발</h4>
      <p>반응형 퍼블리싱 및 풀스택 웹 개발</p>
    </article>
  </section>
</div>

<!-- CTA -->
<div class="bg-primary">
  <div class="container cta">
    <h3>지금 바로 견적을 요청해보세요</h3>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
