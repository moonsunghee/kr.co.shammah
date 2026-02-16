<?php
/**
 * 이미지 업로드 AJAX 엔드포인트
 * 관리자 CMS에서 사용
 */
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => '잘못된 요청입니다.'], 405);
}

if (!verify_csrf($_POST['csrf_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'CSRF 토큰이 유효하지 않습니다.'], 403);
}

if (empty($_FILES['image'])) {
    json_response(['success' => false, 'message' => '파일이 없습니다.'], 400);
}

$subDir = preg_replace('/[^a-z0-9_-]/', '', strtolower($_POST['dir'] ?? 'uploads'));

try {
    $path = upload_image($_FILES['image'], $subDir);
    json_response(['success' => true, 'path' => $path, 'url' => SITE_URL . $path]);
} catch (RuntimeException $e) {
    json_response(['success' => false, 'message' => $e->getMessage()], 422);
}
