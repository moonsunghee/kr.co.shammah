<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '텍스트 생성 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--beginner" style="margin-top:16px;display:inline-block;">초급</span>
    <h1 class="ai-sub-hero__title">텍스트 생성 도구</h1>
    <p class="ai-sub-hero__desc">ChatGPT, Claude, Gemini 등 대표적인 텍스트 AI 도구의 특징과 실전 활용법을 비교합니다.</p>
  </div>
</div>

<!-- 도구 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 텍스트 생성 도구</h2>
  <p class="ai-sub-section__lead">각 도구마다 강점이 다릅니다. 작업 목적에 맞는 도구를 선택하세요.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#74AA9C;color:#fff;"><i class="fa-solid fa-comment-dots"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">ChatGPT</div>
          <span class="tool-card__tag">OpenAI · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">가장 널리 사용되는 AI 챗봇. 글쓰기, 요약, 번역, 질문 답변, 코드 작성 등 다목적으로 활용됩니다. GPT-4o 모델을 무료로 사용할 수 있으며, 플러그인과 GPTs를 통해 기능을 확장할 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">웹 검색, 이미지 분석, 파일 업로드 지원</div>
        <div class="tool-card__feature">GPTs로 나만의 맞춤형 AI 제작 가능</div>
        <div class="tool-card__feature">한국어 지원 우수</div>
        <div class="tool-card__feature">무료 플랜: GPT-4o 제한적 사용 가능</div>
      </div>
      <a href="https://chatgpt.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Gemini</div>
          <span class="tool-card__tag">Google · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Google이 개발한 멀티모달 AI. Google 검색·Gmail·문서도구와 통합되어 있어 Google Workspace 사용자에게 특히 유용합니다. 실시간 정보 검색이 기본 탑재되어 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Google 서비스(Gmail, Docs, Drive) 연동</div>
        <div class="tool-card__feature">실시간 웹 검색 기본 탑재</div>
        <div class="tool-card__feature">이미지·음성·텍스트 멀티모달 지원</div>
        <div class="tool-card__feature">무료 플랜: Gemini 1.5 Flash 사용 가능</div>
      </div>
      <a href="https://gemini.google.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#D97757;color:#fff;"><i class="fa-solid fa-circle-nodes"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Claude</div>
          <span class="tool-card__tag">Anthropic · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Anthropic이 개발한 AI. 긴 문서 처리와 논리적 글쓰기에서 강점을 보입니다. 안전성과 정직성을 중시하는 설계로, 복잡한 분석·리서치·장문 작성 작업에 특히 적합합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">최대 200K 토큰의 긴 컨텍스트 처리</div>
        <div class="tool-card__feature">PDF, 문서 파일 업로드 및 분석</div>
        <div class="tool-card__feature">논리적이고 구조적인 답변 생성</div>
        <div class="tool-card__feature">무료 플랜: Claude Sonnet 사용 가능</div>
      </div>
      <a href="https://claude.ai" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#20808D;color:#fff;"><i class="fa-solid fa-magnifying-glass"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Perplexity</div>
          <span class="tool-card__tag">Perplexity AI · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">AI 기반 검색 엔진. 질문에 대한 답변과 함께 출처(링크)를 함께 제공합니다. 최신 정보 조사, 리서치, 팩트체크 작업에 가장 적합한 도구입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">모든 답변에 출처 링크 제공</div>
        <div class="tool-card__feature">실시간 최신 정보 검색</div>
        <div class="tool-card__feature">학술 논문, 뉴스, 유튜브 등 소스 선택 가능</div>
        <div class="tool-card__feature">무료 플랜: 기본 검색 무제한 사용</div>
      </div>
      <a href="https://www.perplexity.ai" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">어떤 도구를 선택해야 할까요?</div>
    <p>
      <strong>빠른 글쓰기·일상 업무</strong>는 ChatGPT,
      <strong>긴 문서 분석·보고서 작성</strong>은 Claude,
      <strong>최신 정보 검색</strong>은 Perplexity,
      <strong>Google 서비스 연동</strong>은 Gemini를 추천합니다.
      처음에는 ChatGPT나 Claude로 시작하세요.
    </p>
  </div>
</div>

<!-- 실전 활용 예시 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">이렇게 활용해보세요</h2>
    <p class="ai-sub-section__lead">텍스트 AI는 업무의 다양한 영역에서 시간을 절약해줍니다.</p>

    <div class="concept-grid">
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-pen-to-square"></i></div>
        <div class="concept-card__title">콘텐츠 초안 작성</div>
        <p>블로그, SNS 게시글, 뉴스레터 초안을 빠르게 작성하고 직접 다듬어 완성도를 높이세요.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-file-lines"></i></div>
        <div class="concept-card__title">문서 요약</div>
        <p>긴 보고서, 계약서, 기사를 붙여넣고 핵심만 요약해달라고 요청하면 빠르게 내용을 파악할 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-language"></i></div>
        <div class="concept-card__title">번역 및 다듬기</div>
        <p>단순 번역을 넘어 "자연스러운 한국어 비즈니스 문체로 번역해줘" 처럼 톤·스타일도 함께 지정할 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-envelope"></i></div>
        <div class="concept-card__title">이메일·제안서 작성</div>
        <p>상황을 설명하면 격식 있는 비즈니스 이메일이나 제안서 초안을 즉시 작성해줍니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-lightbulb"></i></div>
        <div class="concept-card__title">아이디어 발산</div>
        <p>프로젝트 이름, 마케팅 캠페인 아이디어, 콘텐츠 주제 등을 브레인스토밍할 때 AI를 파트너로 활용하세요.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-spell-check"></i></div>
        <div class="concept-card__title">교정·편집</div>
        <p>작성한 글을 붙여넣고 "맞춤법과 문장을 다듬어줘"라고 요청하면 빠르게 퇴고할 수 있습니다.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
