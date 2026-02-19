<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '삼마디자인 | 웹기획 · 디자인 · 개발 · IT교육';
$currentPage = 'index';
$pageCSS     = 'index.css';
$pageJS      = 'index.js';

// DB에서 콘텐츠 조회
$heroTitle   = get_content($pdo, 'index_hero_title',  '웹기획 · 디자인 · 개발 · IT교육');
$heroSub     = get_content($pdo, 'index_hero_sub',    '삼마디자인이 함께합니다');
$heroImage   = get_content($pdo, 'index_hero_image',  '/images/banner/hero-default.jpg');
$aboutTitle  = get_content($pdo, 'index_about_title', 'ABOUT SHAMMAH');
$aboutText   = get_content($pdo, 'index_about_text',  '');
$aboutImage  = get_content($pdo, 'index_about_image', '/images/banner/about-default.jpg');

// 포트폴리오 (메인 노출용 최대 6개)
$stmt = $pdo->query('SELECT * FROM portfolios WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 6');
$portfolios = $stmt->fetchAll();

// 교육 카테고리 및 강좌 (메인 노출용)
$categories = $pdo->query('SELECT * FROM lesson_categories ORDER BY sort_order ASC')->fetchAll();
$lessons    = $pdo->query('SELECT * FROM lessons WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();

// category + level 별로 그룹핑
$grouped = [];
foreach ($lessons as $l) {
    $grouped[$l['category']][$l['level']][] = $l;
}

include 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" style="background-image: url('<?php echo h($heroImage); ?>');">
  <div class="hero__inner">
    <h1 class="hero__title"><?php echo h($heroTitle); ?></h1>
    <p class="hero__sub"><?php echo h($heroSub); ?></p>
    <div class="hero__cta">
      <a href="/quote.php" class="btn btn--primary">견적 요청하기</a>
      <a href="/portfolio.php" class="btn btn--outline">포트폴리오 보기</a>
    </div>
  </div>
</section>
<!-- About -->
<div class="container about">
  <header class=about-head>
    <h3><span><?php echo h($aboutTitle); ?></span> SHAMMAH</h3>
    <p><?php echo nl2br(h($aboutText)); ?></p>
  </header>
  <section class="about-body">
    <div class="about-body__image"><div class="img-item"><img src="<?php echo h($aboutImage); ?>" alt="삼마디자인 소개"></div></div>
    <div class="about-body__text">
      <p>
        <!-- 관리자에서 등록할수 있음 -->
        성경에 태초 하나님께서 사람을 위해 천지를 창조하셨습니다.하나님이 세상을 만드실때 그 사랑하는 자녀를 위해 천지를 만드시는 순서를 계획 하시고 목적에 맞게 설계하셨 듯 디자인은 계획과 설계입니다.성경적 세계관에 비추어 세속적인 디자인이 아닌 하나님의 디자인으로 무너져 가는 세상의 디자인을 하나님의 디자인으로 다시 회복 시키기 위한 사명으로 삼마디자인은 설립되었습니다.
        </br>삼마디자인은 이 땅 가운데 무너진 하나님의 성벽중 디자인영역이 천지창조 하실 때 하나님의 디자인으로 온전히 회복되는 사역이 중심이며 하나님이 사람을 위해 세심하게 계획하고 설계하신 세상이 세속적인 디자인에 무너지지 않고 하나님의 계획을 온전케 세움에 목적이 있습니다.
        </br>삼마디자인은 디자인 영역에서 하나님의 말씀으로 훈련된 일꾼을 일으키고 그들이 사명을 다할수 있도록 최선의 지원을 합니다.지역 교회 및 빛의 공동체를 위해 기도와 재정으로 후원하고 섬기길 원하는 많은 사역자, 후원자와 함께 하길 원합니다.
      </p>
    </div>
  </section>
  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- CTA -->
<div class="container cta bg-primary">
  <header>
    <h3>프로젝트를 시작할 준비가 되셨나요?</h3>
    <p>삼마디자인에 문의하시면 빠르게 견적을 안내해 드립니다.</p>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </header>
</div>

<!-- Lesson -->
<div class="container lesson">
  <header class="lesson-header">
    <h3>SHAMMAH <span>LESSON</span></h3>
    <p>필요한 분야의 전문적 지식을 가장 빠른 활용방법 확인 하기 과정도 진행 중입니다</p>
  </header>

  <section class="lesson-layout">
    <!-- 카테고리 사이드바 -->
    <aside class="lesson-sidebar">
      <ul class="lesson-sidebar__list">
        <?php foreach ($categories as $i => $cat): ?>
        <li>
          <button type="button"
                  class="lesson-sidebar__item<?php echo $i === 0 ? ' is-active' : ''; ?>"
                  data-index="<?php echo $i; ?>">
            <?php echo h($cat['name']); ?>
          </button>
        </li>
        <?php endforeach; ?>
      </ul>
    </aside>

    <!-- 콘텐츠 영역 -->
    <div class="lesson-content">
      <?php foreach ($categories as $i => $cat): ?>
      <div class="lesson-panel<?php echo $i === 0 ? ' is-active' : ''; ?>" data-panel="<?php echo $i; ?>">
        <?php if (!empty($grouped[$cat['name']])): ?>
        <div class="lesson-courses">
          <?php foreach ($grouped[$cat['name']] as $levelName => $levelLessons): ?>
          <article class="lesson-course">
            <h4 class="lesson-course__title"><?php echo h($levelName); ?></h4>
            <ul class="lesson-course__list">
              <?php foreach ($levelLessons as $lesson): ?>
              <li>
                <span class="lesson-course__name"><?php echo h($lesson['title']); ?></span>
                <span class="lesson-course__hours"><?php echo h($lesson['hours']); ?></span>
              </li>
              <?php endforeach; ?>
            </ul>
          </article>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
          <p class="lesson-course__empty">등록된 수업이 없습니다.</p>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
  
  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- Portfolio -->
  <div class="container portfolio bg-dark">
    <header>
      <h3>SHAMMAH <span>PORTFOLIO</span></h3>
      <p>삼마디자인의 작업물을 소개합니다</p>
    </header>
    <section class="portfolio-body">
      <div class="portfolio-body__image"><img src="<?php echo h($aboutImage); ?>" alt="삼마디자인 소개"></div>
      <div class="portfolio-body__button">
        <a href="/portfolio.php" class="btn btn--outline-white">전체 포트폴리오</a>
      </div>
    </section>
    <?php include 'includes/container_footer.php'; ?>
  </div>









<?php include 'includes/footer.php'; ?>
