<?php
/**
 * 견적 상태 변경 AJAX 엔드포인트
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

$id     = (int)($input['id'] ?? 0);
$status = $input['status'] ?? '';
$allowed = ['접수', '검토중', '완료', '보류'];

if (!$id || !in_array($status, $allowed, true)) {
    json_response(['success' => false, 'message' => '유효하지 않은 요청입니다.'], 400);
}

$pdo->prepare('UPDATE quotes SET status = ? WHERE id = ?')->execute([$status, $id]);

json_response(['success' => true]);
