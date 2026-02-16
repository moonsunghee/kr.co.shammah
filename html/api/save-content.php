<?php
/**
 * 사이트 콘텐츠 저장 AJAX 엔드포인트
 * 관리자 CMS에서 텍스트/이미지 경로 업데이트 시 사용
 */
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['success' => false, 'message' => '잘못된 요청입니다.'], 405);
}

$input = json_decode(file_get_contents('php://input'), true);

if (!verify_csrf($input['csrf_token'] ?? '')) {
    json_response(['success' => false, 'message' => 'CSRF 토큰이 유효하지 않습니다.'], 403);
}

$key   = trim($input['key'] ?? '');
$value = $input['value'] ?? '';

if (!$key) {
    json_response(['success' => false, 'message' => 'key가 필요합니다.'], 400);
}

// INSERT OR UPDATE (UPSERT)
$stmt = $pdo->prepare('
    INSERT INTO site_contents (page_key, content_val)
    VALUES (?, ?)
    ON DUPLICATE KEY UPDATE content_val = VALUES(content_val)
');
$stmt->execute([$key, $value]);

json_response(['success' => true]);
