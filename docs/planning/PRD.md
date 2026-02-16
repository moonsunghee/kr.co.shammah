# 삼마디자인 웹사이트 개발 기획서 (PRD)

> **Product Requirements Document**
> 작성일: 2026-02-16
> 버전: v1.0

---

## 1. 프로젝트 개요

### 1.1 회사 소개
**삼마디자인(SHAMMAH Design)**은 웹기획, 웹디자인, 웹개발, IT교육을 전문으로 하는 디자인 회사입니다.

### 1.2 프로젝트 목적
- 삼마디자인의 서비스와 역량을 효과적으로 소개하는 공식 웹사이트 구축
- 포트폴리오를 통한 실적 전시 및 신규 고객 유치
- IT교육 강좌 안내 및 수강 문의 창구 제공
- 견적 요청 기능으로 프로젝트 문의 접수 간소화
- 관리자가 직접 콘텐츠(이미지, 텍스트)를 수정할 수 있는 CMS 기능 제공

### 1.3 목표 사용자
| 구분 | 대상 |
|------|------|
| 일반 사용자 | 웹 제작을 의뢰하려는 개인/기업 |
| 교육 수강생 | IT교육 수강을 원하는 개인 |
| 관리자 | 삼마디자인 운영팀 (콘텐츠 관리) |

---

## 2. 사이트 구조 (IA)

```
삼마디자인 웹사이트
│
├── 인덱스 (index.html)               ← 메인 홈페이지
├── 프리랜서 안내 (freelancer.html)   ← 프리랜서 서비스 소개
├── 포트폴리오 (portfolio.html)       ← 작업 포트폴리오
├── 교육 (lesson.html)                ← IT교육 강좌 안내
└── 견적 요청 (quote.html)            ← 프로젝트 견적 문의
│
└── 관리자 페이지 (admin/)
    ├── index-admin.html              ← 인덱스 페이지 관리
    ├── freelancer-admin.html         ← 프리랜서 페이지 관리
    ├── portfolio-admin.html          ← 포트폴리오 관리
    ├── lesson-admin.html             ← 교육 페이지 관리
    └── quote-admin.html              ← 견적 목록 관리
```

---

## 3. 페이지별 요구사항

### 3.1 공통 요소

#### 3.1.1 상단 내비게이션 (GNB)
- **로고**: SHAMMAH 브랜드 로고 (좌측 배치)
- **메뉴**: 인덱스 | 프리랜서안내 | 포트폴리오 | 교육 | 견적요청
- **관리자 버튼**: 우측 상단 (로그인 후 관리 링크 노출)
- **반응형**: 모바일에서 햄버거 메뉴로 전환

#### 3.1.2 문서 구조
```
[GNB - 상단 내비게이션]
[메인 배너 / 히어로 섹션]
[콘텐츠 섹션 A]
  - 제목단 (Section Title)
  - 내용단 (Section Content)
[콘텐츠 섹션 B]
  - 제목단
  - 내용단
[푸터]
```

#### 3.1.3 푸터 (Footer)
- 회사명, 대표자, 사업자등록번호, 주소, 연락처
- 서비스 메뉴 링크
- 저작권 표기

---

### 3.2 인덱스 페이지 (index.html)

**레이아웃 참조**: `reference/Index.png`

#### 섹션 구성
| 섹션 | 제목 | 내용 |
|------|------|------|
| Hero | 메인 배너 | 풀스크린 배경 + 헤드라인 + CTA 버튼 |
| About | HEADLINE HERE | 회사 소개 텍스트 + 이미지 |
| Portfolio | HEADLINE HERE | 포트폴리오 슬라이더/갤러리 |
| Lesson | HEADLINE HERE | 교육 강좌 카드 3개 |
| CTA | - | 문의/견적 유도 배너 |

#### 관리자 관리 항목
- 메인 배너 이미지, 헤드라인 텍스트
- About 섹션 이미지, 텍스트
- 포트폴리오 썸네일, 제목, 설명
- 교육 카드 이미지, 제목, 설명

---

### 3.3 프리랜서 안내 페이지 (freelancer.html)

