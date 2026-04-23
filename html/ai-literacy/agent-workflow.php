<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = 'AI 에이전트 활용법 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--expert" style="margin-top:16px;display:inline-block;">특급</span>
    <h1 class="ai-sub-hero__title">AI 에이전트 활용법</h1>
    <p class="ai-sub-hero__desc">리서치·코딩·업무 자동화까지, 에이전트를 실무에 적용하는 구체적인 방법을 소개합니다.</p>
  </div>
</div>

<!-- 활용 시나리오 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">실무 활용 시나리오</h2>
  <p class="ai-sub-section__lead">AI 에이전트는 반복 작업, 복합 조사, 콘텐츠 제작 등 다양한 영역에서 사람의 시간을 줄여줍니다.</p>

  <div class="concept-grid">
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-magnifying-glass"></i></div>
      <div class="concept-card__title">리서치 에이전트</div>
      <p>여러 웹페이지를 탐색해 정보를 수집하고 요약 리포트를 생성합니다. 경쟁사 분석, 트렌드 조사, 논문 요약에 활용합니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-code"></i></div>
      <div class="concept-card__title">코딩 에이전트</div>
      <p>기능 명세를 주면 코드 작성부터 테스트, 디버깅까지 처리합니다. 반복되는 CRUD 개발, 코드 리뷰, 리팩토링에 효과적입니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-gears"></i></div>
      <div class="concept-card__title">업무 자동화 에이전트</div>
      <p>이메일 분류·답변, 데이터 입력, 보고서 생성 등 반복 업무를 자동으로 처리합니다. n8n, Make와 연동하면 트리거 기반으로 실행됩니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-comment-dots"></i></div>
      <div class="concept-card__title">고객 응대 에이전트</div>
      <p>FAQ 답변, 주문 확인, 불만 접수를 자동 처리합니다. 단순 챗봇과 달리 외부 시스템(CRM, 주문DB)을 조회하고 실제 처리까지 수행합니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-chart-bar"></i></div>
      <div class="concept-card__title">데이터 분석 에이전트</div>
      <p>CSV·엑셀 파일을 읽어 분석하고 차트를 생성하며 인사이트 리포트를 작성합니다. 정기 리포트를 스케줄에 따라 자동 발송합니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#F3E8FF;color:#6D28D9;"><i class="fa-solid fa-pen-nib"></i></div>
      <div class="concept-card__title">콘텐츠 제작 에이전트</div>
      <p>키워드를 주면 리서치 → 아웃라인 → 본문 → 이미지 프롬프트까지 콘텐츠 제작 전 과정을 자동화합니다. SNS 포스팅, 블로그 운영에 활용합니다.</p>
    </div>
  </div>
</div>

<!-- 시작하기 -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">AI 에이전트 활용 시작하기</h2>
    <p class="ai-sub-section__lead">처음 에이전트를 도입할 때 단계별로 접근하면 실패 없이 효과를 볼 수 있습니다.</p>

    <div class="step-list">
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">1</div>
        <div class="step-item__body">
          <div class="step-item__title">반복 작업 하나를 선택하세요</div>
          <p>매주 하는 보고서 작성, 매일 확인하는 이메일 분류처럼 패턴이 명확한 작업을 첫 번째 자동화 대상으로 고릅니다. 복잡한 작업보다 단순하고 반복적인 것이 성공률이 높습니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">2</div>
        <div class="step-item__body">
          <div class="step-item__title">도구를 선택하고 설치하세요</div>
          <p>비개발자라면 n8n AI Agent로 시작하세요. 개발자라면 Claude Code나 Gemini CLI가 적합합니다. 모두 무료 플랜이나 오픈소스로 시작할 수 있습니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">3</div>
        <div class="step-item__body">
          <div class="step-item__title">명확한 목표를 작성하세요</div>
          <p>에이전트에게 주는 지시(프롬프트)는 구체적일수록 좋습니다. 최종 결과물의 형식, 조건, 예외 상황을 미리 명시하면 원하는 결과를 얻을 확률이 높아집니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">4</div>
        <div class="step-item__body">
          <div class="step-item__title">결과를 검토하고 개선하세요</div>
          <p>처음에는 에이전트가 실행하는 과정을 지켜보세요. 예상과 다른 결과가 나오면 지시를 수정하고 다시 실행합니다. 2~3번 반복하면 대부분 원하는 결과를 얻을 수 있습니다.</p>
        </div>
      </div>
      <div class="step-item">
        <div class="step-item__num" style="background:#6D28D9;">5</div>
        <div class="step-item__body">
          <div class="step-item__title">범위를 점차 넓히세요</div>
          <p>하나의 작업이 안정적으로 돌아가면 다음 작업으로 확장합니다. 여러 에이전트를 연결해 복잡한 파이프라인을 구성하는 것도 가능합니다.</p>
        </div>
      </div>
    </div>

    <div class="tip-box">
      <div class="tip-box__title">에이전트 프롬프트 작성 팁</div>
      <p><strong>역할 + 목표 + 도구 + 출력 형식</strong>을 명확하게 써주세요. 예: "너는 마케팅 리서처야. 국내 헬스케어 앱 시장 트렌드를 조사해서 A4 1장 분량의 요약 리포트를 작성해줘. 최근 6개월 이내의 자료를 기준으로 하고, 주요 업체 3곳의 전략을 비교해줘."</p>
    </div>
  </div>
</div>

<!-- 주의사항 -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">에이전트 도입 시 주의사항</h2>
  <p class="ai-sub-section__lead">강력한 도구인 만큼, 몇 가지 주의사항을 지키면 훨씬 안전하게 활용할 수 있습니다.</p>

  <div class="concept-grid" style="grid-template-columns: repeat(2, 1fr);">
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#FEF3C7;color:#D97706;"><i class="fa-solid fa-eye"></i></div>
      <div class="concept-card__title">중요 작업은 모니터링</div>
      <p>파일 삭제, 이메일 발송, 결제 처리 등 되돌리기 어려운 작업은 에이전트가 실행하기 전에 사람이 확인하는 단계를 추가하세요.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#FEF3C7;color:#D97706;"><i class="fa-solid fa-lock"></i></div>
      <div class="concept-card__title">권한은 최소화</div>
      <p>에이전트에게 꼭 필요한 권한만 부여하세요. 전체 파일 시스템 접근 대신 특정 폴더, 전체 DB 대신 읽기 전용 접근으로 시작하는 것이 안전합니다.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#FEF3C7;color:#D97706;"><i class="fa-solid fa-shield-halved"></i></div>
      <div class="concept-card__title">민감한 정보 주의</div>
      <p>비밀번호, 개인정보, 기밀 문서를 에이전트에 직접 전달하지 마세요. 환경 변수나 별도 보안 저장소를 통해 처리하세요.</p>
    </div>
    <div class="concept-card">
      <div class="concept-card__icon" style="background:#FEF3C7;color:#D97706;"><i class="fa-solid fa-check-double"></i></div>
      <div class="concept-card__title">결과는 반드시 검토</div>
      <p>에이전트는 틀린 정보를 확신 있게 제시하기도 합니다. 외부에 공유되는 결과물은 사람이 최종 검토한 후에 사용하세요.</p>
    </div>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
