<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// 통계
$quoteCount     = $pdo->query('SELECT COUNT(*) FROM quotes WHERE status = "접수"')->fetchColumn();
$portfolioCount = $pdo->query('SELECT COUNT(*) FROM portfolios WHERE is_active = 1')->fetchColumn();
$lessonCount    = $pdo->query('SELECT COUNT(*) FROM lessons WHERE is_active = 1')->fetchColumn();

// 최근 견적 5건
$recentQuotes = $pdo->query('SELECT * FROM quotes ORDER BY created_at DESC LIMIT 5')->fetchAll();
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자 대시보드 | 삼마디자인</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-page">

<div class="admin-layout">
  <!-- 사이드바 -->
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li class="active"><a href="/admin/">대시보드</a></li>
        <li><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>

  <!-- 콘텐츠 -->
  <main class="admin-content">
    <div class="admin-header">
      <h1>대시보드</h1>
      <span>안녕하세요, <?php echo h($_SESSION['admin_user']); ?>님</span>
    </div>

    <!-- 요약 카드 -->
    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-card__value"><?php echo (int)$quoteCount; ?></div>
        <div class="stat-card__label">신규 견적 (접수)</div>
        <a href="/admin/quote-admin.php" class="stat-card__link">바로가기 →</a>
      </div>
      <div class="stat-card">
        <div class="stat-card__value"><?php echo (int)$portfolioCount; ?></div>
        <div class="stat-card__label">포트폴리오 항목</div>
        <a href="/admin/portfolio-admin.php" class="stat-card__link">바로가기 →</a>
      </div>
      <div class="stat-card">
        <div class="stat-card__value"><?php echo (int)$lessonCount; ?></div>
        <div class="stat-card__label">교육 강좌</div>
        <a href="/admin/lesson-admin.php" class="stat-card__link">바로가기 →</a>
      </div>
    </div>

    <!-- 최근 견적 목록 -->
    <div class="admin-section">
      <div class="admin-section__head">
        <h2>최근 견적 요청</h2>
        <a href="/admin/quote-admin.php" class="btn btn--sm">전체 보기</a>
      </div>
      <table class="admin-table">
        <thead>
          <tr>
            <th>의뢰인</th>
            <th>이메일</th>
            <th>의뢰 종류</th>
            <th>상태</th>
            <th>접수일</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($recentQuotes)): ?>
          <tr><td colspan="5" class="empty">접수된 견적이 없습니다.</td></tr>
          <?php else: ?>
          <?php foreach ($recentQuotes as $q): ?>
          <tr>
            <td><?php echo h($q['client_name']); ?></td>
            <td><?php echo h($q['email']); ?></td>
            <td><?php
              $types = json_decode($q['service_types'], true) ?? [];
              echo h(implode(', ', $types));
            ?></td>
            <td><span class="badge badge--<?php echo h($q['status']); ?>"><?php echo h($q['status']); ?></span></td>
            <td><?php echo format_date($q['created_at']); ?></td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </main>
</div>

</body>
</html>
