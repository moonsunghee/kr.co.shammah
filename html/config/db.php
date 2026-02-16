<?php
/**
 * 삼마디자인 - DB 접속 설정 (닷홈 MySQL)
 *
 * ⚠️ 닷홈 호스팅 설정값으로 반드시 교체하세요:
 *   - DB 호스트: 닷홈 cPanel → MySQL → 호스트명 확인
 *   - DB명/사용자/비밀번호: 닷홈 cPanel → MySQL 데이터베이스
 */

define('DB_HOST', 'localhost');
define('DB_NAME', 'your_db_name');     // 닷홈 DB명으로 변경
define('DB_USER', 'your_db_user');     // 닷홈 DB 사용자로 변경
define('DB_PASS', 'your_db_password'); // 닷홈 DB 비밀번호로 변경
define('DB_CHARSET', 'utf8mb4');

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
