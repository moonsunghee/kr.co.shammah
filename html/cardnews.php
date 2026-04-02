<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = 'AI 카드뉴스 생성기 | 삼마디자인';
$currentPage = 'cardnews';
$pageCSS     = 'cardnews.css';
$pageJS      = 'cardnews.js';

include 'includes/header.php';
?>

<div class="cn-page">

  <!-- ── SIDEBAR ── -->
  <aside class="cn-sidebar">
    <div class="cn-sidebar-header">
      <h2>✦ AI 카드뉴스 생성기</h2>
      <p>주제를 입력하면 AI가 카드뉴스를 자동으로 만들어드립니다.</p>
    </div>

    <div class="cn-sidebar-body">

      <!-- API 키 -->
      <div class="cn-form-group">
        <label>Claude API Key</label>
        <input type="password" id="cn-api-key" placeholder="sk-ant-api03-..." autocomplete="off">
        <div class="cn-api-hint">
          <a href="https://console.anthropic.com/" target="_blank" rel="noopener">console.anthropic.com</a>에서 발급
        </div>
        <div id="cn-key-badge"></div>
      </div>

      <!-- 키워드 / 주제 -->
      <div class="cn-form-group">
        <label>키워드 / 주제</label>
        <input type="text" id="cn-topic" placeholder="예: AI, ChatGPT, 마케팅 트렌드..." value="AI 인공지능">
      </div>

      <!-- 색상 테마 -->
      <div class="cn-form-group">
        <label>카드 색상 테마</label>
        <div class="cn-color-row" id="cn-theme-picker">
          <div class="cn-swatch active" data-theme="dark"    style="background: linear-gradient(135deg,#111827,#1f2937)" title="다크"></div>
          <div class="cn-swatch"        data-theme="violet"  style="background: linear-gradient(135deg,#4c1d95,#7c3aed)" title="바이올렛"></div>
          <div class="cn-swatch"        data-theme="blue"    style="background: linear-gradient(135deg,#1e3a8a,#2563eb)" title="블루"></div>
          <div class="cn-swatch"        data-theme="green"   style="background: linear-gradient(135deg,#064e3b,#059669)" title="그린"></div>
          <div class="cn-swatch"        data-theme="rose"    style="background: linear-gradient(135deg,#881337,#e11d48)" title="로즈"></div>
        </div>
      </div>

      <!-- 브랜드명 -->
      <div class="cn-form-group">
        <label>브랜드명 (선택)</label>
        <input type="text" id="cn-brand" placeholder="예: 삼마디자인, AI Daily...">
      </div>

      <!-- 생성 버튼 -->
      <button type="button" id="cn-btn-generate">✦ 카드뉴스 생성하기</button>

      <!-- 카드 썸네일 목록 -->
      <div id="cn-thumb-section" style="display:none;">
        <div class="cn-form-group">
          <label>생성된 카드</label>
        </div>
        <div class="cn-thumb-list" id="cn-thumb-list"></div>
      </div>

    </div><!-- /sidebar-body -->
  </aside>

  <!-- ── MAIN ── -->
  <main class="cn-main">

    <!-- 빈 상태 -->
    <div class="cn-empty" id="cn-empty">
      <div class="icon">📱</div>
      <h3>AI 카드뉴스를 자동으로 만들어요</h3>
      <p>최신 뉴스를 수집하고 인스타그램용<br>카드 이미지를 단 3단계로 생성합니다.</p>
      <div class="cn-step-list">
        <div class="cn-step-item"><div class="cn-step-badge">1</div> Claude API 키와 키워드를 입력하세요</div>
        <div class="cn-step-item"><div class="cn-step-badge">2</div> 생성 버튼 클릭 → AI가 뉴스를 수집·편집</div>
        <div class="cn-step-item"><div class="cn-step-badge">3</div> 카드 미리보기 후 PNG로 다운로드</div>
      </div>
    </div>

    <!-- 로딩 -->
    <div class="cn-loading" id="cn-loading">
      <div class="cn-spinner"></div>
      <div class="cn-loading-text" id="cn-loading-text">뉴스 수집 중...</div>
      <div class="cn-loading-sub" id="cn-loading-sub">Google News에서 최신 기사를 가져오고 있어요</div>
      <div class="cn-dots">
        <div class="cn-dot"></div>
        <div class="cn-dot"></div>
        <div class="cn-dot"></div>
      </div>
    </div>

    <!-- 미리보기 -->
    <div class="cn-preview" id="cn-preview">
      <div class="cn-display-wrap">
        <button class="cn-nav-arrow" id="cn-prev" disabled>&#8249;</button>
        <div class="cn-display" id="cn-display">
          <div class="cn-card-inner" id="cn-card-inner"></div>
        </div>
        <button class="cn-nav-arrow" id="cn-next">&#8250;</button>
      </div>
      <div class="cn-counter" id="cn-counter">1 / 1</div>
      <div class="cn-dl-row">
        <button class="cn-btn-dl cn-btn-dl-single" id="cn-dl-single">⬇ 현재 카드 저장</button>
        <button class="cn-btn-dl cn-btn-dl-all" id="cn-dl-all">⬇ 전체 ZIP 저장</button>
      </div>
    </div>

  </main>

</div><!-- /cn-page -->

<!-- 오프스크린 렌더링 영역 -->
<div class="cn-render-area" id="cn-render-area"></div>

<!-- 에러 토스트 -->
<div id="cn-error-toast"></div>

<!-- html2canvas + JSZip (footer JS보다 먼저 로드) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<?php include 'includes/footer.php'; ?>
