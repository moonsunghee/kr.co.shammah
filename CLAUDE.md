# SHAMMAH (삼마디자인) 웹사이트

## 프로젝트 개요
- **용도**: 삼마디자인 프리랜서 웹사이트 (포트폴리오 + 교육 + 견적요청)
- **기술 스택**: PHP 8.x + MySQL + Apache (.htaccess)
- **프론트엔드**: Vanilla JS, Pretendard + Inter (CDN), Swiper.js, FontAwesome 6.5
- **디자인 시스템**: Primary `#FF6B6B` | Dark `#1A1A1A` | Gray `#F5F5F5` | Text `#333`

## 디렉토리 구조
```
html/                    ← 웹루트 (document root)
├── admin/               ← 관리자 페이지
├── api/                 ← AJAX 엔드포인트
├── config/              ← 설정 (config.php, db.php)
├── includes/            ← 공통 PHP (header, footer, functions, auth)
├── css/                 ← 스타일시트
│   ├── style.css        ← 글로벌 CSS
│   ├── admin.css        ← 관리자 CSS
│   └── pages/           ← 페이지별 CSS
├── js/                  ← JavaScript
│   ├── main.js          ← GNB 등 공통 JS
│   └── pages/           ← 페이지별 JS
├── images/              ← 정적 이미지
├── uploads/             ← 업로드 파일 (banner, lesson, portfolio)
└── sql/                 ← DB 스키마
```

---

## 호스팅 / 배포 정보

### 서버 환경
- **호스팅 업체**: 닷홈 (dothome.co.kr)
- **서버 OS**: Linux
- **PHP 버전**: 8.x (닷홈 제공)
- **MySQL 버전**: MySQL 5.7+ (닷홈 제공)
- **웹서버**: Apache

### 도메인
- **도메인**: shammah.co.kr
- **SSL**: 닷홈 제공 (무료 SSL)

### FTP / SSH 접속 정보
- **호스트**: shammah.dothome.co.kr
- **포트**: FTP 21
- **사용자명**: shammah
- **비밀번호**: ⚠️ 여기에 직접 기록하지 마세요 (비밀번호 관리자 사용 권장)
- **웹루트 경로**: /home/shammah/html/

### DB 접속 정보
- ⚠️ **모든 DB/호스팅 인증 정보는 `html/.env` 파일에서 관리**
- `.env`는 `.gitignore`에 등록되어 Git에 포함되지 않음
- 배포 시 `html/.env.example`을 참고하여 `.env` 파일 생성

---

## 배포 절차

### 1. 사전 준비
- [ ] 호스팅 계정 생성 및 도메인 연결 완료
- [ ] PHP 버전 8.0 이상 확인
- [ ] MySQL DB 생성 및 사용자 권한 부여 완료

### 2. 파일 업로드
- [ ] FTP/SFTP로 `html/` 디렉토리 내 전체 파일을 웹루트에 업로드
  - 업로드 대상: `html/*` → 서버 웹루트 `/`
  - **주의**: `html/` 폴더 자체가 아니라 그 **안의 내용물**을 웹루트에 넣어야 함
- [ ] `uploads/` 디렉토리 쓰기 권한 설정 (`chmod 755` 또는 `775`)
  - `uploads/banner/`, `uploads/lesson/`, `uploads/portfolio/`, `uploads/quotes/`

### 3. DB 설정
- [ ] `sql/` 폴더의 SQL 파일로 테이블 생성 (phpMyAdmin 또는 CLI)
- [ ] `config/db.php` 파일의 DB 접속 정보를 실제 서버 정보로 수정
  ```php
  $host = 'localhost';   // ← 실제 DB 호스트
  $dbname = shammah;      // ← 실제 DB명
  $user = shammah;    // ← 실제 DB 사용자
  $pass = Matt2820!!;  // ← 실제 DB 비밀번호
  ```
- [ ] 관리자 계정 생성 (SQL 직접 INSERT 또는 별도 스크립트)

### 4. config 설정
- [ ] `config/config.php`의 `SITE_URL` 등 상수를 실제 도메인으로 변경

### 5. 동작 확인 체크리스트
- [ ] 메인 페이지 로딩 및 스타일 정상 확인
- [ ] GNB 메뉴 동작 (모바일 햄버거 포함)
- [ ] 포트폴리오 / 교육 페이지 DB 연동 확인
- [ ] 견적 요청 폼 제출 → DB 저장 확인
- [ ] 관리자 로그인 (`/admin/login.php`)
- [ ] 관리자 대시보드 및 CRUD 동작 확인
- [ ] 이미지 업로드 동작 확인
- [ ] SSL (https) 정상 작동 확인

### 6. 보안 체크
- [ ] `config/` 디렉토리 외부 접근 차단 (.htaccess 확인)
- [ ] DB 비밀번호가 소스 코드에 하드코딩되지 않도록 환경변수 또는 별도 파일 관리
- [ ] `uploads/` 디렉토리에서 PHP 실행 차단
- [ ] 관리자 비밀번호 변경 (기본값 사용 금지)

---

## 주의사항
- `config/db.php`에 실제 비밀번호가 포함되므로 **절대 Git에 커밋하지 말 것** → `.gitignore`에 추가 권장
- 이미지 업로드 경로는 `uploads/` 하위에 자동 생성됨, 서버에서 쓰기 권한 필수
- `.htaccess` 파일이 Apache mod_rewrite에 의존하므로 AllowOverride All 설정 필요
