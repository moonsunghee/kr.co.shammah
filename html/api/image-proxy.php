<?php
// Unsplash 이미지 프록시 — CORS 우회 + html2canvas 캡처용
// 사용: /api/image-proxy.php?q=keyword

$query = trim($_GET['q'] ?? 'abstract background');
if (!$query) $query = 'abstract background';

// 영문 키워드만 허용 (기본 보안)
$query = preg_replace('/[^a-zA-Z0-9\s,\-]/', '', $query);
$query = substr($query, 0, 100);

// 키워드를 쉼표 구분으로 변환 (loremflickr 형식)
$keywords = implode(',', array_map('trim', preg_split('/[\s,]+/', $query)));

$url = "https://loremflickr.com/1080/1080/{$keywords}";

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_MAXREDIRS      => 5,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible)',
]);
$image       = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($image && $httpCode === 200) {
    header('Content-Type: '   . ($contentType ?: 'image/jpeg'));
    header('Cache-Control: public, max-age=86400'); // 24시간 캐시
    echo $image;
} else {
    http_response_code(404);
}
