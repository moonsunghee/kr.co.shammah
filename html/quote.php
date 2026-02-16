<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = '견적 요청 | 삼마디자인';
$currentPage = 'quote';
$pageCSS     = 'quote.css';
$pageJS      = 'quote.js';

$success = false;
$errors  = [];

// 폼 제출 처리
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF 검증
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $errors[] = '잘못된 요청입니다. 페이지를 새로고침 후 다시 시도해주세요.';
    } else {
        // 필수 필드 검증
        $clientName  = trim($_POST['client_name'] ?? '');
        $company     = trim($_POST['company'] ?? '');
        $phone       = trim($_POST['phone'] ?? '');
        $email       = trim($_POST['email'] ?? '');
        $services    = $_POST['service_types'] ?? [];
        $budget      = trim($_POST['budget'] ?? '');
        $deadline    = trim($_POST['deadline'] ?? '');
        $refUrl      = trim($_POST['ref_url'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $privacyAgree = isset($_POST['privacy_agree']);

        if (!$clientName)       $errors[] = '의뢰인명을 입력해주세요.';
        if (!$phone)            $errors[] = '연락처를 입력해주세요.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = '올바른 이메일 주소를 입력해주세요.';
        if (empty($services))   $errors[] = '의뢰 종류를 하나 이상 선택해주세요.';
        if (!$description)      $errors[] = '프로젝트 설명을 입력해주세요.';
        if (!$privacyAgree)     $errors[] = '개인정보 처리방침에 동의해주세요.';

        // 파일 업로드 처리
        $filePath = '';
        if (!empty($_FILES['attach_file']['name'])) {
            try {
                $filePath = upload_image($_FILES['attach_file'], 'quotes');
            } catch (RuntimeException $e) {
                $errors[] = '파일 업로드 오류: ' . $e->getMessage();
            }
        }

        if (empty($errors)) {
            $stmt = $pdo->prepare('
                INSERT INTO quotes
                  (client_name, company, phone, email, service_types, budget, deadline, ref_url, description, file_path)
                VALUES
                  (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ');
            $stmt->execute([
                $clientName,
                $company,
                $phone,
                $email,
                json_encode($services, JSON_UNESCAPED_UNICODE),
                $budget,
                $deadline ?: null,
                $refUrl,
                $description,
                $filePath,
            ]);
            $success = true;
        }
    }
}

include 'includes/header.php';
?>

<!-- Hero -->
<section class="hero hero--sub" style="background-image: url('/images/banner/quote-hero.jpg');">
  <div class="hero__inner">
    <h1 class="hero__title">견적 요청</h1>
    <p class="hero__sub">프로젝트에 대해 알려주세요</p>
  </div>
</section>

<!-- Quote Form -->
<section class="section section--quote">
  <div class="section__inner section__inner--narrow">

    <?php if ($success): ?>
    <div class="alert alert--success">
      <strong>견적 요청이 접수되었습니다!</strong><br>
      빠른 시일 내에 연락드리겠습니다.
    </div>
    <?php else: ?>

    <?php if (!empty($errors)): ?>
    <div class="alert alert--error">
      <ul><?php foreach ($errors as $e): ?><li><?php echo h($e); ?></li><?php endforeach; ?></ul>
    </div>
    <?php endif; ?>

    <form class="quote-form" method="post" enctype="multipart/form-data" novalidate>
      <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">

      <div class="form-row">
        <div class="form-group">
          <label for="client_name">의뢰인명 <span class="required">*</span></label>
          <input type="text" id="client_name" name="client_name" value="<?php echo h($_POST['client_name'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
          <label for="company">회사/기관명</label>
          <input type="text" id="company" name="company" value="<?php echo h($_POST['company'] ?? ''); ?>">
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="phone">연락처 <span class="required">*</span></label>
          <input type="tel" id="phone" name="phone" value="<?php echo h($_POST['phone'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
          <label for="email">이메일 <span class="required">*</span></label>
          <input type="email" id="email" name="email" value="<?php echo h($_POST['email'] ?? ''); ?>" required>
        </div>
      </div>

      <div class="form-group">
        <label>의뢰 종류 <span class="required">*</span></label>
        <div class="checkbox-group">
          <?php
          $serviceOptions = ['웹기획', '웹디자인', '웹개발 (퍼블리싱)', '웹개발 (풀스택)', 'IT교육', '기타'];
          $selectedServices = $_POST['service_types'] ?? [];
          foreach ($serviceOptions as $opt):
          ?>
          <label class="checkbox-label">
            <input type="checkbox" name="service_types[]" value="<?php echo h($opt); ?>"
              <?php echo in_array($opt, $selectedServices) ? 'checked' : ''; ?>>
            <?php echo h($opt); ?>
          </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="budget">예산 범위</label>
          <select id="budget" name="budget">
            <option value="">선택 안함</option>
            <?php
            $budgets = ['100만원 미만', '100~300만원', '300~500만원', '500만원~1천만원', '1천만원 이상', '협의'];
            foreach ($budgets as $b): ?>
            <option value="<?php echo h($b); ?>" <?php echo (($_POST['budget'] ?? '') === $b) ? 'selected' : ''; ?>>
              <?php echo h($b); ?>
            </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="form-group">
          <label for="deadline">희망 완료일</label>
          <input type="date" id="deadline" name="deadline" value="<?php echo h($_POST['deadline'] ?? ''); ?>">
        </div>
      </div>

      <div class="form-group">
        <label for="ref_url">참고 사이트 URL</label>
        <input type="url" id="ref_url" name="ref_url" value="<?php echo h($_POST['ref_url'] ?? ''); ?>" placeholder="https://">
      </div>

      <div class="form-group">
        <label for="description">프로젝트 설명 <span class="required">*</span></label>
        <textarea id="description" name="description" rows="6" required placeholder="프로젝트에 대해 자세히 설명해주세요."><?php echo h($_POST['description'] ?? ''); ?></textarea>
      </div>

      <div class="form-group">
        <label for="attach_file">파일 첨부</label>
        <input type="file" id="attach_file" name="attach_file" accept="image/*,.pdf">
        <small>이미지(jpg, png, gif, webp) 또는 PDF, 최대 5MB</small>
      </div>

      <div class="form-group">
        <label class="checkbox-label">
          <input type="checkbox" name="privacy_agree" <?php echo isset($_POST['privacy_agree']) ? 'checked' : ''; ?> required>
          개인정보 수집 및 이용에 동의합니다. <span class="required">*</span>
        </label>
      </div>

      <div class="form-submit">
        <button type="submit" class="btn btn--primary btn--lg">견적 요청 제출</button>
      </div>
    </form>
    <?php endif; ?>

  </div>
</section>

<?php include 'includes/footer.php'; ?>
