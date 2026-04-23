<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'AI 코딩 도구 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--intermediate" style="margin-top:16px;display:inline-block;">중급</span>
    <h1 class="ai-sub-hero__title">AI 코딩 도구</h1>
    <p class="ai-sub-hero__desc">개발자의 생산성을 높이는 AI 코딩 도구들을 소개합니다. 반복 작업을 자동화하고 더 빠르게 코드를 작성하세요.</p>
  </div>
</div>

<!-- 도구 소개 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">주요 AI 코딩 도구</h2>
  <p class="ai-sub-section__lead">코드 자동완성, AI 채팅, 자율 에이전트까지 — 개발 방식을 바꾸는 도구들입니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#24292E;color:#fff;"><i class="fa-brands fa-github"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">GitHub Copilot</div>
          <span class="tool-card__tag">GitHub · 유료 ($10/월)</span>
        </div>
      </div>
      <p class="tool-card__desc">VS Code, JetBrains 등 IDE에 통합되어 실시간으로 코드를 자동완성해주는 도구. 함수 이름과 주석만 작성하면 전체 구현을 제안합니다. 현재 가장 많이 사용되는 AI 코딩 보조 도구입니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">IDE 통합 — 코딩 흐름을 끊지 않는 자동완성</div>
        <div class="tool-card__feature">50개 이상 프로그래밍 언어 지원</div>
        <div class="tool-card__feature">테스트 코드, 주석 자동 생성</div>
        <div class="tool-card__feature">학생·오픈소스 기여자 무료 사용 가능</div>
      </div>
      <a href="https://github.com/features/copilot" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-terminal"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Cursor</div>
          <span class="tool-card__tag">Anysphere · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">AI 기능이 내장된 코드 에디터. VS Code를 기반으로 만들어져 기존 설정을 그대로 사용할 수 있습니다. 코드베이스 전체를 이해하고 여러 파일에 걸친 수정을 한 번에 처리합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">프로젝트 전체 코드 컨텍스트 이해</div>
        <div class="tool-card__feature">자연어로 여러 파일 동시 수정</div>
        <div class="tool-card__feature">오류 자동 감지 및 수정 제안</div>
        <div class="tool-card__feature">무료 플랜: 월 2,000회 자동완성 제공</div>
      </div>
      <a href="https://www.cursor.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#74AA9C;color:#fff;"><i class="fa-solid fa-terminal"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Codex CLI</div>
          <span class="tool-card__tag">OpenAI · 무료(오픈소스)</span>
        </div>
      </div>
      <p class="tool-card__desc">OpenAI가 개발한 터미널 기반 AI 코딩 에이전트. 오픈소스로 공개되어 있으며 월 300만 명 이상이 사용합니다. 코드 리뷰, 서브에이전트 병렬 처리, MCP 연동을 지원하며 Rust로 제작돼 빠릅니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">터미널에서 파일 읽기·수정·실행 자율 처리</div>
        <div class="tool-card__feature">서브에이전트로 복잡한 작업 병렬 처리</div>
        <div class="tool-card__feature">MCP 지원으로 서드파티 도구 연동</div>
        <div class="tool-card__feature">설치: npm i -g @openai/codex</div>
      </div>
      <a href="https://openai.com/codex/" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#D97757;color:#fff;"><i class="fa-solid fa-code-branch"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Claude Code</div>
          <span class="tool-card__tag">Anthropic · 유료 (API 사용량)</span>
        </div>
      </div>
      <p class="tool-card__desc">터미널에서 실행하는 AI 코딩 에이전트. 단순 자동완성을 넘어 파일 읽기·쓰기, 명령어 실행, Git 관리까지 자율적으로 처리합니다. 복잡한 기능 구현이나 리팩토링 작업에 강력합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">자율 에이전트 — 파일·터미널 직접 제어</div>
        <div class="tool-card__feature">코드베이스 전체 분석 및 수정</div>
        <div class="tool-card__feature">Git 커밋, PR 생성 자동화</div>
        <div class="tool-card__feature">MCP 연동으로 기능 무한 확장</div>
      </div>
      <a href="https://claude.ai/code" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Gemini CLI</div>
          <span class="tool-card__tag">Google · 무료(오픈소스)</span>
        </div>
      </div>
      <p class="tool-card__desc">Google이 개발한 오픈소스 터미널 AI 에이전트. Gemini 2.5 Pro 모델을 개인 Google 계정으로 무료로 사용할 수 있습니다. 100만 토큰 컨텍스트 창과 Google Search 연동이 기본 내장되어 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">개인 Google 계정으로 무료 사용 (넉넉한 한도)</div>
        <div class="tool-card__feature">100만 토큰 컨텍스트 — 대규모 코드베이스 분석</div>
        <div class="tool-card__feature">Google Search 그라운딩 기본 내장</div>
        <div class="tool-card__feature">설치: npx @google/gemini-cli 또는 npm 전역 설치</div>
      </div>
      <a href="https://github.com/google-gemini/gemini-cli" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> GitHub 방문</a>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#0E7490;color:#fff;"><i class="fa-solid fa-wind"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Windsurf</div>
          <span class="tool-card__tag">Codeium · 무료/유료</span>
        </div>
      </div>
      <p class="tool-card__desc">Cursor와 유사한 AI 코드 에디터로 Codeium이 개발했습니다. Cascade 에이전트가 코드베이스를 분석하고 여러 파일을 함께 수정합니다. 무료 플랜이 비교적 넉넉해 입문용으로 적합합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Cascade 에이전트 — 다중 파일 자율 수정</div>
        <div class="tool-card__feature">코드 실행·테스트 결과 자동 반영</div>
        <div class="tool-card__feature">VS Code 확장 프로그램으로도 사용 가능</div>
        <div class="tool-card__feature">무료 플랜: 월 일정 크레딧 제공</div>
      </div>
      <a href="https://windsurf.com" target="_blank" rel="noopener" class="tool-card__link"><i class="fa-solid fa-arrow-up-right-from-square"></i> 사이트 방문</a>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">비개발자도 AI 코딩 도구를 활용할 수 있나요?</div>
    <p>네, 가능합니다. Cursor나 Windsurf에서 "엑셀 파일을 읽어서 고객 이름을 추출하는 파이썬 스크립트를 만들어줘"처럼 자연어로 요청하면 코딩 지식 없이도 간단한 자동화 도구를 만들 수 있습니다. 결과물을 이해하고 검토하는 능력을 함께 키우는 것을 권장합니다.</p>
  </div>
