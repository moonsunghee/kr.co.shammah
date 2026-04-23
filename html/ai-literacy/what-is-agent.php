<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'AI 에이전트란? | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--expert" style="margin-top:16px;display:inline-block;">특급</span>
    <h1 class="ai-sub-hero__title">AI 에이전트란?</h1>
    <p class="ai-sub-hero__desc">목표를 주면 스스로 계획하고 실행하는 AI 에이전트의 개념과 작동 원리를 이해합니다.</p>
  </div>
</div>

<!-- 일반 AI vs AI 에이전트 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">일반 AI와 AI 에이전트 — 무엇이 다를까요?</h2>
  <p class="ai-sub-section__lead">일반 AI는 질문 하나에 답변 하나를 돌려줍니다. AI 에이전트는 큰 목표를 받아 스스로 작업을 나누고, 도구를 선택해 순서대로 실행합니다.</p>

  <div class="concept-grid" style="grid-template-columns: repeat(2, 1fr); margin-top:40px;">
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F5F5F5;color:#999;"><i class="fa-solid fa-comment-dots"></i></div>
      <div class="concept-card__title">일반 AI (ChatGPT 등)</div>
      <p>사용자가 질문할 때마다 답변을 하나씩 생성합니다. 대화는 이어지지만 실제 작업은 사람이 직접 수행해야 합니다.</p>
      <p style="margin-top:12px;font-size:13px;color:#999;">질문 → 답변 → 질문 → 답변 (반복)</p>
    </div>
    <div class="concept-card" style="border-color:#6D28D9;border-width:2px;">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-circle-nodes"></i></div>
      <div class="concept-card__title">AI 에이전트</div>
      <p>목표 하나를 받으면 스스로 작업을 분해하고, 필요한 도구를 선택해 순서대로 실행합니다. 오류가 생기면 다른 방법을 찾아 재시도합니다.</p>
      <p style="margin-top:12px;font-size:13px;color:#6D28D9;">목표 → 계획 → 실행 → 검토 → 완료</p>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">쉽게 이해하기</div>
    <p>"이 코드의 버그를 찾아줘"라고 하면 일반 AI는 버그를 알려줍니다. AI 에이전트에게 "이 프로젝트의 버그를 수정해줘"라고 하면 코드를 읽고, 버그를 찾고, 파일을 직접 수정하고, 테스트까지 실행합니다.</p>
  </div>
</div>

<!-- 핵심 구성요소 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">에이전트의 4가지 핵심 능력</h2>
    <p class="ai-sub-section__lead">AI 에이전트가 자율적으로 일할 수 있는 이유는 네 가지 능력이 결합되기 때문입니다.</p>

    <div class="concept-grid" style="grid-template-columns: repeat(2, 1fr); margin-top:40px;">
      <div class="concept-card">
        <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-list-check"></i></div>
        <div class="concept-card__title">계획 (Planning)</div>
        <p>큰 목표를 작은 작업 단위로 분해하고 실행 순서를 결정합니다. 어떤 도구를 언제 사용할지 스스로 판단합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <div class="concept-card__title">도구 사용 (Tool Use)</div>
        <p>웹 검색, 코드 실행, 파일 읽기·쓰기, API 호출 등 외부 도구를 직접 실행해 실제 작업을 수행합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-database"></i></div>
        <div class="concept-card__title">메모리 (Memory)</div>
        <p>이전 단계의 결과를 기억하고 다음 작업에 활용합니다. 장기 프로젝트에서는 외부 저장소에 정보를 저장하기도 합니다.</p>
      </div>
      <div class="concept-card">
        <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-rotate"></i></div>
        <div class="concept-card__title">자기 수정 (Self-correction)</div>
        <p>실행 결과가 기대와 다르면 원인을 분석하고 다른 방법을 시도합니다. 에러 메시지를 스스로 해석하고 재시도합니다.</p>
      </div>
    </div>
  </div>
</div>

<!-- 작동 방식 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">AI 에이전트가 작동하는 방식</h2>
  <p class="ai-sub-section__lead">"이 주제로 블로그 글을 작성하고 이미지까지 만들어줘"라는 요청을 에이전트가 처리하는 과정입니다.</p>

  <div class="step-list">
    <div class="step-item">
      <div class="step-item__num" style="background:#6D28D9;">1</div>
      <div class="step-item__body">
        <div class="step-item__title">목표 파악</div>
        <p>요청을 분석해 최종 결과물이 무엇인지 파악하고, 필요한 작업 목록을 만듭니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num" style="background:#6D28D9;">2</div>
      <div class="step-item__body">
        <div class="step-item__title">리서치</div>
        <p>웹 검색 도구를 사용해 주제 관련 최신 정보를 수집하고 요약합니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num" style="background:#6D28D9;">3</div>
      <div class="step-item__body">
        <div class="step-item__title">글 초안 작성</div>
        <p>수집한 정보를 바탕으로 구조를 잡고 본문을 작성합니다. 분량·톤·형식 조건을 지킵니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num" style="background:#6D28D9;">4</div>
      <div class="step-item__body">
        <div class="step-item__title">이미지 생성</div>
        <p>글의 내용에 맞는 이미지 프롬프트를 생성하고 이미지 도구에 요청해 파일을 저장합니다.</p>
      </div>
    </div>
    <div class="step-item">
      <div class="step-item__num" style="background:#6D28D9;">5</div>
      <div class="step-item__body">
        <div class="step-item__title">검토 및 완료</div>
        <p>결과물이 요구사항을 충족하는지 스스로 검토하고, 미흡한 부분이 있으면 수정 후 최종 결과를 전달합니다.</p>
      </div>
    </div>
  </div>

  <div class="tip-box">
    <div class="tip-box__title">에이전트를 사용할 때 주의할 점</div>
    <p>에이전트는 아직 완벽하지 않습니다. 중간 과정을 지켜보며 잘못된 방향으로 가고 있으면 개입해 수정해야 합니다. 특히 파일 삭제, 외부 서비스 전송 같은 되돌리기 어려운 작업은 실행 전에 반드시 확인하세요.</p>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
