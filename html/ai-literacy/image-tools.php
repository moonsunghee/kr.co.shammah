<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '이미지 생성 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--beginner" style="margin-top:16px;display:inline-block;">초급</span>
    <h1 class="ai-sub-hero__title">이미지 생성 도구</h1>
    <p class="ai-sub-hero__desc">텍스트 설명(프롬프트)으로 이미지를 만드는 AI 도구들을 소개합니다. 디자인 전공 없이도 고품질 이미지를 제작할 수 있습니다.</p>
  </div>
</div>

<!-- 도구 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 이미지 생성 도구</h2>
  <p class="ai-sub-section__lead">각 도구마다 화풍과 강점이 다릅니다. 목적에 맞는 도구를 선택하세요.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#E55B4D;color:#fff;"><i class="fa-solid fa-palette"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Midjourney</div>
          <span class="tool-card__tag">Midjourney Inc. · 유료</span>
        </div>
      </div>
      <p class="tool-card__desc">현재 가장 높은 품질의 이미지를 생성하는 도구로 평가받습니다. Discord 또는 웹 인터페이스에서 사용하며, 예술적이고 감각적인 결과물이 특징입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">사진 수준의 사실적 이미지 생성</div>
        <div class="tool-card__feature">다양한 예술 스타일 지원 (유화, 수채화, 3D 등)</div>
        <div class="tool-card__feature">이미지 편집·변형·확장 기능</div>
        <div class="tool-card__feature">월 $10부터 시작 (무료 플랜 없음)</div>
      </div>
      <a href="https://www.midjourney.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#74AA9C;color:#fff;"><i class="fa-solid fa-wand-sparkles"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">DALL-E 3</div>
          <span class="tool-card__tag">OpenAI · 무료(ChatGPT 내장)</span>
        </div>
      </div>
      <p class="tool-card__desc">ChatGPT에 통합된 이미지 생성 모델. 텍스트 프롬프트를 정확하게 반영하는 능력이 뛰어나며, ChatGPT와 대화하듯 이미지를 수정할 수 있어 초보자에게 편리합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">ChatGPT에서 바로 사용 (별도 가입 불필요)</div>
        <div class="tool-card__feature">프롬프트 지시사항 정확하게 반영</div>
        <div class="tool-card__feature">대화로 이미지 수정·변형 가능</div>
        <div class="tool-card__feature">ChatGPT 무료 플랜에서 제한적 사용 가능</div>
      </div>
      <a href="https://chatgpt.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> ChatGPT에서 사용</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#6C5CE7;color:#fff;"><i class="fa-solid fa-image"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Stable Diffusion</div>
          <span class="tool-card__tag">Stability AI · 무료(오픈소스)</span>
        </div>
      </div>
      <p class="tool-card__desc">오픈소스 이미지 생성 모델. 로컬 PC에 설치하거나 다양한 웹 서비스를 통해 사용할 수 있습니다. 무제한 생성이 가능하고 커스터마이징 자유도가 높아 고급 사용자에게 적합합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">오픈소스 — 로컬 설치 시 무제한 무료 사용</div>
        <div class="tool-card__feature">커스텀 모델, LoRA 등 고급 기능 지원</div>
        <div class="tool-card__feature">Civitai 등 커뮤니티 모델 활용 가능</div>
        <div class="tool-card__feature">고사양 GPU 필요 (로컬 설치 시)</div>
      </div>
      <a href="https://stability.ai" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF0000;color:#fff;"><i class="fa-brands fa-adobe"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Adobe Firefly</div>
          <span class="tool-card__tag">Adobe · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Adobe가 만든 이미지 생성 AI로 상업적 사용이 안전합니다. Adobe Stock의 라이선스 이미지로 학습해 저작권 문제가 적으며, Photoshop·Illustrator와 통합됩니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">상업적 사용 가능 (저작권 안전)</div>
        <div class="tool-card__feature">Photoshop의 생성형 채우기와 통합</div>
        <div class="tool-card__feature">텍스트 효과, 벡터 생성 지원</div>
        <div class="tool-card__feature">월 25크레딧 무료 제공</div>
      </div>
      <a href="https://firefly.adobe.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#F9A825;color:#fff;"><i class="fa-solid fa-banana"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">나노바나나 (Nano Banana)</div>
          <span class="tool-card__tag">Google Gemini 기반 · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Google Gemini 기술 기반의 이미지 생성·편집 도구. 한 번 만든 캐릭터를 다른 포즈·배경에서도 일관되게 유지하는 캐릭터 일관성이 특히 뛰어납니다. 이미지 합성과 자연스러운 편집에 강점을 보입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">캐릭터 일관성 — 동일 캐릭터 포즈·배경 변환</div>
        <div class="tool-card__feature">최대 14장 이미지를 1장으로 합성</div>
        <div class="tool-card__feature">4K 해상도 이미지 생성</div>
        <div class="tool-card__feature">자연어 명령으로 조명·분위기 자연스럽게 수정</div>
      </div>
      <a href="https://nanobanana.im" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">이미지 프롬프트 잘 쓰는 법</div>
    <p>
      <strong>[주제] + [스타일] + [분위기] + [기술 설정]</strong> 순서로 작성하세요.<br>
      예: "A Korean woman working at a cafe, watercolor illustration style, warm soft lighting, pastel colors, high detail"<br>
      영어 프롬프트가 대부분의 도구에서 더 좋은 결과를 냅니다.
    </p>
  </div>
</div>

<!-- 활용 분야 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">이미지 AI 활용 분야</h2>
    <p class="ai-sub-section__lead">디자인 작업 시간을 크게 줄여주는 실용적인 활용 사례입니다.</p>

    <div class="concept-grid">
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-bullhorn"></i></div>
        <div class="concept-card__title">SNS·마케팅 이미지</div>
        <p>브랜드 분위기에 맞는 광고 배너, 카드뉴스 배경, 썸네일을 빠르게 제작합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-sitemap"></i></div>
        <div class="concept-card__title">UI/UX 목업</div>
        <p>앱·웹 디자인 아이디어를 시각화하거나 프레젠테이션용 목업 이미지를 만듭니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-book-open"></i></div>
        <div class="concept-card__title">콘텐츠 일러스트</div>
        <p>블로그, 전자책, 교육 자료에 사용할 독자적인 일러스트레이션을 제작합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-building"></i></div>
        <div class="concept-card__title">인테리어·건축 시각화</div>
        <p>공간 디자인 컨셉이나 인테리어 아이디어를 이미지로 시각화해 고객에게 제안합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-shirt"></i></div>
        <div class="concept-card__title">제품·패션 디자인</div>
        <p>의류, 패키지, 제품 디자인 초안을 빠르게 시각화해 팀과 공유할 수 있습니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon"><i class="fa-solid fa-user-circle"></i></div>
        <div class="concept-card__title">프로필·캐릭터</div>
        <p>브랜드 캐릭터, SNS 프로필 이미지, 웹툰 캐릭터 초안을 제작합니다.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