</div>

<!-- CLI 설치 방법 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">CLI 설치 방법</h2>
  <p class="ai-sub-section__lead">터미널에서 바로 실행하는 AI 코딩 도구들의 설치 명령어입니다.</p>

  <div class="cli-grid">
    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#D97757;color:#fff;"><i class="fa-solid fa-code-branch"></i></div>
        <div>
          <div class="cli-card__name">Claude Code</div>
          <span class="cli-card__req">Node.js 18+ · Anthropic API 키 또는 Pro/Max 구독</span>
        </div>
      </div>
      <code class="cli-card__cmd">npm install -g @anthropic-ai/claude-code</code>
    </div>

    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
        <div>
          <div class="cli-card__name">Gemini CLI</div>
          <span class="cli-card__req">Node.js 18+ · Google 계정 (무료)</span>
        </div>
      </div>
      <code class="cli-card__cmd">npm install -g @google/gemini-cli</code>
    </div>

    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#74AA9C;color:#fff;"><i class="fa-solid fa-terminal"></i></div>
        <div>
          <div class="cli-card__name">Codex CLI</div>
          <span class="cli-card__req">Node.js 18+ · OpenAI API 키</span>
        </div>
      </div>
      <code class="cli-card__cmd">npm install -g @openai/codex</code>
    </div>

    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#7C3AED;color:#fff;"><i class="fa-solid fa-robot"></i></div>
        <div>
          <div class="cli-card__name">Aider</div>
          <span class="cli-card__req">Python 3.10+ · OpenAI/Anthropic 등 API 키</span>
        </div>
      </div>
      <code class="cli-card__cmd">pip install aider-chat</code>
    </div>

    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#24292E;color:#fff;"><i class="fa-brands fa-github"></i></div>
        <div>
          <div class="cli-card__name">GitHub Copilot CLI</div>
          <span class="cli-card__req">GitHub CLI 필요 · Copilot 구독 ($10/월)</span>
        </div>
      </div>
      <code class="cli-card__cmd">brew install gh</code>
      <code class="cli-card__cmd" style="margin-top:6px;">gh extension install github/gh-copilot</code>
    </div>

    <div class="cli-card">
      <div class="cli-card__header">
        <div class="cli-card__icon" style="background:#FF9900;color:#fff;"><i class="fa-brands fa-aws"></i></div>
        <div>
          <div class="cli-card__name">Amazon Q Developer CLI</div>
          <span class="cli-card__req">macOS · AWS Builder ID (무료 티어 있음)</span>
        </div>
      </div>
      <code class="cli-card__cmd">brew install --cask amazon-q</code>
    </div>
  </div>
</div>

<!-- 활용 시나리오 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">개발 단계별 활용법</h2>
    <p class="ai-sub-section__lead">코딩 작업의 모든 단계에서 AI를 파트너로 활용하세요.</p>

    <div class="step-list">
      <div class="step-item">
        <div class="step-item__num">1</div>
        <div class="step-item__body">
          <div class="step-item__title">기획·설계</div>
          <p>구현하려는 기능을 AI에게 설명하고 아키텍처, 데이터 구조, 사용할 라이브러리를 추천받으세요.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num">2</div>
        <div class="step-item__body">
          <div class="step-item__title">코드 작성</div>
          <p>반복적인 보일러플레이트 코드, CRUD 함수, API 연동 코드는 AI에게 초안을 생성하게 하고 검토 후 사용합니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num">3</div>
        <div class="step-item__body">
          <div class="step-item__title">디버깅</div>
          <p>오류 메시지를 그대로 붙여넣으면 원인과 해결 방법을 설명해줍니다. 스택 트레이스 분석도 가능합니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num">4</div>
        <div class="step-item__body">
          <div class="step-item__title">코드 리뷰·리팩토링</div>
          <p>작성한 코드를 붙여넣고 "성능 개선점과 보안 취약점을 찾아줘"라고 요청해 코드 품질을 높이세요.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num">5</div>
        <div class="step-item__body">
          <div class="step-item__title">테스트 코드 작성</div>
          <p>함수 코드를 제공하면 단위 테스트, 엣지 케이스 테스트 코드를 자동으로 생성해줍니다.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
