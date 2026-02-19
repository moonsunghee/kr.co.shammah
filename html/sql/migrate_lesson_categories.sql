-- 마이그레이션: lesson_categories 테이블 추가
-- 실행 시점: 기존 lessons 테이블이 존재하는 상태에서 실행

SET NAMES utf8mb4;

-- 1. lesson_categories 테이블 생성
CREATE TABLE IF NOT EXISTS `lesson_categories` (
  `id`         INT UNSIGNED  NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(100)  NOT NULL UNIQUE,
  `sort_order` INT           NOT NULL DEFAULT 0,
  `created_at` DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX `idx_sort` (`sort_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. 기본 카테고리 삽입 (중복 시 무시)
INSERT IGNORE INTO `lesson_categories` (`name`, `sort_order`) VALUES
('디자인 방법론', 1),
('UX UI레슨/코칭', 2),
('HTML/CSS', 3),
('JavaScript/jQuery', 4),
('TypeScript/Next', 5),
('파이썬', 6),
('업무코칭/보조', 7);
