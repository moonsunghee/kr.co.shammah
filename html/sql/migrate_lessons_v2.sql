-- 교육 테이블 v2 마이그레이션
-- lessons 테이블에 level 컬럼 추가, 불필요 컬럼 제거

ALTER TABLE `lessons`
  ADD COLUMN `level` ENUM('초급','중급') NOT NULL DEFAULT '초급' AFTER `category`,
  DROP COLUMN `subjects`,
  DROP COLUMN `figma_level`,
  DROP COLUMN `thumbnail`,
  DROP COLUMN `price`;
