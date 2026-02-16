<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// 상태 변경 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update_status' && verify_csrf($_POST['csrf_token'] ?? '')) {
        $id     = (int)$_POST['id'];
        $status = $_POST['status'];
        $allowed = ['접수', '검토중', '완료', '보류'];
        if (in_array($status, $allowed, true)) {
            $pdo->prepare('UPDATE quotes SET status = ? WHERE id = ?')->execute([$status, $id]);
        }
        header('Location: /admin/quote-admin.php');
        exit;
    }
}

// 필터
$filterStatus = $_GET['status'] ?? '';
$sql = 'SELECT * FROM quotes';
$params = [];
if ($filterStatus) {
    $sql .= ' WHERE status = ?';
    $params[] = $filterStatus;
}
$sql .= ' ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$quotes = $stmt->fetchAll();

// 상세 보기
$detail = null;
if (isset($_GET['id'])) {
    $stmt = $pdo->prepare('SELECT * FROM quotes WHERE id = ?');
    $stmt->execute([(int)$_GET['id']]);
    $detail = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>견적 관리 | 삼마디자인 관리자</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-page">

<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li><a href="/admin/">대시보드</a></li>
        <li><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li class="active"><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>

  <main class="admin-content">
    <div class="admin-header">
      <h1>견적 관리</h1>
    </div>

    <!-- 필터 -->
    <div class="filter-bar">
      <?php foreach (['', '접수', '검토중', '완료', '보류'] as $s): ?>
      <a href="?status=<?php echo urlencode($s); ?>"
         class="filter-btn <?php echo $filterStatus === $s ? 'active' : ''; ?>">
        <?php echo $s ?: '전체'; ?>
      </a>
      <?php endforeach; ?>
    </div>

    <?php if ($detail): ?>
    <!-- 상세 보기 -->
    <div class="admin-section">
      <div class="admin-section__head">
        <h2>견적 상세 #<?php echo (int)$detail['id']; ?></h2>
        <a href="/admin/quote-admin.php" class="btn btn--sm">목록으로</a>
      </div>
      <div class="detail-grid">
        <div class="detail-row"><strong>의뢰인</strong><span><?php echo h($detail['client_name']); ?></span></div>
        <div class="detail-row"><strong>회사/기관</strong><span><?php echo h($detail['company']); ?></span></div>
        <div class="detail-row"><strong>연락처</strong><span><?php echo h($detail['phone']); ?></span></div>
        <div class="detail-row"><strong>이메일</strong><span><?php echo h($detail['email']); ?></span></div>
        <div class="detail-row"><strong>의뢰 종류</strong><span><?php
          $types = json_decode($detail['service_types'], true) ?? [];
          echo h(implode(', ', $types));
        ?></span></div>
        <div class="detail-row"><strong>예산</strong><span><?php echo h($detail['budget']); ?></span></div>
        <div class="detail-row"><strong>희망 완료일</strong><span><?php echo h($detail['deadline'] ?? '-'); ?></span></div>
        <div class="detail-row"><strong>참고 URL</strong><span>
          <?php if ($detail['ref_url']): ?>
          <a href="<?php echo h($detail['ref_url']); ?>" target="_blank" rel="noopener"><?php echo h($detail['ref_url']); ?></a>
          <?php else: echo '-'; endif; ?>
        </span></div>
        <div class="detail-row detail-row--full"><strong>프로젝트 설명</strong><p><?php echo nl2br(h($detail['description'])); ?></p></div>
        <?php if ($detail['file_path']): ?>
        <div class="detail-row"><strong>첨부파일</strong><span><a href="<?php echo h($detail['file_path']); ?>" target="_blank">파일 보기</a></span></div>
        <?php endif; ?>
        <div class="detail-row"><strong>접수일</strong><span><?php echo h($detail['created_at']); ?></span></div>
      </div>

      <!-- 상태 변경 -->
      <form method="post" class="status-form">
        <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
        <input type="hidden" name="action" value="update_status">
        <input type="hidden" name="id" value="<?php echo (int)$detail['id']; ?>">
        <label for="status">처리 상태 변경:</label>
        <select name="status" id="status">
          <?php foreach (['접수', '검토중', '완료', '보류'] as $s): ?>
          <option value="<?php echo h($s); ?>" <?php echo $detail['status'] === $s ? 'selected' : ''; ?>><?php echo h($s); ?></option>
          <?php endforeach; ?>
        </select>
        <button type="submit" class="btn btn--primary btn--sm">상태 변경</button>
      </form>
    </div>

    <?php else: ?>
    <!-- 목록 -->
    <div class="admin-section">
      <table class="admin-table">
        <thead>
          <tr>
            <th>#</th>
            <th>의뢰인</th>
            <th>연락처</th>
            <th>의뢰 종류</th>
            <th>상태</th>
            <th>접수일</th>
            <th>상세</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($quotes)): ?>
          <tr><td colspan="7" class="empty">견적 요청이 없습니다.</td></tr>
          <?php else: ?>
          <?php foreach ($quotes as $q): ?>
          <tr>
            <td><?php echo (int)$q['id']; ?></td>
            <td><?php echo h($q['client_name']); ?></td>
            <td><?php echo h($q['phone']); ?></td>
            <td><?php
              $types = json_decode($q['service_types'], true) ?? [];
              echo h(implode(', ', $types));
            ?></td>
            <td><span class="badge badge--<?php echo h($q['status']); ?>"><?php echo h($q['status']); ?></span></td>
            <td><?php echo format_date($q['created_at']); ?></td>
            <td><a href="?id=<?php echo (int)$q['id']; ?>" class="btn btn--sm">보기</a></td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    <?php endif; ?>

  </main>
</div>

</body>
</html>
