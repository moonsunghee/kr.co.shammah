<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '음악·음성 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--intermediate" style="margin-top:16px;display:inline-block;">중급</span>
    <h1 class="ai-sub-hero__title">음악·음성 도구</h1>
    <p class="ai-sub-hero__desc">음악 제작 경험 없이도 AI로 배경음악을 만들고, 자연스러운 AI 음성으로 내레이션을 제작할 수 있습니다.</p>
  </div>
</div>

<!-- 음악 생성 도구 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">음악 생성 도구</h2>
  <p class="ai-sub-section__lead">장르, 분위기, 가사를 입력하면 AI가 완성된 음악을 만들어줍니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF6B6B;color:#fff;"><i class="fa-solid fa-music"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Suno AI</div>
          <span class="tool-card__tag">Suno · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">현재 가장 인기 있는 AI 음악 생성 도구. 가사와 장르를 입력하면 보컬이 있는 완성된 노래를 생성합니다. 한국어 가사도 지원하며 결과물의 완성도가 높습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">가사 입력으로 보컬 포함 완성 음악 생성</div>
        <div class="tool-card__feature">다양한 장르 지원 (팝, 록, 재즈, K-pop 등)</div>
        <div class="tool-card__feature">한국어 가사 지원</div>
        <div class="tool-card__feature">무료 플랜: 하루 5곡 생성 가능</div>
      </div>
      <a href="https://suno.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#6C5CE7;color:#fff;"><i class="fa-solid fa-headphones"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Udio</div>
          <span class="tool-card__tag">Udio · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Suno와 함께 음악 AI 분야 양대 산맥. 세밀한 스타일 조정과 높은 음질이 특징입니다. 태그 기반으로 음악 스타일을 정밀하게 제어할 수 있어 전문적인 결과물을 원할 때 적합합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">태그로 세밀한 음악 스타일 제어</div>
        <div class="tool-card__feature">악기, BPM, 분위기 등 상세 설정</div>
        <div class="tool-card__feature">고품질 오디오 출력</div>
        <div class="tool-card__feature">무료 플랜: 월 일정 크레딧 제공</div>
      </div>
      <a href="https://www.udio.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>
</div>

<!-- 음성 생성 도구 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">AI 음성(TTS) 도구</h2>
    <p class="ai-sub-section__lead">텍스트를 자연스러운 음성으로 변환합니다. 팟캐스트, 영상 내레이션, 오디오북에 활용하세요.</p>

    <div class="tool-grid">
      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-microphone"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">ElevenLabs</div>
            <span class="tool-card__tag">ElevenLabs · 무료/유료</span>
          </div>
        </div>
        <p class="tool-card__desc">현재 가장 자연스러운 AI 음성을 제공하는 도구. 감정, 속도, 억양을 세밀하게 조절할 수 있으며, 내 목소리를 클론해 AI 음성으로 만드는 것도 가능합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">업계 최고 수준의 자연스러운 음성 품질</div>
          <div class="tool-card__feature">30개 이상 언어 지원 (한국어 포함)</div>
          <div class="tool-card__feature">목소리 클로닝 — 내 목소리로 AI 생성</div>
          <div class="tool-card__feature">무료 플랜: 월 10,000자 생성 가능</div>
        </div>
        <a href="https://elevenlabs.io" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#FF4081;color:#fff;"><i class="fa-solid fa-waveform-lines"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Adobe Podcast (Enhance)</div>
            <span class="tool-card__tag">Adobe · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">음성 품질을 AI로 개선하는 도구. 녹음된 음성의 배경 소음을 제거하고 스튜디오 품질로 향상시켜줍니다. 직접 목소리를 녹음하는 경우 반드시 거쳐야 할 도구입니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">AI 노이즈 제거 — 배경 소음 완전 제거</div>
          <div class="tool-card__feature">마이크 품질을 스튜디오 수준으로 향상</div>
          <div class="tool-card__feature">웹 브라우저에서 무료로 사용 가능</div>
          <div class="tool-card__feature">파일 업로드만으로 즉시 처리</div>
        </div>
        <a href="https://podcast.adobe.com/enhance" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
      </div>
    </div>

    <div class="tip-box">
      <div class="tip-box__title">활용 시나리오</div>
      <p>
        <strong>유튜브 내레이션</strong>: ElevenLabs로 음성 생성 → Adobe Podcast Enhance로 품질 향상<br>
        <strong>배경음악</strong>: Suno로 영상 분위기에 맞는 음악 생성 → 영상 편집 프로그램에서 합성<br>
        <strong>팟캐스트</strong>: 직접 녹음 → Adobe Enhance로 노이즈 제거 → 편집
      </p>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
