-- 삼마디자인 DB 스키마 v1.0
-- MySQL 5.7+ / utf8mb4

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- 관리자 계정
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id`         INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `username`   VARCHAR(50)  NOT NULL UNIQUE,
  `password`   VARCHAR(255) NOT NULL COMMENT 'bcrypt 해시',
  `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 기본 관리자 계정 (비밀번호: admin1234 → bcrypt)
-- ⚠️ 배포 후 반드시 비밀번호를 변경하세요!
INSERT INTO `admin_users` (`username`, `password`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------
-- 사이트 콘텐츠 (key-value 방식)
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `site_contents` (
  `id`          INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `page_key`    VARCHAR(100)  NOT NULL UNIQUE COMMENT '예: index_hero_title',
  `content_val` TEXT          NOT NULL,
  `updated_at`  DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_page_key` (`page_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 기본 콘텐츠
INSERT INTO `site_contents` (`page_key`, `content_val`) VALUES
('index_hero_title',      '웹기획 · 디자인 · 개발 · IT교육'),
('index_hero_sub',        '삼마디자인이 함께합니다'),
('index_hero_image',      '/images/banner/hero-default.jpg'),
('index_about_title',     'ABOUT SHAMMAH'),
('index_about_text',      '삼마디자인은 웹기획, 웹디자인, 웹개발, IT교육을 전문으로 합니다.'),
('index_about_image',     '/images/banner/about-default.jpg'),
('freelancer_hero_title', '프리랜서 서비스'),
('freelancer_hero_sub',   '전문적인 웹 서비스를 합리적인 가격으로'),
('footer_company',        '삼마디자인'),
('footer_ceo',            '대표자명'),
('footer_biznum',         '000-00-00000'),
('footer_address',        '주소'),
('footer_phone',          '010-0000-0000'),
('footer_email',          'contact@shammah.co.kr');

-- --------------------------------------------------------
-- 포트폴리오
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `portfolios` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(200) NOT NULL,
  `category`    ENUM('웹기획','웹디자인','웹개발') NOT NULL,
  `thumbnail`   VARCHAR(500) NOT NULL DEFAULT '',
  `link_url`    VARCHAR(500) NOT NULL DEFAULT '',
  `description` TEXT,
  `sort_order`  INT          NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_category` (`category`),
  INDEX `idx_sort`     (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 교육 강좌
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `lessons` (
  `id`          INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `title`       VARCHAR(200) NOT NULL,
  `category`    VARCHAR(100) NOT NULL COMMENT '예: HTML/CSS, JavaScript 등',
  `subjects`    TEXT         NOT NULL COMMENT 'JSON 배열: ["과목1","과목2"]',
  `hours`       VARCHAR(50)  NOT NULL DEFAULT '',
  `figma_level` VARCHAR(50)  NOT NULL DEFAULT '',
  `thumbnail`   VARCHAR(500) NOT NULL DEFAULT '',
  `price`       INT UNSIGNED NOT NULL DEFAULT 0,
  `sort_order`  INT          NOT NULL DEFAULT 0,
  `is_active`   TINYINT(1)   NOT NULL DEFAULT 1,
  `created_at`  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_category`   (`category`),
  INDEX `idx_sort`       (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 견적 요청
-- --------------------------------------------------------
CREATE TABLE IF NOT EXISTS `quotes` (
  `id`            INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_name`   VARCHAR(100) NOT NULL,
  `company`       VARCHAR(200) NOT NULL DEFAULT '',
  `phone`         VARCHAR(50)  NOT NULL,
  `email`         VARCHAR(200) NOT NULL,
  `service_types` TEXT         NOT NULL COMMENT 'JSON 배열: ["웹기획","웹디자인"]',
  `budget`        VARCHAR(100) NOT NULL DEFAULT '',
  `deadline`      DATE                  DEFAULT NULL,
  `ref_url`       VARCHAR(500) NOT NULL DEFAULT '',
  `description`   TEXT         NOT NULL,
  `file_path`     VARCHAR(500) NOT NULL DEFAULT '',
  `status`        ENUM('접수','검토중','완료','보류') NOT NULL DEFAULT '접수',
  `created_at`    DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_status`     (`status`),
  INDEX `idx_created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
