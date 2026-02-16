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

// 교육 강좌 (메인 노출용 최대 3개)
$stmt = $pdo->query('SELECT * FROM lessons WHERE is_active = 1 ORDER BY sort_order ASC LIMIT 3');
$lessons = $stmt->fetchAll();

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

<!-- About Section -->
<section class="section section--about">
  <div class="section__inner">
    <div class="section__head">
      <h2 class="section__title"><?php echo h($aboutTitle); ?></h2>
    </div>
    <div class="section__body about-body">
      <div class="about-body__text">
        <p><?php echo nl2br(h($aboutText)); ?></p>
        <a href="/freelancer.php" class="btn btn--primary">서비스 안내</a>
      </div>
      <div class="about-body__image">
        <img src="<?php echo h($aboutImage); ?>" alt="삼마디자인 소개">
      </div>
    </div>
  </div>
</section>

<!-- Portfolio Section -->
<?php if (!empty($portfolios)): ?>
<section class="section section--portfolio section--dark">
  <div class="section__inner">
    <div class="section__head">
      <h2 class="section__title"><strong>PORTFOLIO</strong></h2>
      <p class="section__sub">삼마디자인의 작업물을 소개합니다</p>
    </div>
    <div class="section__body">
      <div class="portfolio-grid">
        <?php foreach ($portfolios as $item): ?>
        <div class="card portfolio-card">
          <div class="card__thumb">
            <?php if ($item['thumbnail']): ?>
            <img src="<?php echo h($item['thumbnail']); ?>" alt="<?php echo h($item['title']); ?>">
            <?php else: ?>
            <div class="card__thumb-placeholder"></div>
            <?php endif; ?>
          </div>
          <div class="card__info">
            <span class="card__category"><?php echo h($item['category']); ?></span>
            <h3 class="card__title"><?php echo h($item['title']); ?></h3>
            <?php if ($item['link_url']): ?>
            <a href="<?php echo h($item['link_url']); ?>" target="_blank" rel="noopener" class="card__link">보러가기 →</a>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="section__more">
        <a href="/portfolio.php" class="btn btn--outline-white">전체 포트폴리오</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- Lesson Section -->
<?php if (!empty($lessons)): ?>
<section class="section section--lesson">
  <div class="section__inner">
    <div class="section__head">
      <h2 class="section__title"><strong>LESSON</strong></h2>
      <p class="section__sub">체계적인 IT 교육 과정을 만나보세요</p>
    </div>
    <div class="section__body">
      <div class="lesson-grid">
        <?php foreach ($lessons as $lesson): ?>
        <div class="card lesson-card">
          <div class="card__thumb">
            <?php if ($lesson['thumbnail']): ?>
            <img src="<?php echo h($lesson['thumbnail']); ?>" alt="<?php echo h($lesson['title']); ?>">
            <?php else: ?>
            <div class="card__thumb-placeholder"></div>
            <?php endif; ?>
          </div>
          <div class="card__info">
            <span class="card__category"><?php echo h($lesson['category']); ?></span>
            <h3 class="card__title"><?php echo h($lesson['title']); ?></h3>
            <p class="card__meta"><?php echo h($lesson['hours']); ?> | Figma <?php echo h($lesson['figma_level']); ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <div class="section__more">
        <a href="/lesson.php" class="btn btn--primary">교육 전체 보기</a>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="section section--cta">
  <div class="section__inner">
    <h2>프로젝트를 시작할 준비가 되셨나요?</h2>
    <p>삼마디자인에 문의하시면 빠르게 견적을 안내해 드립니다.</p>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
