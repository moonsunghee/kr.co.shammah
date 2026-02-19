<?php
/**
 * 삼마디자인 - .env 파일 로더
 *
 * .env 파일을 파싱하여 환경변수로 등록합니다.
 */

function loadEnv(string $path): void
{
    if (!file_exists($path)) {
        error_log('.env 파일을 찾을 수 없습니다: ' . $path);
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // 주석 무시
        if (str_starts_with(trim($line), '#')) {
            continue;
        }

        // KEY=VALUE 파싱
        if (strpos($line, '=') === false) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        if (!empty($key)) {
            $_ENV[$key] = $value;
            putenv("{$key}={$value}");
        }
    }
}

// .env 로드
loadEnv(dirname(__DIR__) . '/.env');