#### 섹션 구성
| 섹션 | 내용 |
|------|------|
| Hero | 프리랜서 서비스 소개 배너 |
| 서비스 소개 | 웹기획/디자인/개발 각 서비스 설명 |
| 작업 프로세스 | 프로젝트 진행 단계 (스텝 형태) |
| 요금 안내 | 서비스별 기본 요금표 |
| CTA | 견적 요청 유도 |

#### 관리자 관리 항목
- 히어로 이미지, 텍스트
- 서비스 항목별 아이콘, 제목, 설명
- 요금 정보

---

### 3.4 포트폴리오 페이지 (portfolio.html)

#### 섹션 구성
| 섹션 | 내용 |
|------|------|
| Hero | 포트폴리오 소개 배너 |
| 필터 탭 | 웹기획 / 웹디자인 / 웹개발 / 전체 |
| 갤러리 | 포트폴리오 카드 그리드 (이미지, 제목, 카테고리, 링크) |
| 페이지네이션 | 페이지 이동 |

#### 관리자 관리 항목
- 포트폴리오 항목 추가/수정/삭제
- 썸네일 이미지, 제목, 카테고리, 링크, 설명

---

### 3.5 교육 페이지 (lesson.html)

**레이아웃 참조**: `reference/lesson.jpg`

#### 섹션 구성
| 섹션 | 내용 |
|------|------|
| Hero | About SHAMMAH - 회사/교육 소개 |
| 포트폴리오 | SHAMMAH Portfolio 슬라이더 |
| Invoice | SHAMMAH Invoice - 서비스 요금 슬라이더 |
| Lesson | SHAMMAH Lesson - 교육 과정 목록 |

#### 교육 강좌 구분
- 디자인 방법론
- UX UI 제작/조작
- HTML/CSS
- JavaScript/jQuery
- JavaScript/React
- 파이썬
- 업무효율/보조

#### 강좌 카드 구성
- 강좌명, 과목 목록, 시간, Figma 등급

#### 관리자 관리 항목
- 강좌 목록 추가/수정/삭제
- 강좌 이미지, 제목, 내용, 수강료

---

### 3.6 견적 요청 페이지 (quote.html)

#### 섹션 구성
| 섹션 | 내용 |
|------|------|
| Hero | 견적 요청 소개 배너 |
| 견적 폼 | 요청 양식 |

#### 견적 요청 폼 필드
| 필드 | 타입 | 필수 |
|------|------|------|
| 의뢰인명 | text | ✅ |
| 회사/기관명 | text | - |
| 연락처 | tel | ✅ |
| 이메일 | email | ✅ |
| 의뢰 종류 | checkbox (다중선택) | ✅ |
| 예산 범위 | select | - |
| 희망 완료일 | date | - |
| 참고 사이트 URL | text | - |
| 프로젝트 설명 | textarea | ✅ |
| 파일 첨부 | file | - |
| 개인정보 동의 | checkbox | ✅ |

#### 의뢰 종류 옵션
- 웹기획
- 웹디자인
- 웹개발 (퍼블리싱)
- 웹개발 (풀스택)
- IT교육
- 기타

#### 관리자 관리 항목
- 접수된 견적 목록 조회
- 견적 상세 내용 확인
- 처리 상태 변경 (접수/검토중/완료/보류)

---

## 4. 관리자 시스템 요구사항

### 4.1 관리자 인증
- 관리자 로그인 페이지 (`admin/login.html`)
- 아이디/비밀번호 기반 인증
- 로그인 상태에서만 관리 기능 접근 가능

### 4.2 페이지별 관리 기능

| 관리 대상 | 기능 |
|-----------|------|
| 이미지 | 업로드, 교체, 삭제 |
| 텍스트 | 인라인 편집 또는 폼 편집 |
| 포트폴리오 항목 | 추가, 수정, 삭제, 순서 변경 |
| 교육 강좌 | 추가, 수정, 삭제 |
| 견적 목록 | 조회, 상태 변경, 삭제 |

### 4.3 기술 스펙 (관리자)
- 각 프론트 페이지에 대응하는 별도 관리자 페이지
- 인증: PHP 세션 기반 로그인 (bcrypt 해싱)
- 이미지 관리: PHP 파일 업로드 → uploads/ 폴더 저장 → DB 경로 기록
- 텍스트 편집: textarea 폼 → PHP POST → MySQL 업데이트
- 데이터 저장: MySQL (PDO Prepared Statement)

