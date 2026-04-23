<?php
require_once 'config/config.php';
require_once 'config/db.php';
require_once 'includes/functions.php';

$pageTitle   = 'AI Literacy | 삼마디자인';
$currentPage = 'ai-literacy';
$pageCSS     = 'ai-literacy.css';
$pageJS      = 'ai-literacy.js';

$cards = [
  ['level' => 'beginner',     'level_label' => '초급', 'icon' => 'fa-robot',        'title' => '생성형 AI란?',     'desc' => 'AI의 기본 개념부터 생성형 AI가 어떻게 작동하는지 이해합니다.',                        'slug' => 'what-is-ai'],
  ['level' => 'beginner',     'level_label' => '초급', 'icon' => 'fa-comment-dots', 'title' => '텍스트 생성 도구', 'desc' => 'ChatGPT, Claude, Gemini 등 텍스트 AI의 사용법과 실전 활용 팁을 익힙니다.',       'slug' => 'text-tools'],
  ['level' => 'beginner',     'level_label' => '초급', 'icon' => 'fa-image',        'title' => '이미지 생성 도구', 'desc' => 'Midjourney, DALL-E 3, Adobe Firefly로 원하는 이미지를 만드는 방법을 배웁니다.', 'slug' => 'image-tools'],
  ['level' => 'intermediate', 'level_label' => '중급', 'icon' => 'fa-film',         'title' => '영상 생성 도구',   'desc' => 'Runway, Pika, Kling 등 AI 영상 생성 도구로 짧은 영상을 제작합니다.',               'slug' => 'video-tools'],
  ['level' => 'intermediate', 'level_label' => '중급', 'icon' => 'fa-music',        'title' => '음악·음성 도구',   'desc' => 'Suno AI로 음악을 생성하고 ElevenLabs로 자연스러운 AI 음성을 만듭니다.',             'slug' => 'audio-tools'],
  ['level' => 'intermediate', 'level_label' => '중급', 'icon' => 'fa-code',         'title' => 'AI 코딩 도구',     'desc' => 'GitHub Copilot, Cursor, Claude Code로 개발 생산성을 높이는 방법을 배웁니다.',      'slug' => 'coding-tools'],
  ['level' => 'intermediate', 'level_label' => '중급', 'icon' => 'fa-pen-ruler',    'title' => 'AI 디자인 도구',   'desc' => 'Canva AI, Figma AI, Framer 등 디자인 작업을 가속하는 AI 도구들을 소개합니다.',   'slug' => 'design-tools'],
  ['level' => 'advanced',     'level_label' => '고급', 'icon' => 'fa-plug',         'title' => 'MCP란?',           'desc' => 'Model Context Protocol의 개념과 AI 도구 확장의 원리를 이해합니다.',                'slug' => 'what-is-mcp'],
  ['level' => 'advanced',     'level_label' => '고급', 'icon' => 'fa-puzzle-piece', 'title' => '유용한 MCP 소개',  'desc' => '실무에 바로 쓸 수 있는 MCP 목록과 설치·설정 방법을 안내합니다.',                   'slug' => 'useful-mcp'],
  ['level' => 'advanced',     'level_label' => '고급', 'icon' => 'fa-gears',        'title' => 'AI 자동화 워크플로', 'desc' => 'n8n, Make와 AI를 연동해 반복 업무를 자동화하는 워크플로를 구축합니다.',           'slug' => 'ai-automation'],
];

include 'includes/header.php';
?>

<!-- Hero -->
<section class="hero hero--sub">
  <div class="hero__inner">
    <h1 class="hero__title">AI Literacy</h1>
    <p class="hero__sub">AI를 이해하고 실무에 활용하는 역량을 키우세요</p>
  </div>
</section>

<!-- Cards -->
<div class="container ai-literacy">
  <header>
    <h3><strong>AI</strong> Literacy</h3>
    <p>초급부터 고급까지, 생성형 AI 도구와 MCP 활용법을 단계별로 안내합니다</p>
  </header>

  <section>
    <div class="ai-level-tabs">
      <button class="level-tab active" data-level="all">전체</button>
      <button class="level-tab" data-level="beginner">초급</button>
      <button class="level-tab" data-level="intermediate">중급</button>
      <button class="level-tab" data-level="advanced">고급</button>
    </div>

    <div class="ai-card-grid">
      <?php foreach ($cards as $card): ?>
      <a href="/ai-literacy/<?php echo h($card['slug']); ?>.php" class="ai-card" data-level="<?php echo h($card['level']); ?>">
        <div class="ai-card__icon"><i class="fa-solid <?php echo h($card['icon']); ?>"></i></div>
        <span class="ai-card__badge badge--<?php echo h($card['level']); ?>"><?php echo h($card['level_label']); ?></span>
        <div class="ai-card__title"><?php echo h($card['title']); ?></div>
        <p class="ai-card__desc"><?php echo h($card['desc']); ?></p>
        <span class="ai-card__cta">자세히 보기 <i class="fa-solid fa-arrow-right"></i></span>
      </a>
      <?php endforeach; ?>
    </div>
  </section>
</div>

<?php include 'includes/footer.php'; ?>
