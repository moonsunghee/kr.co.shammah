<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '영상 생성 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--intermediate" style="margin-top:16px;display:inline-block;">중급</span>
    <h1 class="ai-sub-hero__title">영상 생성 도구</h1>
    <p class="ai-sub-hero__desc">텍스트나 이미지로 짧은 영상을 만드는 AI 도구들을 소개합니다. 촬영 장비 없이도 영상 콘텐츠를 제작할 수 있습니다.</p>
  </div>
</div>

<!-- 도구 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 영상 생성 도구</h2>
  <p class="ai-sub-section__lead">AI 영상 생성 도구는 빠르게 발전하고 있습니다. 각 도구의 특징을 파악하고 활용하세요.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#00D4AA;color:#fff;"><i class="fa-solid fa-film"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Runway Gen-3</div>
          <span class="tool-card__tag">Runway · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">영상 AI 분야의 선두 주자. 텍스트-영상, 이미지-영상 변환이 모두 가능하며, 영상 편집 기능도 함께 제공합니다. 영화·광고 제작사들도 활용하는 전문가급 도구입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">텍스트 또는 이미지로 최대 10초 영상 생성</div>
        <div class="tool-card__feature">Motion Brush로 특정 영역만 움직이게 설정</div>
        <div class="tool-card__feature">카메라 움직임 제어 (패닝, 줌 등)</div>
        <div class="tool-card__feature">무료 플랜: 월 125크레딧 제공</div>
      </div>
      <a href="https://runwayml.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-brands fa-openai"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Sora</div>
          <span class="tool-card__tag">OpenAI · 유료 (ChatGPT Plus)</span>
        </div>
      </div>
      <p class="tool-card__desc">OpenAI가 개발한 텍스트-영상 변환 모델. 물리적으로 자연스러운 움직임과 높은 일관성이 특징입니다. ChatGPT Plus/Pro 구독자를 통해 사용 가능합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">최대 20초의 고품질 영상 생성</div>
        <div class="tool-card__feature">물리 법칙에 따른 자연스러운 움직임</div>
        <div class="tool-card__feature">1080p 해상도 지원</div>
        <div class="tool-card__feature">ChatGPT Plus($20/월) 이상 구독 필요</div>
      </div>
      <a href="https://sora.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF6B35;color:#fff;"><i class="fa-solid fa-video"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Kling AI</div>
          <span class="tool-card__tag">Kuaishou · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">중국 콰이쇼우(快手)가 개발한 영상 AI. 자연스러운 움직임과 높은 품질로 주목받고 있습니다. 최대 5분 길이의 영상을 생성할 수 있어 긴 영상 제작에도 활용됩니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">최대 5분 영상 생성 (업계 최장)</div>
        <div class="tool-card__feature">사람 동작의 자연스러운 표현</div>
        <div class="tool-card__feature">이미지-영상, 텍스트-영상 모두 지원</div>
        <div class="tool-card__feature">무료 플랜: 일정 크레딧 무료 제공</div>
      </div>
      <a href="https://klingai.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#8B5CF6;color:#fff;"><i class="fa-solid fa-clapperboard"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Pika</div>
          <span class="tool-card__tag">Pika Labs · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">사용하기 쉬운 인터페이스로 영상을 생성하는 도구. 이미지에 움직임을 추가하거나, 기존 영상을 AI로 편집하는 기능이 편리합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">정지 이미지에 움직임 추가 (Animate)</div>
        <div class="tool-card__feature">영상 스타일 변환 기능</div>
        <div class="tool-card__feature">초보자도 쉽게 사용 가능한 UI</div>
        <div class="tool-card__feature">무료 플랜: 일정 생성 횟수 제공</div>
      </div>
      <a href="https://pika.art" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Veo 3</div>
          <span class="tool-card__tag">Google DeepMind · 무료(Google Vids)</span>
        </div>
      </div>
      <p class="tool-card__desc">Google DeepMind가 개발한 영상 생성 모델. 2026년 3월 출시된 Veo 3.1은 Google Vids에서 무료로 사용할 수 있습니다. 음성(대사)이 포함된 영상 생성이 가능하며, AI 배경음악 생성(Lyria)도 함께 지원합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">음성·대사가 포함된 영상 생성 (업계 최초 수준)</div>
        <div class="tool-card__feature">AI 배경음악 자동 생성 (Lyria 연동)</div>
        <div class="tool-card__feature">Google 계정으로 무료 사용 — 월 10회</div>
        <div class="tool-card__feature">Google Vids 또는 AI Studio에서 사용 가능</div>
      </div>
      <a href="https://aistudio.google.com/models/veo-3" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">영상 AI 활용 시 주의사항</div>
    <p>AI 생성 영상은 아직 손가락, 글자, 복잡한 동작 표현에 오류가 생길 수 있습니다. 짧은 클립(3-5초)으로 시작하고, 여러 번 생성해 가장 좋은 결과물을 선택하는 방식을 추천합니다. 생성된 영상은 반드시 상업적 이용 가능 여부를 확인하세요.</p>
  </div>
</div>

<!-- 활용 분야 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">영상 AI 활용 분야</h2>
    <p class="ai-sub-section__lead">촬영 없이도 다양한 영상 콘텐츠를 제작할 수 있습니다.</p>

    <div class="concept-grid">
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-brands fa-tiktok"></i></div>
        <div class="concept-card__title">쇼츠·릴스·틱톡</div>
        <p>15-60초 짧은 영상을 AI로 생성해 SNS 채널에 꾸준히 콘텐츠를 업로드할 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-tv"></i></div>
        <div class="concept-card__title">제품 광고 영상</div>
        <p>제품 이미지를 영상으로 변환하거나 브랜드 광고 클립을 저비용으로 제작합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-graduation-cap"></i></div>
        <div class="concept-card__title">교육 콘텐츠</div>
        <p>개념 설명을 시각화한 영상 클립을 만들어 강의나 교육 자료에 활용합니다.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