---

## 5. 디자인 가이드

### 5.1 레이아웃 원칙
- **최대 너비**: 1200px (콘텐츠 영역)
- **섹션 패딩**: 상하 80px~120px
- **컬럼**: 12 그리드 시스템

### 5.2 컬러 팔레트 (레퍼런스 기반)
| 역할 | 색상 |
|------|------|
| Primary | #FF6B6B (살몬/코랄 레드) |
| Background | #FFFFFF (흰색) |
| Dark | #1A1A1A (거의 검정) |
| Gray | #F5F5F5 (라이트 그레이) |
| Text | #333333 (다크 그레이) |

### 5.3 타이포그래피
- **영문 헤드라인**: Bold + Regular 혼합 (예: **HEADLINE** HERE)
- **한글**: Noto Sans KR 또는 Pretendard
- **영문**: Inter 또는 Montserrat

### 5.4 반응형 브레이크포인트
| 구분 | 너비 |
|------|------|
| Desktop | 1200px 이상 |
| Tablet | 768px ~ 1199px |
| Mobile | 767px 이하 |

---

## 6. 기술 스택

| 구분 | 기술 |
|------|------|
| 호스팅 | 닷홈 (dothome.co.kr) |
| 서버 언어 | PHP 7.4+ |
| 데이터베이스 | MySQL 5.7+ |
| 마크업 | HTML5 + PHP 템플릿 |
| 스타일 | CSS3 (CSS Custom Properties, Flexbox, Grid) |
| 스크립트 | Vanilla JavaScript (ES6+) |
| 슬라이더 | Swiper.js |
| 아이콘 | Font Awesome 또는 SVG |
| 폰트 | Google Fonts (Pretendard/Inter) |
| 인증 | PHP Session |
| 파일 업로드 | PHP move_uploaded_file() |
| DB 접근 | PDO (Prepared Statement) |
| 버전관리 | Git |

---

## 7. 납품 산출물

### 프론트 페이지 (PHP)
| 파일 | 설명 |
|------|------|
| `index.php` | 메인 홈페이지 |
| `freelancer.php` | 프리랜서 안내 |
| `portfolio.php` | 포트폴리오 |
| `lesson.php` | 교육 안내 |
| `quote.php` | 견적 요청 |

### 관리자 페이지 (PHP)
| 파일 | 설명 |
|------|------|
| `admin/login.php` | 관리자 로그인 |
| `admin/logout.php` | 로그아웃 |
| `admin/index.php` | 관리자 대시보드 |
| `admin/index-admin.php` | 인덱스 콘텐츠 관리 |
| `admin/freelancer-admin.php` | 프리랜서 관리 |
| `admin/portfolio-admin.php` | 포트폴리오 CRUD |
| `admin/lesson-admin.php` | 교육 강좌 CRUD |
| `admin/quote-admin.php` | 견적 목록 관리 |

### 공통 컴포넌트 (PHP)
| 파일 | 설명 |
|------|------|
| `config/db.php` | DB 접속 정보 |
| `config/config.php` | 사이트 공통 설정 |
| `includes/header.php` | GNB (공통 헤더) |
| `includes/footer.php` | 공통 푸터 |
| `includes/functions.php` | 공통 함수 |
| `includes/auth.php` | 관리자 인증 미들웨어 |

### API 엔드포인트 (PHP)
| 파일 | 설명 |
|------|------|
| `api/upload.php` | 이미지 업로드 처리 |
| `api/save-content.php` | 콘텐츠 저장 |
| `api/quote-submit.php` | 견적 폼 제출 처리 |
| `api/quote-status.php` | 견적 상태 변경 |

### DB 및 기타
| 파일 | 설명 |
|------|------|
| `sql/schema.sql` | DB 스키마 (초기 설치용) |
| `.htaccess` | config/, includes/ 직접 접근 차단 |
| `css/style.css` | 공통 스타일 |
| `css/admin.css` | 관리자 스타일 |
| `js/main.js` | 공통 스크립트 |
| `js/admin/cms.js` | 관리자 CMS 스크립트 |

---

*문서 끝 — 삼마디자인 웹사이트 PRD v1.0*
