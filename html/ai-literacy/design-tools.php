<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'AI 디자인 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--intermediate" style="margin-top:16px;display:inline-block;">중급</span>
    <h1 class="ai-sub-hero__title">AI 디자인 도구</h1>
    <p class="ai-sub-hero__desc">디자인 전공이 없어도 AI의 도움으로 수준 높은 결과물을 만들 수 있습니다. 그래픽 디자인부터 UI/UX, 웹사이트 생성까지 목적에 맞는 도구를 소개합니다.</p>
  </div>
</div>

<!-- 그래픽 디자인 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">그래픽·콘텐츠 디자인 도구</h2>
  <p class="ai-sub-section__lead">SNS 게시물, 프레젠테이션, 마케팅 자료를 빠르게 제작합니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#7D2AE8;color:#fff;"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Canva AI</div>
          <span class="tool-card__tag">Canva · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">전 세계 2억 명 이상이 사용하는 그래픽 디자인 플랫폼. Magic Design, Magic Write, 배경 제거 등 AI 기능이 풍부하게 탑재되어 있습니다. 디자인 지식 없이도 전문적인 결과물을 만들 수 있는 가장 접근하기 쉬운 도구입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Magic Design — 텍스트 입력만으로 디자인 자동 생성</div>
        <div class="tool-card__feature">Magic Write — AI 카피라이팅 내장</div>
        <div class="tool-card__feature">배경 제거, 이미지 확장, AI 이미지 생성 지원</div>
        <div class="tool-card__feature">무료 플랜: 대부분의 기능 무료 사용 가능</div>
      </div>
      <a href="https://www.canva.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF0000;color:#fff;"><i class="fa-brands fa-adobe"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Adobe Express</div>
          <span class="tool-card__tag">Adobe · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Adobe가 만든 간편 디자인 도구. Firefly AI가 통합되어 있어 텍스트로 이미지를 생성하거나 배경을 교체하는 작업이 자연스럽게 이어집니다. Adobe 생태계와 연동되며 저작권 안전한 에셋을 제공합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Adobe Firefly AI 이미지 생성 내장</div>
        <div class="tool-card__feature">Adobe Stock 에셋 직접 사용 (저작권 안전)</div>
        <div class="tool-card__feature">Photoshop·Illustrator 파일 연동</div>
        <div class="tool-card__feature">무료 플랜: 기본 기능 및 월 일정 크레딧 제공</div>
      </div>
      <a href="https://www.adobe.com/express/" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>
</div>

<!-- UI/UX 디자인 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">UI/UX 디자인 도구</h2>
    <p class="ai-sub-section__lead">앱·웹 화면 설계와 프로토타이핑을 AI로 가속합니다.</p>

    <div class="tool-grid">
      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#F24E1E;color:#fff;"><i class="fa-brands fa-figma"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Figma AI</div>
            <span class="tool-card__tag">Figma · 무료/유료</span>
          </div>
        </div>
        <p class="tool-card__desc">포춘 500 기업의 85%가 사용하는 UI/UX 디자인 업계 표준 도구. 최근 AI 기능이 대폭 강화되어 텍스트 설명으로 컴포넌트를 생성하거나, 디자인 시스템 일관성을 자동 검사하고, 레이아웃을 자동 제안합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">텍스트 설명으로 UI 컴포넌트 자동 생성</div>
          <div class="tool-card__feature">디자인 시스템 일관성 AI 자동 검사</div>
          <div class="tool-card__feature">실시간 협업 — 팀과 동시에 작업 가능</div>
          <div class="tool-card__feature">무료 플랜: 3개 프로젝트까지 사용 가능</div>
        </div>
        <a href="https://www.figma.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#7C3AED;color:#fff;"><i class="fa-solid fa-mobile-screen"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Uizard</div>
            <span class="tool-card__tag">Uizard · 무료/유료</span>
          </div>
        </div>
        <p class="tool-card__desc">손으로 그린 스케치나 텍스트 설명을 디지털 UI 목업으로 변환해주는 도구. 비개발자·기획자가 아이디어를 빠르게 시각화하고 공유할 때 최적입니다. Figma보다 학습 곡선이 낮아 진입 장벽이 낮습니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">손 스케치 → 디지털 목업 자동 변환</div>
          <div class="tool-card__feature">텍스트 프롬프트로 화면 레이아웃 생성</div>
          <div class="tool-card__feature">클릭 가능한 프로토타입 즉시 생성</div>
          <div class="tool-card__feature">무료 플랜: 2개 프로젝트 사용 가능</div>
        </div>
        <a href="https://uizard.io" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
      </div>
    </div>
  </div>
