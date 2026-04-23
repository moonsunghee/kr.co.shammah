<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'AI 자동화 워크플로 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--advanced" style="margin-top:16px;display:inline-block;">고급</span>
    <h1 class="ai-sub-hero__title">AI 자동화 워크플로</h1>
    <p class="ai-sub-hero__desc">n8n, Make 같은 자동화 도구에 AI를 연동해 반복 업무를 완전히 자동화합니다. 코딩 없이도 강력한 AI 워크플로를 구축할 수 있습니다.</p>
  </div>
</div>

<!-- 자동화 플랫폼 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 자동화 플랫폼</h2>
  <p class="ai-sub-section__lead">노코드·로우코드 자동화 플랫폼에 AI API를 연결해 스마트한 워크플로를 만드세요.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#E8480C;color:#fff;"><i class="fa-solid fa-diagram-project"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">n8n</div>
          <span class="tool-card__tag">n8n GmbH · 무료(셀프호스팅)/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">오픈소스 워크플로 자동화 도구. 400개 이상의 서비스와 연동되며 AI 노드가 내장되어 있습니다. 셀프 호스팅이 가능해 데이터 보안이 중요한 기업에 적합합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">AI Agent 노드 — Claude·GPT 직접 연동</div>
        <div class="tool-card__feature">400+ 서비스 연동 (Gmail, Slack, Notion 등)</div>
        <div class="tool-card__feature">조건 분기, 루프 등 복잡한 로직 구현</div>
        <div class="tool-card__feature">셀프 호스팅 시 무료 사용 가능</div>
      </div>
      <a href="https://n8n.io" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#A259FF;color:#fff;"><i class="fa-solid fa-gears"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Make (구 Integromat)</div>
          <span class="tool-card__tag">Make · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">직관적인 시각적 인터페이스로 워크플로를 구성하는 자동화 플랫폼. 1,500개 이상의 앱을 연동할 수 있으며 AI 모듈을 통해 ChatGPT, Claude API를 쉽게 연결합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">드래그앤드롭으로 시각적 워크플로 구성</div>
        <div class="tool-card__feature">1,500+ 앱 연동 지원</div>
        <div class="tool-card__feature">AI·ChatGPT 모듈 기본 제공</div>
        <div class="tool-card__feature">무료 플랜: 월 1,000 작업 실행 가능</div>
      </div>
      <a href="https://www.make.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF4A00;color:#fff;"><i class="fa-solid fa-bolt"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Zapier</div>
          <span class="tool-card__tag">Zapier · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">가장 오래되고 널리 사용되는 자동화 플랫폼. 7,000개 이상의 앱을 연동하며 AI 기능이 내장되어 있습니다. 설정이 간단해 비개발자도 쉽게 사용할 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">7,000+ 앱 연동 (업계 최다)</div>
        <div class="tool-card__feature">Zapier AI — 자연어로 Zap 자동 생성</div>
        <div class="tool-card__feature">가장 간단한 설정 — 5분 안에 자동화 구축</div>
        <div class="tool-card__feature">무료 플랜: 월 100 작업 실행</div>
      </div>
      <a href="https://zapier.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF6B6B;color:#fff;"><i class="fa-solid fa-network-wired"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Claude API (직접 연동)</div>
          <span class="tool-card__tag">Anthropic · 사용량 기반</span>
        </div>
      </div>
      <p class="tool-card__desc">자동화 플랫폼 없이 Claude API를 직접 호출해 커스텀 워크플로를 구축합니다. PHP, Python, Node.js에서 HTTP 요청으로 Claude를 호출해 완전히 자유로운 자동화를 구현합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">완전한 커스터마이징 자유도</div>
        <div class="tool-card__feature">플랫폼 의존성 없음</div>
        <div class="tool-card__feature">배치 처리, 스케줄링 직접 구현 가능</div>
        <div class="tool-card__feature">입력 토큰당 과금 — 사용한 만큼만 지불</div>
      </div>
      <a href="https://www.anthropic.com/api" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> API 문서</a>
    </div>
  </div>
</div>

<!-- 실전 워크플로 예시 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">실전 AI 자동화 워크플로 예시</h2>
    <p class="ai-sub-section__lead">바로 적용할 수 있는 자동화 시나리오입니다.</p>

    <div class="step-list">
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-envelope" style="font-size:13px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">이메일 자동 분류 및 답장 초안 작성</div>
          <p>Gmail 수신 → n8n/Make에서 이메일 내용 추출 → Claude API로 카테고리 분류 + 답장 초안 생성 → Notion에 정리 또는 초안 이메일로 발송</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num"><i class="fa-brands fa-instagram" style="font-size:13px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">SNS 콘텐츠 자동 생성 및 예약 발행</div>
          <p>블로그 RSS 피드 → 새 글 감지 → Claude로 SNS 맞춤 요약문 생성 → Midjourney API로 썸네일 생성 → Buffer/Hootsuite 예약 발행</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-chart-line" style="font-size:13px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">주간 비즈니스 리포트 자동화</div>
          <p>Google Sheets에서 주간 데이터 수집 → Claude로 분석 및 인사이트 도출 → 리포트 문서 자동 생성 → Slack/이메일로 팀에 자동 전송</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-headset" style="font-size:13px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">고객 문의 자동 응답 시스템</div>
          <p>웹사이트 문의 폼 제출 → Claude로 문의 내용 분석 및 FAQ 기반 답변 생성 → 1차 자동 답장 발송 → 복잡한 문의만 담당자에게 전달</p>
        </div>
      </div>
    </div>

    <div class="tip-box">
      <div class="tip-box__title">자동화 시작 전 체크리스트</div>
      <p>
        1. <strong>반복 빈도 확인</strong>: 매일 또는 매주 반복하는 작업인가요? (그래야 자동화 효과가 큽니다)<br>
        2. <strong>오류 처리 계획</strong>: AI 결과물이 잘못되었을 때 어떻게 처리할지 설계하세요<br>
        3. <strong>작은 것부터 시작</strong>: 3단계 이하의 간단한 워크플로로 먼저 시작해 경험을 쌓으세요<br>
        4. <strong>비용 모니터링</strong>: API 호출 비용을 모니터링해 예상치 못한 과금을 방지하세요
      </p>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
