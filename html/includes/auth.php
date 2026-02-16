<?php
/**
 * 삼마디자인 - 관리자 인증 미들웨어
 *
 * 관리자 페이지 최상단에 include하면 비로그인 시 로그인 페이지로 리다이렉트됩니다.
 *
 * 사용법:
 *   require_once '../config/config.php';
 *   require_once '../includes/auth.php';
 */

if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit;
}
