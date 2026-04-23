<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

$pageTitle   = '유용한 MCP 소개 | AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';

include '../includes/header.php';
?>

<!-- Sub Hero -->
<div class="ai-sub-hero">
  <div class="ai-sub-hero__inner">
    <a href="/ai-literacy.php" class="ai-sub-hero__back"><i class="fa-solid fa-arrow-left"></i> AI Literacy 목록으로</a>
    <span class="ai-card__badge badge--advanced" style="margin-top:16px;display:inline-block;">고급</span>
    <h1 class="ai-sub-hero__title">유용한 MCP 소개</h1>
    <p class="ai-sub-hero__desc">실무에서 바로 활용할 수 있는 MCP 서버 목록입니다. Claude에 연결하면 파일 관리, 코드 관리, 웹 검색까지 AI가 직접 처리합니다.</p>
  </div>
</div>

<!-- 파일·시스템 MCP -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">파일·시스템 MCP</h2>
  <p class="ai-sub-section__lead">로컬 파일과 시스템을 AI가 직접 읽고 쓸 수 있게 해줍니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF6B6B;color:#fff;"><i class="fa-solid fa-folder-open"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Filesystem MCP</div>
          <span class="tool-card__tag">Anthropic 공식 · 무료</span>
        </div>
      </div>
      <p class="tool-card__desc">Claude가 지정한 폴더의 파일을 읽고, 생성하고, 수정할 수 있게 해주는 가장 기본적인 MCP입니다. "폴더 안의 모든 이미지 파일명을 날짜순으로 바꿔줘" 같은 작업을 처리합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">파일 읽기·쓰기·삭제·이동</div>
        <div class="tool-card__feature">디렉토리 탐색 및 파일 검색</div>
        <div class="tool-card__feature">접근 허용 폴더를 직접 지정 (보안)</div>
        <div class="tool-card__feature">설치: npx @modelcontextprotocol/server-filesystem</div>
      </div>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-database"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">SQLite MCP</div>
          <span class="tool-card__tag">Anthropic 공식 · 무료</span>
        </div>
      </div>
      <p class="tool-card__desc">SQLite 데이터베이스를 AI가 직접 조회하고 수정할 수 있게 해줍니다. "이번 달 매출 상위 10개 제품을 요약해줘"처럼 자연어로 DB를 분석할 수 있습니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">SQL 쿼리 자동 생성 및 실행</div>
        <div class="tool-card__feature">테이블 구조 파악 및 데이터 분석</div>
        <div class="tool-card__feature">INSERT·UPDATE 작업도 가능</div>
        <div class="tool-card__feature">설치: npx @modelcontextprotocol/server-sqlite</div>
      </div>
    </div>
  </div>
</div>

<!-- 기획 MCP -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">기획 관련 MCP</h2>
    <p class="ai-sub-section__lead">아이디어 정리, 문서 작성, 프로젝트 관리를 AI와 연결합니다.</p>

    <div class="tool-grid">
      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#1A1A1A;color:#fff;"><i class="fa-solid fa-n"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Notion MCP</div>
            <span class="tool-card__tag">Notion 공식 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">Claude가 Notion 페이지와 데이터베이스를 직접 읽고 쓸 수 있습니다. 기획 문서 초안 작성, 회의록 정리, 태스크 관리 등 기획 업무 전반에 활용합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">기획 문서·회의록 자동 정리 및 생성</div>
          <div class="tool-card__feature">데이터베이스 조회·레코드 추가</div>
          <div class="tool-card__feature">프로젝트 진행 현황 요약</div>
          <div class="tool-card__feature">Notion API 키 필요</div>
        </div>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#0052CC;color:#fff;"><i class="fa-brands fa-atlassian"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Jira MCP</div>
            <span class="tool-card__tag">커뮤니티 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">Jira 이슈를 Claude가 직접 조회하고 생성합니다. 스프린트 현황 분석, 이슈 자동 생성, 백로그 정리 등 애자일 기획 업무를 자동화합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">이슈 생성·조회·상태 업데이트</div>
          <div class="tool-card__feature">스프린트 진행 현황 요약</div>
          <div class="tool-card__feature">백로그 자동 정리 및 우선순위 제안</div>
          <div class="tool-card__feature">Jira API Token 필요</div>
        </div>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#0EA5E9;color:#fff;"><i class="fa-brands fa-slack"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Slack MCP</div>
            <span class="tool-card__tag">Anthropic 공식 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">Slack 채널 메시지를 Claude가 읽고 전송합니다. 기획 논의 내용을 요약하거나 팀에 자동으로 리포트를 전송하는 데 활용합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">채널 대화 내용 요약 및 액션 아이템 추출</div>
          <div class="tool-card__feature">자동 리포트·공지 전송</div>
          <div class="tool-card__feature">특정 키워드 메시지 검색</div>
          <div class="tool-card__feature">Slack Bot Token 필요</div>
        </div>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-brands fa-google"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Google Drive MCP</div>
            <span class="tool-card__tag">커뮤니티 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">Google Drive의 문서·스프레드시트·프레젠테이션을 Claude가 직접 읽고 수정합니다. 기획서 초안 작성, 데이터 분석, 발표 자료 구성에 활용합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">Google Docs·Sheets·Slides 읽기·수정</div>
          <div class="tool-card__feature">스프레드시트 데이터 분석 및 요약</div>
          <div class="tool-card__feature">파일 검색 및 공유 설정</div>
          <div class="tool-card__feature">Google OAuth 인증 필요</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 디자인 MCP -->
