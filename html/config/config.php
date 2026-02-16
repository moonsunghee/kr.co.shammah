<?php
/**
 * 삼마디자인 - 사이트 공통 설정
 */

define('SITE_NAME', '삼마디자인');
define('SITE_URL', 'https://yourdomain.dothome.co.kr'); // 닷홈 도메인으로 변경
define('ADMIN_EMAIL', 'admin@yourdomain.com');

define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// 세션 설정
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
