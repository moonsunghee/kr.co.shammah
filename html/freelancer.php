<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '프리랜서 안내 | 삼마디자인';
$currentPage = 'freelancer';
$pageCSS     = 'freelancer.css';

$heroTitle = get_content($pdo, 'freelancer_hero_title', '프리랜서 서비스');
$heroSub   = get_content($pdo, 'freelancer_hero_sub',   '전문적인 웹 서비스를 합리적인 가격으로');

// 프리랜서 목록 (DB)
$rows = $pdo->query('SELECT * FROM freelancers WHERE is_active = 1 ORDER BY sort_order ASC, id ASC')->fetchAll();
$freelancers = [];
foreach ($rows as $r) {
  $rolesArr = json_decode($r['role'], true) ?: [];
  $freelancers[] = [
    'name'       => $r['name'],
    'roles'      => $rolesArr,
    'roleNames'  => implode(',', array_column($rolesArr, 'role')),
    'roleLevels' => implode(',', array_column($rolesArr, 'level')),
    'skills'     => array_map('trim', explode(',', $r['skills'])),
    'desc'       => $r['description'],
    'avatar'     => $r['avatar'],
  ];
}

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
    <h3>SHAMMAH <span>Service</span></h3>
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
  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- 프리랜서 목록 -->
<div class="container freelancers">
  <header>
    <h3>SHAMMAH <span>Freelancer</span></h3>
    <p>삼마디자인과 함께하는 전문 프리랜서를 소개합니다</p>
  </header>
  <section class="freelancer-body">

    <!-- 필터 -->
    <div class="freelancer-filter">
      <div class="filter-row">
        <span class="filter-label">업무유형</span>
        <div class="filter-btns" data-filter="role">
          <button class="filter-btn is-active" data-value="all">전체</button>
          <button class="filter-btn" data-value="교강사">교강사</button>
          <button class="filter-btn" data-value="기획자">기획자</button>
          <button class="filter-btn" data-value="디자이너">디자이너</button>
          <button class="filter-btn" data-value="퍼블리셔">퍼블리셔</button>
          <button class="filter-btn" data-value="프론트개발">프론트개발</button>
          <button class="filter-btn" data-value="백엔드개발">백엔드개발</button>
        </div>
      </div>
      <div class="filter-row">
        <span class="filter-label">레벨</span>
        <div class="filter-btns" data-filter="level">
          <button class="filter-btn is-active" data-value="all">전체</button>
          <button class="filter-btn" data-value="초급">초급</button>
          <button class="filter-btn" data-value="중급">중급</button>
          <button class="filter-btn" data-value="고급">고급</button>
          <button class="filter-btn" data-value="특급">특급</button>
        </div>
      </div>
    </div>

    <!-- 카드 그리드 -->
    <div class="freelancer-grid" id="freelancerGrid">
      <?php foreach ($freelancers as $f): ?>
        <article class="freelancer-card"
          data-roles="<?php echo h($f['roleNames']); ?>"
          data-levels="<?php echo h($f['roleLevels']); ?>">
          <div class="freelancer-card__avatar">
            <?php if (!empty($f['avatar'])): ?>
              <img src="<?php echo h($f['avatar']); ?>" alt="<?php echo h($f['name']); ?>">
            <?php else: ?>
              <i class="fa-solid fa-user"></i>
            <?php endif; ?>
          </div>
          <div class="freelancer-card__badges">
            <?php foreach ($f['roles'] as $rd): ?>
              <span class="badge badge--level badge--<?php echo h($rd['level']); ?>">
                <?php echo h($rd['role']); ?> · <?php echo h($rd['level']); ?>
              </span>
            <?php endforeach; ?>
          </div>
          <h4 class="freelancer-card__name"><?php echo h($f['name']); ?></h4>
          <p class="freelancer-card__desc"><?php echo h($f['desc']); ?></p>
          <ul class="freelancer-card__skills">
            <?php foreach ($f['skills'] as $skill): ?>
              <li><?php echo h($skill); ?></li>
            <?php endforeach; ?>
          </ul>
          <a href="/quote.php" class="btn btn--primary btn--sm">견적 문의</a>
        </article>
      <?php endforeach; ?>
    </div>

    <!-- 결과 없음 -->
    <p class="freelancer-empty hidden" id="freelancerEmpty">조건에 맞는 프리랜서가 없습니다.</p>

  </section>
  <?php include 'includes/container_footer.php'; ?>
</div>

<!-- CTA -->
<div class="bg-primary">
  <div class="container cta">
    <h3>지금 바로 견적을 요청해보세요</h3>
    <a href="/quote.php" class="btn btn--primary btn--lg">견적 요청하기</a>
  </div>
</div>

<script>
(function () {
  var activeRole  = 'all';
  var activeLevel = 'all';

  function filterCards() {
    var cards = document.querySelectorAll('.freelancer-card');
    var visible = 0;
    cards.forEach(function (card) {
      var roles  = card.dataset.roles  ? card.dataset.roles.split(',')  : [];
      var levels = card.dataset.levels ? card.dataset.levels.split(',') : [];
      var matchRole  = activeRole  === 'all' || roles.indexOf(activeRole)   !== -1;
      var matchLevel = activeLevel === 'all' || levels.indexOf(activeLevel) !== -1;
      if (matchRole && matchLevel) {
        card.classList.remove('hidden');
        visible++;
      } else {
        card.classList.add('hidden');
      }
    });
    document.getElementById('freelancerEmpty').classList.toggle('hidden', visible > 0);
  }

  document.querySelectorAll('[data-filter]').forEach(function (group) {
    group.addEventListener('click', function (e) {
      var btn = e.target.closest('.filter-btn');
      if (!btn) return;
      group.querySelectorAll('.filter-btn').forEach(function (b) { b.classList.remove('is-active'); });
      btn.classList.add('is-active');
      if (group.dataset.filter === 'role')  activeRole  = btn.dataset.value;
      if (group.dataset.filter === 'level') activeLevel = btn.dataset.value;
      filterCards();
    });
  });
}());
</script>

<?php include 'includes/footer.php'; ?>