<div class="ai-sub-section">
  <h2 class="ai-sub-section__title">디자인 관련 MCP</h2>
  <p class="ai-sub-section__lead">Figma, 이미지 도구와 AI를 연결해 디자인 작업을 가속합니다.</p>

  <div class="tool-grid">
    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#F24E1E;color:#fff;"><i class="fa-brands fa-figma"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Figma MCP</div>
          <span class="tool-card__tag">커뮤니티 · 무료</span>
        </div>
      </div>
      <p class="tool-card__desc">Figma 디자인 파일을 Claude가 읽고 분석합니다. 디자인 스펙 추출, 컴포넌트 구조 파악, 디자인 시스템 문서화 작업을 AI와 함께 처리합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">Figma 파일 구조·레이어 분석</div>
        <div class="tool-card__feature">디자인 스펙(색상·폰트·간격) 자동 추출</div>
        <div class="tool-card__feature">컴포넌트 목록 정리 및 문서화</div>
        <div class="tool-card__feature">Figma API 키 필요</div>
      </div>
    </div>

    <div class="tool-card">
      <div class="tool-card__header">
        <div class="tool-card__icon" style="background:#FF6B6B;color:#fff;"><i class="fa-solid fa-image"></i></div>
        <div class="tool-card__meta">
          <div class="tool-card__name">Cloudinary MCP</div>
          <span class="tool-card__tag">커뮤니티 · 무료</span>
        </div>
      </div>
      <p class="tool-card__desc">Cloudinary에 저장된 이미지·영상 자산을 Claude가 관리합니다. 대량 이미지 태그 정리, 최적화 설정, 파일 검색 작업을 자동화합니다.</p>
      <div class="tool-card__features">
        <div class="tool-card__feature">이미지·영상 자산 검색 및 조회</div>
        <div class="tool-card__feature">태그·메타데이터 일괄 수정</div>
        <div class="tool-card__feature">이미지 변환·최적화 설정 자동화</div>
        <div class="tool-card__feature">Cloudinary API 키 필요</div>
      </div>
    </div>
  </div>
</div>

<!-- 개발·코드 MCP -->
<div style="background:#F5F5F5;">
  <div class="ai-sub-section">
    <h2 class="ai-sub-section__title">개발·코드 관련 MCP</h2>
    <p class="ai-sub-section__lead">GitHub, 터미널, 브라우저를 AI가 직접 제어합니다.</p>

    <div class="tool-grid">
      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#24292E;color:#fff;"><i class="fa-brands fa-github"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">GitHub MCP</div>
            <span class="tool-card__tag">GitHub 공식 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">GitHub 저장소를 Claude가 직접 관리합니다. 이슈 확인, PR 생성, 코드 검색, 파일 수정을 자연어 명령으로 처리합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">이슈·PR 생성·조회·댓글</div>
          <div class="tool-card__feature">저장소 파일 읽기·수정·커밋</div>
          <div class="tool-card__feature">코드 검색 및 분석</div>
          <div class="tool-card__feature">설치: npx @modelcontextprotocol/server-github</div>
        </div>
      </div>

      <div class="tool-card">
        <div class="tool-card__header">
          <div class="tool-card__icon" style="background:#4285F4;color:#fff;"><i class="fa-solid fa-globe"></i></div>
          <div class="tool-card__meta">
            <div class="tool-card__name">Puppeteer MCP</div>
            <span class="tool-card__tag">Anthropic 공식 · 무료</span>
          </div>
        </div>
        <p class="tool-card__desc">Claude가 실제 웹 브라우저를 제어합니다. 웹사이트 스크린샷, 폼 자동 입력, 클릭 등 브라우저 자동화 작업을 처리합니다.</p>
        <div class="tool-card__features">
          <div class="tool-card__feature">웹 페이지 스크린샷 및 내용 추출</div>
          <div class="tool-card__feature">폼 입력, 버튼 클릭 자동화</div>
          <div class="tool-card__feature">웹 크롤링 및 데이터 수집</div>
          <div class="tool-card__feature">설치: npx @modelcontextprotocol/server-puppeteer</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- MCP 찾는 곳 -->
<div class="ai-sub-section">
  <div class="tip-box">
    <div class="tip-box__title">MCP 서버 찾는 곳</div>
    <p>
      <strong>공식 MCP 서버 목록</strong>: github.com/modelcontextprotocol/servers<br>
      <strong>커뮤니티 MCP 모음</strong>: mcp.so / glama.ai/mcp/servers<br>
      수백 개의 MCP 서버가 오픈소스로 공개되어 있습니다. 필요한 도구를 검색해보세요.
    </p>
  </div>
</div>

<?php include '../includes/footer.php'; ?>
