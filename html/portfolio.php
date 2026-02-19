<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '포트폴리오 | 삼마디자인';
$currentPage = 'portfolio';
$pageCSS     = 'portfolio.css';
$pageJS      = 'portfolio.js';

// 필터
$category = $_GET['category'] ?? '';
$sql = 'SELECT * FROM portfolios WHERE is_active = 1';
$params = [];
if ($category) {
    $sql .= ' AND category = ?';
    $params[] = $category;
}
$sql .= ' ORDER BY sort_order ASC, created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$portfolios = $stmt->fetchAll();

$categories = ['웹기획', '웹디자인', '웹개발'];

include 'includes/header.php';
?>

<!-- Hero -->
<section class="hero hero--sub" style="background-image: url('/images/banner/portfolio-hero.jpg');">
  <div class="hero__inner">
    <h1 class="hero__title">Portfolio</h1>
    <p class="hero__sub">삼마디자인의 작업물</p>
  </div>
</section>

<!-- 포트폴리오 -->
<div class="container portfolio">
  <header>
    <div class="portfolio-filter">
      <a href="/portfolio.php" class="filter-btn <?php echo !$category ? 'active' : ''; ?>">전체</a>
      <?php foreach ($categories as $cat): ?>
      <a href="?category=<?php echo urlencode($cat); ?>"
         class="filter-btn <?php echo $category === $cat ? 'active' : ''; ?>">
        <?php echo h($cat); ?>
      </a>
      <?php endforeach; ?>
    </div>
  </header>
  <section>
    <div class="portfolio-grid">
      <?php if (empty($portfolios)): ?>
      <p class="empty">등록된 포트폴리오가 없습니다.</p>
      <?php else: ?>
      <?php foreach ($portfolios as $item): ?>
      <article class="card portfolio-card" data-category="<?php echo h($item['category']); ?>">
        <div class="card__thumb">
          <?php if ($item['thumbnail']): ?>
          <img src="<?php echo h($item['thumbnail']); ?>" alt="<?php echo h($item['title']); ?>" loading="lazy">
          <?php else: ?>
          <div class="card__thumb-placeholder"></div>
          <?php endif; ?>
        </div>
        <div class="card__info">
          <span class="card__category"><?php echo h($item['category']); ?></span>
          <h4 class="card__title"><?php echo h($item['title']); ?></h4>
          <?php if ($item['description']): ?>
          <p class="card__desc"><?php echo h($item['description']); ?></p>
          <?php endif; ?>
          <?php if ($item['link_url']): ?>
          <a href="<?php echo h($item['link_url']); ?>" target="_blank" rel="noopener" class="card__link">사이트 보기 →</a>
          <?php endif; ?>
        </div>
      </article>
      <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </section>
</div>

<?php include 'includes/footer.php'; ?>
