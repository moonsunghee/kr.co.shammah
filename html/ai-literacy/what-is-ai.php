<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '생성형 AI란? | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--beginner" style="margin-top:16px;display:inline-block;">초급</span>
    <h1 class="ai-sub-hero__title">생성형 AI란?</h1>
    <p class="ai-sub-hero__desc">AI의 기본 개념부터 생성형 AI가 어떻게 작동하는지, 무엇을 만들 수 있는지 알기 쉽게 설명합니다.</p>
  </div>
</div>

<!-- 개념 설명 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">AI, 생성형 AI, LLM — 무엇이 다를까요?</h2>
  <p class="ai-sub-section__lead">AI(인공지능)는 컴퓨터가 사람처럼 학습하고 판단하는 기술 전반을 말합니다. 그 중 <strong>생성형 AI(Generative AI)</strong>는 텍스트·이미지·영상·음악 등 새로운 콘텐츠를 직접 만들어내는 AI입니다. <strong>LLM(대형 언어 모델)</strong>은 방대한 텍스트를 학습해 언어를 이해하고 생성하는 생성형 AI의 핵심 기술입니다.</p>

  <div class="concept-grid">
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-brain"></i></div>
      <div class="concept-card__title">AI (인공지능)</div>
      <p>컴퓨터가 사람처럼 학습·판단·예측하는 기술의 총칭. 번역, 추천, 음성인식 등 다양한 분야에 적용됩니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
      <div class="concept-card__title">생성형 AI</div>
      <p>기존 데이터를 학습해 새로운 콘텐츠(글, 이미지, 영상, 코드)를 만들어내는 AI. ChatGPT, Midjourney 등이 대표적입니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-layer-group"></i></div>
      <div class="concept-card__title">LLM (대형 언어 모델)</div>
      <p>수천억 개의 텍스트 데이터로 훈련된 모델. 질문 답변, 글쓰기, 요약, 번역 등 언어 관련 작업을 수행합니다.</p>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">쉽게 이해하기</div>
    <p>생성형 AI는 인터넷의 방대한 정보를 읽고 패턴을 익힌 뒤, 우리가 질문하면 그 패턴을 바탕으로 새로운 답변을 만들어냅니다. 마치 수만 권의 책을 읽은 전문가에게 질문하는 것과 비슷합니다.</p>
  </div>
</div>

<!-- 머신러닝 · 딥러닝 · 생성형 AI 비교 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">머신러닝 · 딥러닝 · 생성형 AI — 어떻게 다를까요?</h2>
    <p class="ai-sub-section__lead">생성형 AI는 머신러닝과 딥러닝 위에서 발전했습니다. 세 기술은 포함 관계에 있으며, 각각 할 수 있는 일이 다릅니다.</p>

    <div class="ai-hierarchy">
      <div class="ai-hier__level level--ai">
        <span class="ai-hier__label">AI <em>인공지능</em></span>
        <div class="ai-hier__level level--ml">
          <span class="ai-hier__label">머신러닝 <em>Machine Learning</em></span>
          <div class="ai-hier__level level--dl">
            <span class="ai-hier__label">딥러닝 <em>Deep Learning</em></span>
            <div class="ai-hier__level level--gen">
              <span class="ai-hier__label">생성형 AI <em>Generative AI</em></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="concept-grid" style="margin-top:32px;">
      <div class="concept-card">
        <div class="concept-card__icon" style="background:rgba(66,133,244,0.12);color:#4285F4;"><i class="fa-solid fa-chart-line"></i></div>
        <div class="concept-card__title">머신러닝 (ML)</div>
        <p>데이터를 주면 스스로 패턴을 학습해 예측·분류·추천을 수행하는 기술. 스팸 필터, 넷플릭스 추천, 신용점수 평가가 대표 사례입니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon" style="background:rgba(234,67,53,0.12);color:#EA4335;"><i class="fa-solid fa-network-wired"></i></div>
        <div class="concept-card__title">딥러닝 (DL)</div>
        <p>뇌의 신경망을 모방해 수백 개의 층을 쌓은 머신러닝의 하위 기술. 사람이 정의하지 않아도 스스로 특징을 추출합니다. 이미지·음성 인식에 강합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-wand-magic-sparkles"></i></div>
        <div class="concept-card__title">생성형 AI</div>
        <p>딥러닝을 기반으로 학습 데이터에 없던 새로운 콘텐츠를 직접 만들어내는 AI. 예측·분류를 넘어 창작이 가능한 단계입니다. ChatGPT, Midjourney가 대표 사례입니다.</p>
      </div>
    </div>

    <div class="tip-box">
      <div class="tip-box__title">핵심 차이 한 줄 요약</div>
      <p><strong>머신러닝</strong>은 "이 데이터가 무엇인지 맞힌다" → <strong>딥러닝</strong>은 "복잡한 패턴도 스스로 찾는다" → <strong>생성형 AI</strong>는 "학습한 것을 바탕으로 없던 것을 만든다"</p>
    </div>
  </div>
