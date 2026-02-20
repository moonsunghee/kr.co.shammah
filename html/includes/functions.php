<?php
/**
 * 삼마디자인 - 공통 함수
 */

/**
 * XSS 방지 출력
 */
function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

/**
 * site_contents 테이블에서 콘텐츠 값 조회
 */
function get_content(PDO $pdo, string $key, string $default = ''): string {
    static $cache = [];
    if (isset($cache[$key])) return $cache[$key];

    $stmt = $pdo->prepare('SELECT content_val FROM site_contents WHERE page_key = ?');
    $stmt->execute([$key]);
    $row = $stmt->fetch();
    $cache[$key] = $row ? $row['content_val'] : $default;
    return $cache[$key];
}

/**
 * 현재 페이지 GNB 활성 클래스 반환
 */
function nav_active(string $page, string $current): string {
    return $page === $current ? 'active' : '';
}

/**
 * 날짜 포맷 변환
 */
function format_date(string $datetime, string $format = 'Y-m-d'): string {
    return date($format, strtotime($datetime));
}

/**
 * CSRF 토큰 생성 (세션에 저장)
 */
function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * CSRF 토큰 검증
 */
function verify_csrf(string $token): bool {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * JSON 응답 출력 후 종료
 */
function json_response(array $data, int $status = 200): void {
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * 이미지 업로드 처리
 * @return string 저장된 파일 경로 (웹 경로)
 */
function upload_image(array $file, string $subDir = 'uploads'): string {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new RuntimeException('파일 업로드 실패: 오류 코드 ' . $file['error']);
    }
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        throw new RuntimeException('파일 크기가 5MB를 초과합니다.');
    }

    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($ext, ALLOWED_EXTENSIONS, true)) {
        throw new RuntimeException('허용되지 않는 파일 형식입니다. (jpg, png, gif, webp만 가능)');
    }

    // MIME 타입 재확인 (보안)
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime  = $finfo->file($file['tmp_name']);
    if (!in_array($mime, $allowedMimes, true)) {
        throw new RuntimeException('유효하지 않은 이미지 파일입니다.');
    }

    $dir = UPLOAD_DIR . $subDir . '/';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }

    $filename = uniqid('img_', true) . '.' . $ext;
    $destPath = $dir . $filename;

    if (!move_uploaded_file($file['tmp_name'], $destPath)) {
        throw new RuntimeException('파일 저장에 실패했습니다.');
    }

    return '/uploads/' . $subDir . '/' . $filename;
}
