<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '주요 AI 에이전트 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--expert" style="margin-top:16px;display:inline-block;">특급</span>
    <h1 class="ai-sub-hero__title">주요 AI 에이전트</h1>
    <p class="ai-sub-hero__desc">Devin, Manus, Claude Code 등 실무에서 쓰이는 AI 에이전트 도구를 목적별로 비교합니다.</p>
  </div>
</div>

<!-- 도구 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 AI 에이전트 도구</h2>
  <p class="ai-sub-section__lead">코딩 전문 에이전트부터 범용 에이전트, 비개발자용 에이전트 빌더까지 — 목적에 맞는 도구를 선택하세요.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-laptop-code"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Devin</div>
          <span class="tool-card__tag">Cognition AI · 유료</span>
        </div>
      </div>
      <p class="tool-card__desc">세계 최초의 소프트웨어 엔지니어 AI 에이전트. 기능 명세를 주면 코드를 작성하고 테스트를 실행하며 버그를 수정합니다. 깃허브 이슈를 받아 PR까지 자동으로 생성합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">자율 코딩 — 기획서로 완성 코드 생성</div>
        <div class="tool-card__feature">GitHub 이슈 자동 처리 및 PR 생성</div>
        <div class="tool-card__feature">레거시 코드 리팩토링·마이그레이션</div>
        <div class="tool-card__feature">팀 협업 모드 지원</div>
      </div>
      <a href="https://devin.ai" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#7C3AED;color:#fff;"><i class="fa-solid fa-hand-sparkles"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Manus</div>
          <span class="tool-card__tag">Butterfly Effect · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">코딩에 국한되지 않는 범용 AI 에이전트. 리서치, 문서 작성, 데이터 분석, 웹 브라우징을 포함한 복합 작업을 자율적으로 처리합니다. 사람이 자리를 비운 사이에도 작업을 이어갑니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">웹 브라우징 + 파일 처리 + 코딩 통합</div>
        <div class="tool-card__feature">복수 작업 병렬 실행</div>
        <div class="tool-card__feature">리서치 리포트 자동 생성</div>
        <div class="tool-card__feature">비동기 실행 — 결과만 확인 가능</div>
      </div>
      <a href="https://manus.im" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#D97757;color:#fff;"><i class="fa-solid fa-code-branch"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Claude Code</div>
          <span class="tool-card__tag">Anthropic · API 과금 / Pro 구독</span>
        </div>
      </div>
      <p class="tool-card__desc">터미널에서 실행하는 코딩 에이전트. 파일 읽기·수정, 명령어 실행, Git 관리까지 자율 처리합니다. 대규모 코드베이스 분석과 리팩토링에 강력하며 MCP로 기능을 무한 확장할 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">자율 에이전트 — 파일·터미널 직접 제어</div>
        <div class="tool-card__feature">Git 커밋, PR 생성 자동화</div>
        <div class="tool-card__feature">서브에이전트 병렬 처리</div>
        <div class="tool-card__feature">설치: npm install -g @anthropic-ai/claude-code</div>
      </div>
      <a href="https://claude.ai/code" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Gemini CLI</div>
          <span class="tool-card__tag">Google · 무료 (오픈소스)</span>
        </div>
      </div>
      <p class="tool-card__desc">Google이 공개한 오픈소스 터미널 에이전트. 개인 Google 계정만 있으면 Gemini 2.5 Pro를 무료로 사용할 수 있습니다. 100만 토큰 컨텍스트와 Google Search 그라운딩이 내장되어 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Google 계정으로 무료 사용 (넉넉한 한도)</div>
        <div class="tool-card__feature">100만 토큰 — 대규모 코드베이스 분석</div>
        <div class="tool-card__feature">Google Search 실시간 그라운딩</div>
        <div class="tool-card__feature">설치: npm install -g @google/gemini-cli</div>
      </div>
      <a href="https://github.com/google-gemini/gemini-cli" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> GitHub 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#10B981;color:#fff;"><i class="fa-solid fa-diagram-project"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">OpenAI Agents SDK</div>
          <span class="tool-card__tag">OpenAI · API 과금</span>
        </div>
      </div>
      <p class="tool-card__desc">개발자가 직접 에이전트를 만들 수 있는 프레임워크. 핸드오프(에이전트 간 작업 전달), 가드레일(안전장치), 멀티 에이전트 오케스트레이션을 지원합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">멀티 에이전트 — 역할 분담 자동화 파이프라인</div>
        <div class="tool-card__feature">핸드오프 — 에이전트 간 작업 인계</div>
        <div class="tool-card__feature">가드레일 — 입출력 안전 검증</div>
        <div class="tool-card__feature">Python SDK 제공</div>
      </div>
      <a href="https://openai.github.io/openai-agents-python/" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 문서 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#E84393;color:#fff;"><i class="fa-solid fa-sitemap"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">n8n AI Agent</div>
          <span class="tool-card__tag">n8n · 무료(셀프호스팅)/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">코드 없이 시각적 워크플로로 AI 에이전트를 구성하는 도구. Slack, Gmail, Google Sheets 등 400개 이상의 서비스와 연동해 업무 자동화 에이전트를 빠르게 만들 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">노코드 — 드래그&드롭으로 에이전트 구성</div>
        <div class="tool-card__feature">400+ 서비스 연동 (Slack, Gmail, Notion 등)</div>
        <div class="tool-card__feature">메모리 · 도구 · 트리거 시각적 설정</div>
        <div class="tool-card__feature">셀프호스팅으로 무료 운영 가능</div>
      </div>
      <a href="https://n8n.io" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">어떤 도구를 선택해야 할까요?</div>
    <p>코딩이 목적이라면 <strong>Claude Code</strong> 또는 <strong>Gemini CLI</strong>(무료)로 시작하세요. 비개발자가 업무 자동화를 원한다면 <strong>n8n AI Agent</strong>가 가장 쉽습니다. 완전 자율적인 범용 작업은 <strong>Manus</strong>, 대규모 소프트웨어 개발 자동화는 <strong>Devin</strong>이 적합합니다.</p>
  </div>
</div>

<!-- 유형별 비교 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">에이전트 유형별 비교</h2>
    <p class="ai-sub-section__lead">목적과 기술 수준에 따라 적합한 에이전트 유형이 다릅니다.</p>

    <div class="step-list">
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">1</div>
        <div class="step-item__body">
          <div class="step-item__title">코딩 에이전트 — Claude Code, Gemini CLI, Devin</div>
          <p>코드 작성·수정·디버깅에 특화. 개발자가 반복 작업을 위임하거나 비개발자가 간단한 스크립트를 만들 때 사용합니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">2</div>
        <div class="step-item__body">
          <div class="step-item__title">범용 에이전트 — Manus</div>
          <p>리서치, 문서 작성, 데이터 정리, 웹 브라우징 등 여러 유형의 작업을 하나의 에이전트가 처리합니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">3</div>
        <div class="step-item__body">
          <div class="step-item__title">자동화 에이전트 — n8n AI Agent</div>
          <p>반복 업무 자동화에 최적화. 특정 이벤트(이메일 수신, 폼 제출 등)를 트리거로 에이전트가 자동 실행됩니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">4</div>
        <div class="step-item__body">
          <div class="step-item__title">커스텀 에이전트 — OpenAI Agents SDK</div>
          <p>서비스에 내장할 전용 에이전트를 개발할 때 사용합니다. 멀티 에이전트 파이프라인 구성이 가능해 복잡한 비즈니스 로직을 자동화합니다.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
