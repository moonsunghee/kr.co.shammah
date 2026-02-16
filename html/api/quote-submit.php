<?php
/**
 * 견적 폼 AJAX 제출용 엔드포인트
 * (quote.php의 HTML 폼 방식 외에 AJAX 방식 사용 시)
 */
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => '잘못된 요청입니다.'], 405);
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'CSRF 토큰이 유효하지 않습니다.'], 403);
}

$errors = [];

$clientName  = trim($_POST['client_name'] ?? '');
$company     = trim($_POST['company'] ?? '');
$phone       = trim($_POST['phone'] ?? '');
$email       = trim($_POST['email'] ?? '');
$services    = $_POST['service_types'] ?? [];
$budget      = trim($_POST['budget'] ?? '');
$deadline    = trim($_POST['deadline'] ?? '');
$refUrl      = trim($_POST['ref_url'] ?? '');
$description = trim($_POST['description'] ?? '');

if (!$clientName)                               $errors[] = '의뢰인명을 입력해주세요.';
if (!$phone)                                    $errors[] = '연락처를 입력해주세요.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = '올바른 이메일 주소를 입력해주세요.';
if (empty($services))                           $errors[] = '의뢰 종류를 선택해주세요.';
if (!$description)                              $errors[] = '프로젝트 설명을 입력해주세요.';

$filePath = '';
if (!empty($_FILES['attach_file']['name'])) {
    try {
        $filePath = upload_image($_FILES['attach_file'], 'quotes');
    } catch (RuntimeException $e) {
        $errors[] = $e->getMessage();
    }
}

if (!empty($errors)) {
    json_response(['success' => false, 'errors' => $errors], 422);
}

$stmt = $pdo->prepare('
    INSERT INTO quotes
      (client_name, company, phone, email, service_types, budget, deadline, ref_url, description, file_path)
    VALUES
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
');
$stmt->execute([
    $clientName, $company, $phone, $email,
    json_encode($services, JSON_UNESCAPED_UNICODE),
    $budget, $deadline ?: null, $refUrl, $description, $filePath
]);

json_response(['success' => true, 'message' => '견적 요청이 접수되었습니다.']);
