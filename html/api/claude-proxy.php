<?php
// Claude API 서버 프록시 — CORS 우회용
// 브라우저 → 이 파일(서버) → Anthropic API

header('Content-Type: application/json; charset=utf-8');

// POST만 허용
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// 요청 바디 파싱
$body = json_decode(file_get_contents('php://input'), true);
if (!$body) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

// API 키 검증
$apiKey = $body['api_key'] ?? '';
if (!$apiKey || !str_starts_with($apiKey, 'sk-ant-')) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid API key']);
    exit;
}

// Anthropic API 호출
$payload = json_encode([
    'model'      => $body['model']      ?? 'claude-sonnet-4-6',
    'max_tokens' => $body['max_tokens'] ?? 3000,
    'messages'   => $body['messages']   ?? [],
]);

$ch = curl_init('https://api.anthropic.com/v1/messages');
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_TIMEOUT        => 60,
    CURLOPT_HTTPHEADER     => [
        'Content-Type: application/json',
        'x-api-key: ' . $apiKey,
        'anthropic-version: 2023-06-01',
    ],
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    http_response_code(502);
    echo json_encode(['error' => 'Upstream request failed: ' . $curlError]);
    exit;
}

http_response_code($httpCode);
echo $response;
