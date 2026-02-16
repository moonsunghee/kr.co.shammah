<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '교육 | 삼마디자인';
$currentPage = 'lesson';
$pageCSS     = 'lesson.css';
$pageJS      = 'lesson.js';

$lessons = $pdo->query('SELECT * FROM lessons WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();

include 'includes/header.php';
?>

<!-- Hero (About SHAMMAH) -->
<section class="hero hero--sub" style="background-image: url('/images/banner/lesson-hero.jpg');">
  <div class="hero__inner">
    <h1 class="hero__title">About SHAMMAH</h1>
    <p class="hero__sub">체계적인 IT 교육으로 실력을 키우세요</p>
  </div>
</section>

<!-- SHAMMAH Lesson -->
<section class="section section--lesson">
  <div class="section__inner">
    <div class="section__head">
      <h2 class="section__title"><strong>SHAMMAH</strong> Lesson</h2>
      <p class="section__sub">교육 과정 안내</p>
    </div>
    <div class="section__body">
      <?php if (empty($lessons)): ?>
      <p class="empty">등록된 강좌가 없습니다.</p>
      <?php else: ?>
      <div class="lesson-grid">
        <?php foreach ($lessons as $lesson):
          $subjects = json_decode($lesson['subjects'], true) ?? [];
        ?>
        <div class="card lesson-card">
          <?php if ($lesson['thumbnail']): ?>
          <div class="card__thumb">
            <img src="<?php echo h($lesson['thumbnail']); ?>" alt="<?php echo h($lesson['title']); ?>" loading="lazy">
          </div>
          <?php endif; ?>
          <div class="card__info">
            <span class="card__category"><?php echo h($lesson['category']); ?></span>
            <h3 class="card__title"><?php echo h($lesson['title']); ?></h3>
            <?php if (!empty($subjects)): ?>
            <ul class="lesson-card__subjects">
              <?php foreach ($subjects as $sub): ?>
              <li><?php echo h($sub); ?></li>
              <?php endforeach; ?>
            </ul>
            <?php endif; ?>
            <div class="lesson-card__meta">
              <?php if ($lesson['hours']): ?>
              <span><i class="fa-regular fa-clock"></i> <?php echo h($lesson['hours']); ?></span>
              <?php endif; ?>
              <?php if ($lesson['figma_level']): ?>
              <span>Figma <?php echo h($lesson['figma_level']); ?></span>
              <?php endif; ?>
            </div>
            <?php if ($lesson['price']): ?>
            <div class="lesson-card__price"><?php echo number_format($lesson['price']); ?>원</div>
            <?php endif; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section section--cta">
  <div class="section__inner">
    <h2>수강 문의</h2>
    <p>교육에 대해 궁금하신 점이 있으시면 견적 요청을 통해 문의해주세요.</p>
    <a href="/quote.php" class="btn btn--primary btn--lg">문의하기</a>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
