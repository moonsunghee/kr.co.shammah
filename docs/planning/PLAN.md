# 삼마디자인 웹사이트 개발 계획서

> 작성일: 2026-02-16
> 버전: v2.0 (닷홈 호스팅 PHP 구조)

---

## 1. 개발 단계 개요

```
Phase 1 → Phase 2 → Phase 3 → Phase 4 → Phase 5
기획/설계   핵심개발    관리자개발   QA/테스트   납품
 (완료)    (2주)       (1.5주)     (0.5주)    (완료)
```

---

## 2. 호스팅 환경 (닷홈)

| 항목 | 내용 |
|------|------|
| 호스팅 | 닷홈 (dothome.co.kr) |
| 서버 언어 | PHP 7.4+ |
| 데이터베이스 | MySQL 5.7+ |
| 이메일 | PHP mail() 또는 SMTP |
| 파일 업로드 | PHP move_uploaded_file() |
| 세션 관리 | PHP Session |

---

## 3. 폴더 구조

```
shammah/  (웹루트: public_html/)
│
├── docs/                          ← 기획 문서 (배포 제외)
│   ├── planning/
│   │   ├── PRD.md
│   │   └── PLAN.md
│   └── wireframes/
│       ├── wireframe-index.html
│       ├── wireframe-freelancer.html
│       ├── wireframe-portfolio.html
│       ├── wireframe-lesson.html
│       ├── wireframe-quote.html
│       └── wireframe-admin.html
│
├── reference/                     ← 레이아웃 레퍼런스 이미지 (배포 제외)
│   ├── Index.png
│   └── lesson.jpg
│
├── config/                        ← 설정 파일 (웹 직접 접근 차단)
│   ├── db.php                     ← DB 접속 정보
│   └── config.php                 ← 사이트 공통 설정
│
├── includes/                      ← PHP 공통 컴포넌트
│   ├── header.php                 ← GNB (공통 상단)
│   ├── footer.php                 ← 푸터 (공통 하단)
│   ├── functions.php              ← 공통 함수
│   └── auth.php                   ← 관리자 인증 체크
│
├── css/
│   ├── style.css                  ← 공통 스타일
│   ├── pages/
│   │   ├── index.css
│   │   ├── freelancer.css
│   │   ├── portfolio.css
│   │   ├── lesson.css
│   │   └── quote.css
│   └── admin.css                  ← 관리자 스타일
│
├── js/
│   ├── main.js                    ← 공통 스크립트
│   ├── pages/
│   │   ├── index.js
│   │   ├── portfolio.js
│   │   ├── lesson.js
│   │   └── quote.js
│   └── admin/
│       └── cms.js                 ← 관리자 CMS 스크립트
│
├── images/
│   ├── logo/
│   ├── banner/
│   ├── portfolio/
│   ├── lesson/
│   └── icons/
│
├── uploads/                       ← 관리자 업로드 이미지 저장소
│   ├── banner/
│   ├── portfolio/
│   └── lesson/
│
├── admin/                         ← 관리자 페이지
│   ├── login.php                  ← 관리자 로그인
│   ├── logout.php                 ← 로그아웃
│   ├── index.php                  ← 관리자 대시보드
│   ├── index-admin.php            ← 인덱스 콘텐츠 관리
│   ├── freelancer-admin.php       ← 프리랜서 페이지 관리
│   ├── portfolio-admin.php        ← 포트폴리오 관리
│   ├── lesson-admin.php           ← 교육 강좌 관리
│   └── quote-admin.php            ← 견적 목록 관리
│
├── api/                           ← AJAX 처리용 PHP 엔드포인트
│   ├── upload.php                 ← 이미지 업로드 처리
│   ├── save-content.php           ← 콘텐츠 저장
│   ├── quote-submit.php           ← 견적 폼 제출 처리
│   └── quote-status.php           ← 견적 상태 변경
│
├── sql/
│   └── schema.sql                 ← DB 스키마 (초기 설치용)
│
├── .htaccess                      ← config/, includes/ 직접접근 차단
│
├── index.php
├── freelancer.php
├── portfolio.php
├── lesson.php
└── quote.php
```

---

## 4. DB 스키마 설계

### 4.1 테이블 목록

| 테이블 | 용도 |
|--------|------|
| `admin_users` | 관리자 계정 |
| `site_contents` | 페이지별 텍스트 콘텐츠 (key-value) |
| `portfolios` | 포트폴리오 항목 |
| `lessons` | 교육 강좌 항목 |
| `quotes` | 견적 요청 목록 |

### 4.2 테이블 명세

#### admin_users
```sql
id, username, password (bcrypt), created_at
```

#### site_contents
```sql
id, page_key (예: index_hero_title), content_value, updated_at
```

#### portfolios
```sql
id, title, category, thumbnail, link_url, description, sort_order, is_active, created_at
```

#### lessons
```sql
id, title, subjects (JSON), hours, figma_level, thumbnail, price, is_active, sort_order, created_at
```

#### quotes
```sql
id, client_name, company, phone, email, service_types (JSON),
budget, deadline, ref_url, description, file_path, status, created_at
```

---

## 5. 개발 우선순위 및 일정

### Phase 1: 기획 및 설계 (완료)
- [x] 레이아웃 레퍼런스 분석
- [x] PRD 작성
- [x] 개발 계획서 작성 (PHP 구조로 업데이트)
- [x] 와이어프레임 작성

