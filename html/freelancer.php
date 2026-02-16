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
<section class="section">
  <div class="section__inner">
    <div class="section__head">
      <h2 class="section__title"><strong>SERVICE</strong></h2>
      <p class="section__sub">삼마디자인이 제공하는 서비스</p>
    </div>
    <div class="section__body service-grid">
      <!-- 서비스 항목은 추후 DB 연동 또는 정적으로 구성 -->
      <div class="service-card">
        <div class="service-card__icon"><i class="fa-solid fa-sitemap"></i></div>
        <h3>웹기획</h3>
        <p>사용자 경험을 중심으로 한 체계적인 웹 기획</p>
      </div>
      <div class="service-card">
        <div class="service-card__icon"><i class="fa-solid fa-palette"></i></div>
        <h3>웹디자인</h3>
        <p>감각적이고 브랜드에 맞는 UI/UX 디자인</p>
      </div>
      <div class="service-card">
        <div class="service-card__icon"><i class="fa-solid fa-code"></i></div>
        <h3>웹개발</h3>
        <p>반응형 퍼블리싱 및 풀스택 웹 개발</p>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section--cta">
  <div class="section__inner">
    <h2>지금 바로 견적을 요청해보세요</h2>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
