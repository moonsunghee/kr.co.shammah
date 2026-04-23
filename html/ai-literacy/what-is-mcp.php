<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'MCP란? | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--advanced" style="margin-top:16px;display:inline-block;">고급</span>
    <h1 class="ai-sub-hero__title">MCP란?</h1>
    <p class="ai-sub-hero__desc">Model Context Protocol(MCP)은 AI 모델이 외부 도구와 데이터에 접근하는 방식을 표준화한 프로토콜입니다. AI의 능력을 무한히 확장하는 핵심 기술입니다.</p>
  </div>
</div>

<!-- 개념 설명 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">MCP가 왜 필요한가요?</h2>
  <p class="ai-sub-section__lead">
    기존 AI는 대화창 안에서만 동작했습니다. 파일을 읽거나, 데이터베이스를 조회하거나, 외부 서비스를 호출하려면 개발자가 직접 연동 코드를 만들어야 했습니다.<br><br>
    MCP는 이 문제를 해결합니다. Anthropic이 2024년에 발표한 오픈 표준으로, AI와 외부 도구 사이의 <strong>공통 언어(프로토콜)</strong>를 정의합니다. MCP 서버만 만들면 Claude를 포함한 모든 MCP 지원 AI가 해당 도구를 바로 사용할 수 있습니다.
  </p>

  <div class="concept-grid">
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-plug"></i></div>
      <div class="concept-card__title">표준화된 연결</div>
      <p>USB처럼 한 번만 규격을 맞추면 어떤 AI와도 연결됩니다. 도구마다 별도 연동 코드가 필요 없습니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-shield-halved"></i></div>
      <div class="concept-card__title">로컬 실행</div>
      <p>MCP 서버는 내 컴퓨터에서 실행됩니다. 민감한 데이터가 외부로 전송되지 않아 보안에 유리합니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon"><i class="fa-solid fa-puzzle-piece"></i></div>
      <div class="concept-card__title">생태계 확장</div>
      <p>오픈소스로 공개된 MCP 서버가 수백 개 이상 존재합니다. 필요한 도구를 설치만 하면 바로 사용할 수 있습니다.</p>
    </div>
  </div>
</div>

<!-- 구조 설명 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">MCP 구조 이해하기</h2>
    <p class="ai-sub-section__lead">MCP는 세 가지 요소로 구성됩니다.</p>

    <div class="step-list">
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-robot" style="font-size:14px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">MCP 호스트 (AI 클라이언트)</div>
          <p>Claude Desktop, Claude Code, Cursor 등 AI가 실행되는 애플리케이션입니다. MCP 서버에 요청을 보냅니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-server" style="font-size:12px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">MCP 서버</div>
          <p>특정 기능을 제공하는 프로그램입니다. 파일 시스템 접근, GitHub API 호출, DB 조회 등 도구마다 MCP 서버가 있습니다. 로컬에서 실행됩니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num"><i class="fa-solid fa-database" style="font-size:12px;"></i></div>
        <div class="step-item__body">
          <div class="step-item__title">리소스 (실제 데이터)</div>
          <p>파일, 데이터베이스, 외부 API 등 MCP 서버가 접근하는 실제 데이터와 서비스입니다.</p>
        </div>
      </div>
    </div>

    <div class="tip-box">
      <div class="tip-box__title">쉽게 비유하면</div>
      <p>
        AI(Claude)가 <strong>직원</strong>이라면, MCP 서버는 <strong>부서별 시스템</strong>입니다.<br>
        파일 MCP = 문서 보관함 접근 권한<br>
        GitHub MCP = 개발 시스템 접근 권한<br>
        Notion MCP = 회사 위키 접근 권한<br><br>
        MCP가 있으면 AI 직원이 필요한 시스템에 직접 접근해 업무를 처리할 수 있습니다.
      </p>
    </div>
  </div>
</div>

<!-- MCP 시작하기 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">Claude Desktop에서 MCP 시작하기</h2>
  <p class="ai-sub-section__lead">Claude Desktop에 MCP 서버를 연결하는 기본 과정입니다.</p>

  <div class="step-list">
    <div class="step-item">
      <div class="step-item__num">1</div>
      <div class="step-item__body">
        <div class="step-item__title">Claude Desktop 설치</div>
        <p>claude.ai/download에서 Claude Desktop 앱을 다운로드해 설치합니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">2</div>
      <div class="step-item__body">
        <div class="step-item__title">Node.js 또는 Python 설치</div>
        <p>MCP 서버 실행에 필요합니다. Node.js(nodejs.org) 또는 Python(python.org)을 설치하세요.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">3</div>
      <div class="step-item__body">
        <div class="step-item__title">설정 파일(claude_desktop_config.json) 수정</div>
        <p>Claude Desktop 설정 파일에 사용할 MCP 서버 정보를 추가합니다. 각 MCP 서버의 공식 문서에서 설정 예시를 확인하세요.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num">4</div>
      <div class="step-item__body">
        <div class="step-item__title">Claude Desktop 재시작</div>
        <p>재시작 후 Claude와 대화창 하단에 MCP 도구 아이콘이 표시되면 연결 완료입니다.</p>
      </div>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
