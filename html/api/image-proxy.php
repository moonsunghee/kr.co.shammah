<?php
// 이미지 프록시 — Pixabay API (키워드 검색) / picsum 폴백
// 사용: /api/image-proxy.php?q=keyword&t=timestamp

require_once __DIR__ . '/../config/config.php';

$query = trim($_GET['q'] ?? 'abstract');
if (!$query) $query = 'abstract';
$query = preg_replace('/[^a-zA-Z0-9\s,\-]/', '', $query);
$query = substr($query, 0, 100);

$pixabayKey = getenv('PIXABAY_KEY') ?: '';

// ── Pixabay (키가 있을 때) ─────────────────────────────────
if ($pixabayKey) {
    $apiUrl = 'https://pixabay.com/api/?'
        . http_build_query([
            'key'        => $pixabayKey,
            'q'          => $query,
            'image_type' => 'photo',
            'per_page'   => 20,
            'safesearch' => 'true',
            'min_width'  => 1000,
            'orientation'=> 'horizontal',
        ]);

    $ch = curl_init($apiUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_USERAGENT      => 'Mozilla/5.0',
    ]);
    $result = curl_exec($ch);
    curl_close($ch);

    $data   = json_decode($result, true);
    $images = $data['hits'] ?? [];

    if (!empty($images)) {
        // 랜덤으로 하나 선택
        $img      = $images[array_rand($images)];
        $imageUrl = $img['webformatURL'];

        $ch = curl_init($imageUrl);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_USERAGENT      => 'Mozilla/5.0',
        ]);
        $image       = curl_exec($ch);
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        $httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($image && $httpCode === 200) {
            header('Content-Type: ' . ($contentType ?: 'image/jpeg'));
            header('Cache-Control: no-store');
            echo $image;
            exit;
        }
    }
}

// ── 폴백: picsum (키 없거나 검색 실패 시) ─────────────────
// t 파라미터 기반 랜덤 시드 → 매번 다른 사진
$seed = abs(crc32(($query . ($_GET['t'] ?? rand())))) % 9999;
$url  = "https://picsum.photos/seed/{$seed}/1080/1080";

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_TIMEOUT        => 15,
    CURLOPT_USERAGENT      => 'Mozilla/5.0',
]);
$image       = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($image && $httpCode === 200) {
    header('Content-Type: ' . ($contentType ?: 'image/jpeg'));
    header('Cache-Control: no-store');
    echo $image;
} else {
    http_response_code(404);
}