</div>

<!-- 생성형 AI로 만들 수 있는 것들 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">생성형 AI로 무엇을 만들 수 있나요?</h2>
    <p class="ai-sub-section__lead">텍스트부터 영상까지, 생성형 AI는 다양한 창작물을 만들어냅니다.</p>

    <div class="concept-grid">
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-comment-dots"></i></div>
        <div class="concept-card__title">텍스트</div>
        <p>블로그 글, 카피라이팅, 이메일, 보고서, 소설, 코드 등 모든 종류의 글을 생성합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-image"></i></div>
        <div class="concept-card__title">이미지</div>
        <p>프롬프트(설명 문장)를 입력하면 광고 배너, 일러스트, 로고 초안 등을 즉시 생성합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-film"></i></div>
        <div class="concept-card__title">영상</div>
        <p>텍스트나 이미지를 입력하면 짧은 영상 클립을 생성합니다. 쇼츠·릴스 제작에 활용됩니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-music"></i></div>
        <div class="concept-card__title">음악·음성</div>
        <p>장르와 분위기를 지정하면 배경음악을 생성하고, AI 목소리로 내레이션을 만들 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-code"></i></div>
        <div class="concept-card__title">코드</div>
        <p>원하는 기능을 설명하면 프로그래밍 코드를 작성해줍니다. 비개발자도 자동화 스크립트를 만들 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-file-powerpoint"></i></div>
        <div class="concept-card__title">문서·디자인</div>
        <p>PPT 슬라이드, 카드뉴스, 인포그래픽 등 시각 자료도 AI의 도움으로 빠르게 제작할 수 있습니다.</p>
      </div>
    </div>
  </div>
</div>

<!-- 시작하는 방법 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">생성형 AI, 어떻게 시작할까요?</h2>
  <p class="ai-sub-section__lead">복잡한 설정 없이 브라우저에서 바로 시작할 수 있습니다.</p>

  <div class="step-list">
    <div class="step-item">
      <div class="step-item__num">1</div>
      <div class="step-item__body">
        <div class="step-item__title">도구 선택</div>
        <p>텍스트는 ChatGPT 또는 Claude, 이미지는 DALL-E 3 또는 Midjourney에서 시작하세요. 모두 무료 플랜이 있습니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">2</div>
      <div class="step-item__body">
        <div class="step-item__title">회원가입 후 바로 사용</div>
        <p>이메일 주소만 있으면 5분 안에 가입하고 바로 사용할 수 있습니다. 별도 설치 없이 브라우저에서 동작합니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">3</div>
      <div class="step-item__body">
        <div class="step-item__title">프롬프트 작성</div>
        <p>AI에게 하고 싶은 작업을 자연어로 설명하는 것을 '프롬프트'라고 합니다. 구체적으로 쓸수록 결과가 좋아집니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">4</div>
      <div class="step-item__body">
        <div class="step-item__title">결과 검토 및 수정</div>
        <p>AI의 결과물은 항상 사람이 검토해야 합니다. 틀린 정보(환각 현상)가 있을 수 있으므로 중요한 내용은 반드시 확인하세요.</p>
      </div>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">좋은 프롬프트 작성 팁</div>
    <p>역할 + 작업 + 조건을 명확하게 써주세요. 예: "너는 마케터야. 30대 직장인을 대상으로 하는 건강식품 SNS 광고 문구 3개를 작성해줘. 각 문구는 30자 이내로 해줘."</p>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
