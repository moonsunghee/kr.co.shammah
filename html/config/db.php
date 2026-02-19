<?php
/**
 * 삼마디자인 - DB 접속 설정
 *
 * .env 파일에서 DB 접속 정보를 읽어옵니다.
 */

require_once __DIR__ . '/env.php';

define('DB_HOST',    getenv('DB_HOST') ?: 'localhost');
define('DB_NAME',    getenv('DB_NAME') ?: '');
define('DB_USER',    getenv('DB_USER') ?: '');
define('DB_PASS',    getenv('DB_PASS') ?: '');
define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');

try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    // 운영 환경에서는 에러 메시지를 외부에 노출하지 않음
    error_log('DB 연결 실패: ' . $e->getMessage());
    http_response_code(500);
    die('서버 오류가 발생했습니다. 잠시 후 다시 시도해 주세요.');
}