### Phase 2: 환경 설정 및 공통 컴포넌트 개발
| 작업 | 파일 | 비고 |
|------|------|------|
| DB 스키마 작성 | sql/schema.sql | MySQL |
| DB 접속 설정 | config/db.php | PDO |
| 사이트 설정 | config/config.php | BASE_URL 등 |
| 공통 함수 | includes/functions.php | 이스케이프, 날짜 등 |
| GNB | includes/header.php | 반응형 햄버거 메뉴 |
| 푸터 | includes/footer.php | |
| 관리자 인증 미들웨어 | includes/auth.php | 세션 체크 |
| .htaccess | .htaccess | config/ 접근 차단 |

### Phase 3: 프론트엔드 페이지 개발 (PHP)
| 순서 | 페이지 | 레이아웃 참조 | 상태 |
|------|--------|--------------|------|
| 1 | index.php | Index.png ✅ | 대기 |
| 2 | lesson.php | lesson.jpg ✅ | 대기 |
| 3 | quote.php | 직접 설계 | 대기 |
| 4 | portfolio.php | 추후 레이아웃 | 대기 |
| 5 | freelancer.php | 추후 레이아웃 | 대기 |

### Phase 4: 관리자 페이지 개발
| 순서 | 페이지 | 기능 |
|------|--------|------|
| 1 | admin/login.php | 세션 기반 로그인 |
| 2 | admin/index-admin.php | 인덱스 콘텐츠 관리 |
| 3 | admin/lesson-admin.php | 교육 강좌 CRUD |
| 4 | admin/quote-admin.php | 견적 목록 조회/상태변경 |
| 5 | admin/portfolio-admin.php | 포트폴리오 CRUD |
| 6 | admin/freelancer-admin.php | 프리랜서 페이지 관리 |

### Phase 5: API 엔드포인트 개발
| 파일 | 기능 |
|------|------|
| api/upload.php | 이미지 업로드 (AJAX) |
| api/save-content.php | 콘텐츠 저장 (AJAX) |
| api/quote-submit.php | 견적 폼 제출 |
| api/quote-status.php | 견적 상태 변경 |

### Phase 6: QA 및 테스트
- 크로스 브라우저 테스트
- 반응형 테스트
- 관리자 기능 통합 테스트
- 보안 점검 (SQL 인젝션, XSS, CSRF)

---

## 6. 기술 구현 상세

### 6.1 PHP 공통 include 패턴
```php
<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
$pageTitle = '페이지 제목 | 삼마디자인';
$currentPage = 'index'; // GNB 활성 메뉴 표시용
include '../includes/header.php';
?>

<!-- 페이지 콘텐츠 -->

<?php include '../includes/footer.php'; ?>
```

### 6.2 관리자 인증 (세션)
```php
// includes/auth.php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /admin/login.php');
    exit;
}
```

### 6.3 DB 연결 (PDO)
```php
// config/db.php
$pdo = new PDO(
    'mysql:host=localhost;dbname=DB명;charset=utf8mb4',
    'DB사용자',
    'DB비밀번호',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
```

### 6.4 견적 폼 처리 (PHP)
```php
// api/quote-submit.php
// - POST 데이터 검증
// - 파일 업로드 처리 (move_uploaded_file)
// - DB INSERT (PDO prepared statement)
// - 이메일 발송 (mail() 또는 PHPMailer)
// - JSON 응답 반환
```

### 6.5 이미지 업로드
```php
// api/upload.php
// - 파일 타입 검증 (jpg, png, gif, webp만 허용)
// - 파일 크기 제한 (5MB)
// - 랜덤 파일명 생성 (uniqid)
// - uploads/ 폴더에 저장
// - DB에 경로 저장
// - JSON으로 경로 반환
```

### 6.6 콘텐츠 관리 (key-value 방식)
```php
// site_contents 테이블에서 page_key로 조회
// 예: index_hero_title, index_about_text 등
// 관리자에서 수정 → DB 업데이트
// 프론트에서 DB 조회 → 출력
```

---

## 7. 보안 체크리스트

- [ ] config/ 폴더 직접 접근 차단 (.htaccess)
- [ ] 모든 DB 쿼리 PDO prepared statement 사용
- [ ] 출력 시 htmlspecialchars() 적용 (XSS 방지)
- [ ] 파일 업로드 타입/크기 검증
- [ ] 관리자 비밀번호 bcrypt 해싱
- [ ] CSRF 토큰 (관리자 폼)
- [ ] 세션 하이재킹 방지 (session_regenerate_id)

---

## 8. 체크리스트

### 환경 설정
- [ ] config/db.php
- [ ] config/config.php
- [ ] sql/schema.sql
- [ ] .htaccess

### 공통 컴포넌트
- [ ] includes/header.php
- [ ] includes/footer.php
- [ ] includes/functions.php
- [ ] includes/auth.php

### 프론트엔드
- [ ] index.php
- [ ] freelancer.php
- [ ] portfolio.php
- [ ] lesson.php
- [ ] quote.php
- [ ] 전체 반응형

### 관리자
- [ ] admin/login.php
- [ ] admin/logout.php
- [ ] admin/index.php (대시보드)
- [ ] admin/index-admin.php
- [ ] admin/lesson-admin.php
- [ ] admin/quote-admin.php
- [ ] admin/portfolio-admin.php
- [ ] admin/freelancer-admin.php

### API
- [ ] api/upload.php
- [ ] api/save-content.php
- [ ] api/quote-submit.php
- [ ] api/quote-status.php

### QA
- [ ] 크로스 브라우저
- [ ] 반응형
- [ ] 기능 테스트
- [ ] 보안 점검

---

*문서 끝 — 삼마디자인 개발 계획서 v2.0 (PHP)*
