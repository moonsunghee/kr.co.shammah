<?php
/**
 * 삼마디자인 - 사이트 공통 설정
 */

require_once __DIR__ . '/env.php';

define('SITE_NAME',  '삼마디자인');
define('SITE_URL',   getenv('SITE_URL') ?: 'https://shammah.co.kr');
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'admin@shammah.co.kr');

define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'] . '/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_EXTENSIONS', ['jpg', 'jpeg', 'png', 'gif', 'webp']);

// 세션 설정
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