</div>

<!-- 웹사이트 생성 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">웹사이트·랜딩페이지 생성 도구</h2>
  <p class="ai-sub-section__lead">텍스트 프롬프트 하나로 완성된 웹사이트를 생성합니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#0099FF;color:#fff;"><i class="fa-solid fa-globe"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Framer AI</div>
          <span class="tool-card__tag">Framer · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">텍스트 프롬프트만으로 호스팅·CMS·애니메이션·SEO가 포함된 완성형 웹사이트를 생성합니다. 랜딩페이지, 포트폴리오, 스타트업 소개 페이지를 빠르게 제작하는 데 특히 강력합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">프롬프트 → 완성형 반응형 웹사이트 즉시 생성</div>
        <div class="tool-card__feature">호스팅·CMS·SEO 기능 기본 포함</div>
        <div class="tool-card__feature">커스텀 애니메이션·인터랙션 지원</div>
        <div class="tool-card__feature">무료 플랜: framer.website 도메인으로 배포 가능</div>
      </div>
      <a href="https://www.framer.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-diagram-project"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Relume AI</div>
          <span class="tool-card__tag">Relume · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">웹사이트 사이트맵과 와이어프레임을 AI로 자동 생성해주는 도구. 브랜드와 목적을 입력하면 전체 페이지 구조와 섹션 레이아웃을 제안하고, Figma·Webflow로 바로 내보낼 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">사이트맵 자동 생성 — 전체 페이지 구조 설계</div>
        <div class="tool-card__feature">섹션별 와이어프레임 자동 제안</div>
        <div class="tool-card__feature">Figma·Webflow 직접 내보내기</div>
        <div class="tool-card__feature">무료 플랜: 제한적 사이트맵 생성 가능</div>
      </div>
      <a href="https://www.relume.io" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">목적별 도구 선택 가이드</div>
    <p>
      <strong>SNS·마케팅 콘텐츠</strong>는 Canva AI,
      <strong>앱·웹 UI 설계</strong>는 Figma AI,
      <strong>빠른 아이디어 시각화</strong>는 Uizard,
      <strong>랜딩페이지 제작</strong>은 Framer,
      <strong>웹사이트 기획·와이어프레임</strong>은 Relume을 추천합니다.
    </p>
  </div>
</div>

<!-- 활용 분야 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">AI 디자인 도구 활용 분야</h2>
    <p class="ai-sub-section__lead">디자이너와 비디자이너 모두 생산성을 높일 수 있는 실용적인 활용 사례입니다.</p>

    <div class="concept-grid">
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-bullhorn"></i></div>
        <div class="concept-card__title">마케팅 자료 제작</div>
        <p>Canva AI로 SNS 게시물, 배너, 이메일 뉴스레터를 빠르게 제작하고 브랜드 일관성을 유지합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-file-powerpoint"></i></div>
        <div class="concept-card__title">프레젠테이션</div>
        <p>Canva AI나 Adobe Express로 주제를 입력하면 슬라이드 구성과 디자인을 자동으로 생성합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-sitemap"></i></div>
        <div class="concept-card__title">앱·서비스 기획</div>
        <p>Uizard나 Figma AI로 앱 화면 구조를 빠르게 시각화해 팀과 공유하고 피드백을 받습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-laptop-code"></i></div>
        <div class="concept-card__title">포트폴리오·랜딩페이지</div>
        <p>Framer AI로 개인 포트폴리오나 서비스 소개 페이지를 코딩 없이 빠르게 만들고 배포합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-pencil-ruler"></i></div>
        <div class="concept-card__title">디자인 시스템 구축</div>
        <p>Figma AI로 컴포넌트 라이브러리를 만들고 팀 전체가 일관된 디자인 언어를 사용하게 합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-store"></i></div>
        <div class="concept-card__title">브랜드 아이덴티티</div>
        <p>Canva AI의 브랜드 키트 기능으로 로고, 색상, 폰트를 등록해 모든 자료에 브랜드를 일관 적용합니다.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
