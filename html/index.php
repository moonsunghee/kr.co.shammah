<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle = '삼마디자인 | 웹기획 · 디자인 · 개발 · IT교육';
$currentPage = 'index';
$pageCSS = 'index.css';
$pageJS = 'index.js';

// DB에서 콘텐츠 조회
$heroTitle = get_content($pdo, 'index_hero_title', '웹기획 · 디자인 · 개발 · IT교육');
$heroSub = get_content($pdo, 'index_hero_sub', '삼마디자인이 함께합니다');
$heroImage = get_content($pdo, 'index_hero_image', '/images/banner/hero-default.jpg');
$aboutTitle = get_content($pdo, 'index_about_title', 'ABOUT SHAMMAH');
$aboutText = get_content($pdo, 'index_about_text', '');
$aboutImage = get_content($pdo, 'index_about_image', '/images/banner/about-default.jpg');
$ctaTitle = get_content($pdo, 'index_cta_title', '프로젝트를 시작할 준비가 되셨나요?');
$ctaSub = get_content($pdo, 'index_cta_sub', '삼마디자인에 문의하시면 빠르게 견적을 안내해 드립니다.');
$ctaImage = get_content($pdo, 'index_cta_image', '');
$lessonTitle = get_content($pdo, 'index_lesson_title', 'SHAMMAH Lesson');
$lessonSub = get_content($pdo, 'index_lesson_sub', '필요한 분야의 전문적 지식을 가장 빠른 활용방법 확인 하기 과정도 진행 중입니다');
$portfolioTitle = get_content($pdo, 'index_portfolio_title', 'SHAMMAH Portfolio');
$portfolioSub = get_content($pdo, 'index_portfolio_sub', '삼마디자인의 작업물을 소개합니다');
$portfolioImage = get_content($pdo, 'index_portfolio_image', '/images/banner/about-default.jpg');

// 포트폴리오 (메인 노출용 최대 6개)
$stmt = $pdo->query('SELECT * FROM portfolios WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 6');
$portfolios = $stmt->fetchAll();

// 교육 카테고리 및 강좌 (메인 노출용)
$categories = $pdo->query('SELECT * FROM lesson_categories ORDER BY sort_order ASC')->fetchAll();
$lessons = $pdo->query('SELECT * FROM lessons WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();

// category + level 별로 그룹핑
$grouped = [];
foreach ($lessons as $l) {
  $grouped[$l['category']][$l['level']][] = $l;
}

include 'includes/header.php';
?>

<!-- Hero Section -->
<div class="hero">
  <section class="hero__inner">
    <div class="hero__image">
      <div class="hero__image_box"><img src="<?php echo h($heroImage); ?>" alt="히어로 이미지"></div>
    </div>
    <div class="hero__text">
      <div class="hero__text_wrap">
        <h1 class="hero__text_title"><?php echo h($heroTitle); ?></h1>
        <p class="hero__text_sub"><?php echo h($heroSub); ?></p>
        <div class="hero__text_cta">
          <a href="/quote.php" class="btn btn--primary">견적 요청하기</a>
          <a href="/portfolio.php" class="btn btn--outline">포트폴리오 보기</a>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- About -->
<div class="container about">
  <header class=about-head>
    <h3><span><?php echo h($aboutTitle); ?></span> SHAMMAH</h3>
    <p><?php echo nl2br(h($aboutText)); ?></p>
  </header>
  <section class="about-body">
    <div class="about__image">
      <div class="about__image_box"><img src="<?php echo h($aboutImage); ?>" alt="삼마디자인 소개"></div>
    </div>
    <div class="about__text">
      <p>
        태초에 하나님께서 천지를 창조하실 때 사람을 위해 질서와 목적을 따라 계획하고 설계하셨습니다.
      </p>
      <p>
        삼마디자인은 세속적 흐름 속에 무너져 가는 디자인 영역을 하나님의 창조 질서로 회복하기 위해 세워졌습니다.
      </p>
      <p>
        디자인은 단순한 표현이 아니라 세계관을 담는 설계입니다.
      </p>
      <p>
        우리는 하나님의 말씀으로 훈련된 디자인 일꾼을 세우고 지역 교회와 공동체를 섬기며 이 땅 가운데 하나님의 계획이 온전히 세워지도록 돕습니다.
      </p>
    </div>
  </section>
  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- CTA -->
<div class="container cta bg-primary" <?php if ($ctaImage): ?>
    style="background-image: url(<?php echo h($ctaImage); ?>)" <?php endif; ?>>
  <section class="cta__inner">
    <h4><?php echo h($ctaTitle); ?></h4>
    <p><?php echo h($ctaSub); ?></p>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </section>
</div>

<!-- Lesson -->
<div class="container lesson">
  <header class="lesson-header">
    <h3>SHAMMAH <span><?php echo h($lessonTitle); ?></span></h3>
    <p><?php echo h($lessonSub); ?></p>
  </header>

  <section class="lesson-layout">
    <!-- 카테고리 사이드바 -->
    <aside class="lesson__sidebar">
      <div class="lesson__sidebar__wrap"></div>
      <ul class="lesson__sidebar__list">
        <?php foreach ($categories as $i => $cat): ?>
          <li>
            <button type="button" class="lesson__sidebar__item<?php echo $i === 0 ? ' is-active' : ''; ?>"
              data-index="<?php echo $i; ?>">
              <?php echo h($cat['name']); ?>
            </button>
          </li>
        <?php endforeach; ?>
      </ul>
    </aside>

    <!-- 콘텐츠 영역 -->
    <div class="lesson__content">
      <?php foreach ($categories as $i => $cat): ?>
        <div class="lesson-panel<?php echo $i === 0 ? ' is-active' : ''; ?>" data-panel="<?php echo $i; ?>">
          <?php
            $levels = $grouped[$cat['name']] ?? [];
            $levelCount = count($levels);
          ?>
          <?php if ($levelCount > 0): ?>
            <div class="lesson-courses<?php echo $levelCount === 1 ? ' lesson-courses--single' : ''; ?>">
              <?php foreach ($levels as $levelName => $levelLessons): ?>
                <article class="lesson__course">
                  <h4 class="lesson__course__title"><?php echo h($levelName); ?></h4>
                  <ul class="lesson__course__list">
                    <?php foreach ($levelLessons as $lesson): ?>
                      <li>
                        <span class="lesson__course__name"><?php echo h($lesson['title']); ?></span>
                        <span class="lesson__course__hours"><?php echo h($lesson['hours']); ?></span>
                      </li>
                    <?php endforeach; ?>
                  </ul>
                </article>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <p class="lesson-panel__empty">등록된 강좌가 없습니다.</p>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- Portfolio -->
<div class="container portfolio bg-dark">
  <section class="portfolio-body">
    <div class="portfolio__image"><img src="<?php echo h($portfolioImage); ?>" alt="포트폴리오 이미지"></div>
    <div class="portfolio__button">
      <a href="/portfolio.php" class="btn btn--primary">전체 포트폴리오</a>
    </div>
  </section>
  <header class="portfolio-head">
    <h3>SHAMMAH <span><?php echo h($portfolioTitle); ?></span></h3>
    <p><?php echo h($portfolioSub); ?></p>
  </header>
  <?php include 'includes/container_footer.php'; ?>
</div>









<?php include 'includes/footer.php'; ?>