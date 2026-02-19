<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '교육 | 삼마디자인';
$currentPage = 'lesson';
$pageCSS     = 'lesson.css';
$pageJS      = 'lesson.js';

// DB에서 카테고리 목록 조회
$categories = $pdo->query('SELECT * FROM lesson_categories ORDER BY sort_order ASC')->fetchAll();

// 전체 활성 레슨 조회
$lessons = $pdo->query('SELECT * FROM lessons WHERE is_active = 1 ORDER BY sort_order ASC')->fetchAll();

// category + level 별로 그룹핑
$grouped = [];
foreach ($lessons as $l) {
  $grouped[$l['category']][$l['level']][] = $l;
}

include 'includes/header.php';
?>

<!-- Hero -->
<section class="hero hero--sub" style="background-image: url('/images/banner/lesson-hero.jpg');">
  <div class="hero__inner">
    <h1 class="hero__title">About SHAMMAH</h1>
    <p class="hero__sub">체계적인 IT 교육으로 실력을 키우세요</p>
  </div>
</section>

<!-- SHAMMAH Lesson -->
<div class="container lesson">
  <header class="lesson-header">
    <h3><strong>SHAMMAH</strong> Lesson</h3>
    <p>필요한 분야의 전문적 지식을 가장 빠른 활용방법 확인 하기 과정도 진행 중입니다</p>
  </header>

  <div class="lesson-layout">
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
        <div class="lesson-courses">
          <?php if (!empty($grouped[$cat['name']])): ?>
            <?php foreach ($grouped[$cat['name']] as $levelName => $levelLessons): ?>
            <div class="lesson-course">
              <h4 class="lesson-course__title"><?php echo h($levelName); ?></h4>
              <ul class="lesson-course__list">
                <?php foreach ($levelLessons as $lesson): ?>
                <li>
                  <span class="lesson-course__name"><?php echo h($lesson['title']); ?></span>
                  <span class="lesson-course__hours"><?php echo h($lesson['hours']); ?></span>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="lesson-course__empty">등록된 수업이 없습니다.</p>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<!-- CTA -->
<div class="bg-primary">
  <div class="container cta">
    <h3>수강 문의</h3>
    <p>교육에 대해 궁금하신 점이 있으시면 견적 요청을 통해 문의해주세요.</p>
    <a href="/quote.php" class="btn btn--primary btn--lg">문의하기</a>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
