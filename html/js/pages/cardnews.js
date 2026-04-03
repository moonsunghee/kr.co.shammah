// AI 카드뉴스 생성기 — cardnews.js
// 참조: /AI카드뉴스/html/index.html (원본 로직 기반)

// ─── STATE ───────────────────────────────────────────────────
const THEMES = {
  dark:   { bg:'#111827', text:'#ffffff', accent:'#6366f1', accent2:'#818cf8', sub:'#1f2937' },
  violet: { bg:'#4c1d95', text:'#ffffff', accent:'#c4b5fd', accent2:'#ede9fe', sub:'#5b21b6' },
  blue:   { bg:'#1e3a8a', text:'#ffffff', accent:'#60a5fa', accent2:'#bfdbfe', sub:'#1d4ed8' },
  green:  { bg:'#064e3b', text:'#ffffff', accent:'#34d399', accent2:'#a7f3d0', sub:'#065f46' },
  rose:   { bg:'#881337', text:'#ffffff', accent:'#fb7185', accent2:'#fecdd3', sub:'#9f1239' },
};

let currentTheme = 'dark';
let currentIndex = 0;
let cardDataList = [];
let cardTitles   = [];
let currentTopic = '';

// ─── THEME PICKER ────────────────────────────────────────────
document.querySelectorAll('#cn-theme-picker .cn-swatch').forEach(el => {
  el.addEventListener('click', () => {
    document.querySelectorAll('#cn-theme-picker .cn-swatch').forEach(s => s.classList.remove('active'));
    el.classList.add('active');
    currentTheme = el.dataset.theme;
  });
});

// ─── NEWS FETCH (Google News RSS) ────────────────────────────
function parseRssXml(xmlStr) {
  try {
    const parser = new DOMParser();
    const doc = parser.parseFromString(xmlStr, 'text/xml');
    return Array.from(doc.querySelectorAll('item')).slice(0, 8).map(item => ({
      title: (item.querySelector('title')?.textContent || '').replace(/ - [^-]+$/, '').trim(),
      description: (item.querySelector('description')?.textContent || '').replace(/<[^>]*>/g, '').slice(0, 150),
      pubDate: (item.querySelector('pubDate')?.textContent || '').slice(0, 10)
    })).filter(a => a.title);
  } catch(e) { return []; }
}

async function fetchWithTimeout(url, timeout = 8000) {
  const ctrl = new AbortController();
  const id = setTimeout(() => ctrl.abort(), timeout);
  try {
    const res = await fetch(url, { signal: ctrl.signal });
    clearTimeout(id);
    return res;
  } catch(e) {
    clearTimeout(id);
    throw e;
  }
}

async function fetchNews(topic) {
  const rssUrl = `https://news.google.com/rss/search?q=${encodeURIComponent(topic)}&hl=ko&gl=KR&ceid=KR:ko`;

  // 방법 1: rss2json.com
  try {
    const url = `https://api.rss2json.com/v1/api.json?rss_url=${encodeURIComponent(rssUrl)}&count=10`;
    const res = await fetchWithTimeout(url);
    if (res.ok) {
      const data = await res.json();
      if (data.items && data.items.length > 0) {
        return data.items.slice(0, 8).map(item => ({
          title: (item.title || '').replace(/ - [^-]+$/, '').trim(),
          description: (item.description || '').replace(/<[^>]*>/g, '').slice(0, 150),
          pubDate: (item.pubDate || '').slice(0, 10)
        })).filter(a => a.title);
      }
    }
  } catch(e) { console.warn('rss2json 실패:', e.message); }

  // 방법 2: allorigins CORS proxy
  try {
    const url = `https://api.allorigins.win/get?url=${encodeURIComponent(rssUrl)}`;
    const res = await fetchWithTimeout(url);
    if (res.ok) {
      const data = await res.json();
      if (data.contents) {
        const items = parseRssXml(data.contents);
        if (items.length > 0) return items;
      }
    }
  } catch(e) { console.warn('allorigins 실패:', e.message); }

  // 방법 3: corsproxy.io
  try {
    const url = `https://corsproxy.io/?${encodeURIComponent(rssUrl)}`;
    const res = await fetchWithTimeout(url);
    if (res.ok) {
      const xml = await res.text();
      const items = parseRssXml(xml);
      if (items.length > 0) return items;
    }
  } catch(e) { console.warn('corsproxy 실패:', e.message); }

  // 모두 실패 → 빈 배열 (Claude 자체 지식으로 생성)
  return [];
}

// ─── CLAUDE API (서버 프록시 경유) ────────────────────────────
async function callClaude(apiKey, prompt, retries = 2) {
  for (let attempt = 0; attempt <= retries; attempt++) {
    try {
      const res = await fetch('/api/claude-proxy.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          api_key:    apiKey,
          model:      'claude-sonnet-4-6',
          max_tokens: 3000,
          messages:   [{ role: 'user', content: prompt }]
        })
      });

      if (!res.ok) {
        const err = await res.json().catch(() => ({}));
        const status = res.status;
        if (status >= 500 && attempt < retries) {
          console.warn(`API 오류 ${status}, ${attempt + 1}번째 재시도...`);
          await new Promise(r => setTimeout(r, 1500 * (attempt + 1)));
          continue;
        }
        if (status === 401) throw new Error('API 키가 올바르지 않아요. 키를 다시 확인해주세요.');
        if (status === 429) throw new Error('API 요청이 너무 많아요. 잠시 후 다시 시도해주세요.');
        if (status >= 500) throw new Error('Anthropic 서버에 일시적인 오류가 있어요. 잠시 후 다시 시도해주세요.');
        throw new Error(err.error?.message || `API 오류 (${status})`);
      }

      const data = await res.json();
      return data.content[0].text;

    } catch(e) {
      const isNetwork = e.message.includes('fetch') || e.message.includes('network') || e.message === 'Failed to fetch';
      if (isNetwork && attempt < retries) {
        console.warn(`네트워크 오류, ${attempt + 1}번째 재시도...`);
        await new Promise(r => setTimeout(r, 1500 * (attempt + 1)));
        continue;
      }
      if (isNetwork) throw new Error('네트워크 연결을 확인해주세요. (CORS 또는 인터넷 오류)');
      throw e;
    }
  }
}

async function generateCardContent(apiKey, topic, articles) {
  const hasArticles = articles.length > 0;
  const articleText = articles.map((a, i) =>
    `${i+1}. ${a.title}\n   ${a.description}`
  ).join('\n\n');

  const newsSection = hasArticles
    ? `[수집된 뉴스 기사]\n${articleText}`
    : `[참고] 실시간 뉴스 수집을 건너뛰고 Claude의 최신 지식을 활용합니다.\n"${topic}"에 대한 최신 동향, 핵심 이슈, 주요 트렌드를 바탕으로 인사이트 있는 카드뉴스를 작성해주세요.`;

  const prompt = `당신은 인스타그램 카드뉴스 전문 편집자입니다.
"${topic}" 관련 인스타그램 카드뉴스 콘텐츠를 만들어주세요.

${newsSection}

다음 JSON 형식으로만 응답하세요 (마크다운 코드블록 없이 순수 JSON):
{
  "cards": [
    {
      "type": "cover",
      "tag": "AI 카드뉴스",
      "title": "3~5 단어의 임팩트 있는 메인 타이틀",
      "subtitle": "한 줄 부제목 (40자 이내)",
      "date": "${new Date().toLocaleDateString('ko-KR', {year:'numeric',month:'2-digit',day:'2-digit'}).replace(/\. /g,'.').replace(/\.$/,'')}",
      "image_query": "주제와 어울리는 영문 검색 키워드 1~3개 (예: artificial intelligence, robot, future technology)"
    },
    {
      "type": "news",
      "number": 1,
      "emoji": "관련 이모지",
      "headline": "핵심 뉴스 제목 (25자 이내)",
      "body": "2~3줄 요약 설명 (80자 이내)",
      "image_query": "이 뉴스 내용과 어울리는 영문 키워드 1~3개"
    },
    {
      "type": "news",
      "number": 2,
      "emoji": "관련 이모지",
      "headline": "핵심 뉴스 제목 (25자 이내)",
      "body": "2~3줄 요약 설명 (80자 이내)",
      "image_query": "이 뉴스 내용과 어울리는 영문 키워드 1~3개"
    },
    {
      "type": "news",
      "number": 3,
      "emoji": "관련 이모지",
      "headline": "핵심 뉴스 제목 (25자 이내)",
      "body": "2~3줄 요약 설명 (80자 이내)",
      "image_query": "이 뉴스 내용과 어울리는 영문 키워드 1~3개"
    },
    {
      "type": "news",
      "number": 4,
      "emoji": "관련 이모지",
      "headline": "핵심 뉴스 제목 (25자 이내)",
      "body": "2~3줄 요약 설명 (80자 이내)",
      "image_query": "이 뉴스 내용과 어울리는 영문 키워드 1~3개"
    },
    {
      "type": "summary",
      "title": "핵심 요약",
      "points": [
        "핵심 포인트 1 (40자 이내)",
        "핵심 포인트 2 (40자 이내)",
        "핵심 포인트 3 (40자 이내)"
      ]
    },
    {
      "type": "closing",
      "icon": "이모지",
      "title": "마무리 메시지 (20자 이내)",
      "sub": "팔로우/저장을 유도하는 CTA 문구 (50자 이내)",
      "btn": "팔로우하기"
    }
  ]
}`;

  const raw = await callClaude(apiKey, prompt);
  try {
    return JSON.parse(raw.trim());
  } catch {
    const m = raw.match(/\{[\s\S]*\}/);
    if (m) return JSON.parse(m[0]);
    throw new Error('AI 응답 파싱 실패');
  }
}

// ─── CARD RENDERER ────────────────────────────────────────────
function escHtml(s) {
  return String(s || '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/"/g, '&quot;');
}

// 생성 시마다 타임스탬프로 캐시 무력화
let _imgSeed = Date.now();

function imgUrl(query) {
  return '/api/image-proxy.php?q=' + encodeURIComponent(query) + '&t=' + _imgSeed;
}

function imgStyle(query, overlay) {
  if (!query) return '';
  return `background-image: ${overlay}, url(${imgUrl(query)}); background-size: cover; background-position: center;`;
}

function renderCoverCard(card, t, brand) {
  const bg = card.image_query
    ? imgStyle(card.image_query, 'linear-gradient(to top, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.5) 55%, rgba(0,0,0,0.25) 100%)')
    : `background:${t.bg};`;
  const color = card.image_query ? '#ffffff' : t.text;
  const accentColor = card.image_query ? t.accent2 || t.accent : t.accent;
  return `
  <div class="cn-card cn-cover" style="${bg}color:${color};" data-img-url="${card.image_query ? imgUrl(card.image_query) : ''}">
    ${!card.image_query ? `<div class="cn-cover-deco" style="background:${t.accent}"></div><div class="cn-cover-deco2" style="background:${t.accent}"></div>` : ''}
    <div class="cn-cover-bignum">AI</div>
    <div class="cn-cover-tag" style="color:${accentColor}">${escHtml(card.tag || 'AI 카드뉴스')}</div>
    <div class="cn-cover-title">${escHtml(card.title)}</div>
    <div class="cn-cover-subtitle">${escHtml(card.subtitle || '')}</div>
    <div class="cn-cover-date">${escHtml(card.date || '')}${brand ? ' · ' + escHtml(brand) : ''}</div>
  </div>`;
}

function renderNewsCard(card, t, index, total, brand) {
  const bg = card.image_query
    ? imgStyle(card.image_query, 'linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.78) 100%)')
    : `background:${t.bg};`;
  const color      = card.image_query ? '#ffffff' : t.text;
  const numBg      = card.image_query ? 'rgba(255,255,255,0.15)' : t.accent;
  const numColor   = card.image_query ? '#ffffff' : t.bg;
  const labelColor = card.image_query ? 'rgba(255,255,255,0.6)' : t.accent;
  const borderColor = card.image_query ? 'rgba(255,255,255,0.2)' : t.accent + '36';
  return `
  <div class="cn-card cn-news" style="${bg}color:${color};" data-img-url="${card.image_query ? imgUrl(card.image_query) : ''}">
    <div style="position:absolute;top:0;left:0;width:8px;height:100%;background:${t.accent}"></div>
    <div class="cn-news-header">
      <div class="cn-news-num" style="background:${numBg};color:${numColor}">${card.number || index}</div>
      <div class="cn-news-label" style="color:${labelColor}">NEWS</div>
    </div>
    <div class="cn-news-headline">${escHtml(card.headline)}</div>
    <div class="cn-news-body" style="border-color:${borderColor}">${escHtml(card.body || '')}</div>
    <div class="cn-page-indicator">${index} / ${total}</div>
    ${brand ? `<div class="cn-brand">${escHtml(brand)}</div>` : ''}
  </div>`;
}

function renderSummaryCard(card, t, index, total, brand) {
  const points = (card.points || []).map(p =>
    `<div class="cn-summary-point">
      <div class="cn-point-dot" style="background:${t.accent}"></div>
      <span>${escHtml(p)}</span>
    </div>`
  ).join('');
  return `
  <div class="cn-card cn-summary" style="background:${t.sub || t.bg};color:${t.text};">
    <div style="position:absolute;top:0;right:0;width:200px;height:200px;background:${t.accent};opacity:.08;border-radius:0 0 0 100%"></div>
    <div class="cn-summary-tag" style="color:${t.accent}">SUMMARY</div>
    <div class="cn-summary-title">${escHtml(card.title || '핵심 요약')}</div>
    <div class="cn-summary-points">${points}</div>
    <div class="cn-page-indicator">${index} / ${total}</div>
    ${brand ? `<div class="cn-brand">${escHtml(brand)}</div>` : ''}
  </div>`;
}

function renderClosingCard(card, t, brand) {
  return `
  <div class="cn-card cn-closing" style="background:${t.accent};color:${t.bg};">
    <div style="position:absolute;top:-120px;left:-120px;width:350px;height:350px;background:rgba(255,255,255,.08);border-radius:50%"></div>
    <div style="position:absolute;bottom:-80px;right:-80px;width:280px;height:280px;background:rgba(255,255,255,.06);border-radius:50%"></div>
    <div class="cn-closing-icon">${card.icon || '✨'}</div>
    <div class="cn-closing-title" style="color:${t.bg}">${escHtml(card.title || '')}</div>
    <div class="cn-closing-sub" style="color:${t.bg};opacity:.75">${escHtml(card.sub || '')}</div>
    <div class="cn-closing-btn" style="background:${t.bg};color:${t.accent}">${escHtml(card.btn || '팔로우하기')}</div>
    ${brand ? `<div style="position:absolute;bottom:56px;left:90px;font-size:24px;font-weight:700;letter-spacing:2px;opacity:.45;text-transform:uppercase">${escHtml(brand)}</div>` : ''}
  </div>`;
}

function buildCardHTML(card, theme, index, total, brand) {
  const t = THEMES[theme] || THEMES.dark;
  switch(card.type) {
    case 'cover':   return renderCoverCard(card, t, brand);
    case 'news':    return renderNewsCard(card, t, index, total, brand);
    case 'summary': return renderSummaryCard(card, t, index, total, brand);
    case 'closing': return renderClosingCard(card, t, brand);
    default:        return renderNewsCard(card, t, index, total, brand);
  }
}

// ─── UI HELPERS ──────────────────────────────────────────────
function showState(state) {
  document.getElementById('cn-empty').style.display    = state === 'empty'   ? 'block' : 'none';
  document.getElementById('cn-loading').style.display  = state === 'loading' ? 'flex'  : 'none';
  document.getElementById('cn-preview').style.display  = state === 'preview' ? 'flex'  : 'none';
}

function setLoading(text, sub) {
  document.getElementById('cn-loading-text').textContent = text;
  document.getElementById('cn-loading-sub').textContent  = sub;
  showState('loading');
}

function showError(msg) {
  const t = document.getElementById('cn-error-toast');
  t.textContent = '⚠ ' + msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 5000);
}

function renderPreview() {
  const display = document.getElementById('cn-display');
  display.innerHTML = `<div class="cn-card-inner">${cardDataList[currentIndex]}</div>`;
  document.getElementById('cn-counter').textContent = `${currentIndex + 1} / ${cardDataList.length}`;
  document.getElementById('cn-prev').disabled = currentIndex === 0;
  document.getElementById('cn-next').disabled = currentIndex === cardDataList.length - 1;

  document.querySelectorAll('#cn-thumb-list .cn-thumb').forEach((el, i) => {
    el.classList.toggle('active', i === currentIndex);
  });
}

function buildThumbnailNav() {
  const t = THEMES[currentTheme] || THEMES.dark;
  const section = document.getElementById('cn-thumb-section');
  const list    = document.getElementById('cn-thumb-list');
  section.style.display = 'block';
  list.innerHTML = cardTitles.map((title, i) => `
    <div class="cn-thumb ${i === 0 ? 'active' : ''}" data-idx="${i}">
      <div class="cn-thumb-num" style="background:${t.accent};color:${t.bg}">${i + 1}</div>
      <div class="cn-thumb-title">${escHtml(title)}</div>
    </div>`
  ).join('');

  list.querySelectorAll('.cn-thumb').forEach(el => {
    el.addEventListener('click', () => jumpTo(parseInt(el.dataset.idx)));
  });
}

// ─── NAVIGATION ──────────────────────────────────────────────
function navigate(dir) {
  currentIndex = Math.max(0, Math.min(cardDataList.length - 1, currentIndex + dir));
  renderPreview();
}
function jumpTo(i) {
  currentIndex = i;
  renderPreview();
}

document.getElementById('cn-prev').addEventListener('click', () => navigate(-1));
document.getElementById('cn-next').addEventListener('click', () => navigate(1));

// ─── MAIN GENERATE ───────────────────────────────────────────
async function generateCards() {
  const apiKey = document.getElementById('cn-api-key').value.trim();
  const topic  = document.getElementById('cn-topic').value.trim() || 'AI 인공지능';
  currentTopic = topic;
  const brand  = document.getElementById('cn-brand').value.trim();

  if (!apiKey) { showError('Claude API 키를 입력해주세요'); return; }
  if (!apiKey.startsWith('sk-ant-')) { showError('올바른 Anthropic API 키 형식이 아닙니다 (sk-ant-...)'); return; }

  document.getElementById('cn-btn-generate').disabled = true;
  currentIndex = 0;
  _imgSeed = Date.now(); // 매 생성마다 새 이미지

  try {
    // Step 1: 뉴스 수집 (실패해도 계속 진행)
    setLoading('뉴스 수집 중...', `Google News에서 "${topic}" 관련 기사를 가져오고 있어요`);
    let articles = [];
    try {
      articles = await fetchNews(topic);
    } catch(e) {
      console.warn('뉴스 수집 실패, AI 지식으로 대체:', e);
    }

    // Step 2: Claude로 카드뉴스 생성
    const subMsg = articles.length > 0
      ? `Claude가 ${articles.length}개 기사를 분석하고 있어요`
      : 'AI 자체 지식으로 카드뉴스를 작성하고 있어요';
    setLoading('AI가 카드뉴스를 편집 중...', subMsg);
    const result = await generateCardContent(apiKey, topic, articles);

    // Step 3: 카드 렌더링
    setLoading('카드 이미지 렌더링 중...', '거의 다 됐어요!');
    const cards = result.cards || [];
    const total = cards.length;

    cardDataList = cards.map((card, i) =>
      buildCardHTML(card, currentTheme, i + 1, total, brand)
    );
    cardTitles = cards.map((card, i) => {
      if (card.type === 'cover')   return card.title   || '커버';
      if (card.type === 'summary') return card.title   || '요약';
      if (card.type === 'closing') return card.title   || '마무리';
      return card.headline || `뉴스 ${i}`;
    });

    buildThumbnailNav();
    renderPreview();
    showState('preview');

  } catch(err) {
    console.error(err);
    showError(err.message || '생성 중 오류가 발생했어요. 다시 시도해주세요.');
    showState(cardDataList.length > 0 ? 'preview' : 'empty');
  } finally {
    document.getElementById('cn-btn-generate').disabled = false;
  }
}

document.getElementById('cn-btn-generate').addEventListener('click', generateCards);
document.getElementById('cn-topic').addEventListener('keydown', e => {
  if (e.key === 'Enter') generateCards();
});

// ─── DOWNLOAD ────────────────────────────────────────────────
function makeFilename(index) {
  const today = new Date().toLocaleDateString('ko-KR', {year:'numeric', month:'2-digit', day:'2-digit'})
    .replace(/\. /g, '').replace('.', '');
  const slug = currentTopic.replace(/\s+/g, '_').replace(/[^\w가-힣]/g, '').slice(0, 20);
  const num = String(index).padStart(2, '0');
  return `${slug}_${today}_${num}.png`;
}
async function captureCard(html) {
  const wrap = document.getElementById('cn-render-area');
  const div  = document.createElement('div');
  div.innerHTML = html;
  const card = div.firstElementChild;
  card.style.fontFamily = "'Noto Sans KR', sans-serif";
  wrap.appendChild(card);

  // 배경 이미지 프리로드 (html2canvas 캡처 전 이미지가 로드되어야 함)
  const imgUrl = card.dataset.imgUrl;
  if (imgUrl) {
    await new Promise(resolve => {
      const img = new Image();
      img.onload = img.onerror = resolve;
      img.src = imgUrl;
    });
  }

  await document.fonts.ready;
  await new Promise(r => setTimeout(r, 200));
  const canvas = await html2canvas(card, {
    width: 1080, height: 1080, scale: 1,
    useCORS: true, allowTaint: false,
    backgroundColor: null
  });
  wrap.removeChild(card);
  return canvas;
}

document.getElementById('cn-dl-single').addEventListener('click', async () => {
  try {
    const canvas = await captureCard(cardDataList[currentIndex]);
    const a = document.createElement('a');
    a.download = makeFilename(currentIndex + 1);
    a.href = canvas.toDataURL('image/png');
    a.click();
  } catch(e) { showError('다운로드 중 오류: ' + e.message); }
});

document.getElementById('cn-dl-all').addEventListener('click', async () => {
  const btn = document.getElementById('cn-dl-all');
  btn.textContent = '⏳ 준비 중...';
  btn.disabled = true;
  try {
    const zip = new JSZip();
    for (let i = 0; i < cardDataList.length; i++) {
      btn.textContent = `⏳ ${i + 1}/${cardDataList.length} 처리 중...`;
      const canvas = await captureCard(cardDataList[i]);
      const blob = await new Promise(r => canvas.toBlob(r, 'image/png'));
      zip.file(makeFilename(i + 1), blob);
    }
    const content = await zip.generateAsync({ type: 'blob' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(content);
    const today = new Date().toLocaleDateString('ko-KR', {year:'numeric', month:'2-digit', day:'2-digit'})
      .replace(/\. /g, '').replace('.', '');
    const slug = currentTopic.replace(/\s+/g, '_').replace(/[^\w가-힣]/g, '').slice(0, 20);
    a.download = `${slug}_${today}.zip`;
    a.click();
  } catch(e) { showError('ZIP 생성 오류: ' + e.message); }
  finally {
    btn.textContent = '⬇ 전체 ZIP 저장';
    btn.disabled = false;
  }
});

// ─── API KEY 로컬스토리지 저장 ────────────────────────────────
const STORAGE_KEY = 'shammah_cn_apikey';
const apiKeyInput = document.getElementById('cn-api-key');
const keyBadge    = document.getElementById('cn-key-badge');

(function loadSavedKey() {
  try {
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved) {
      apiKeyInput.value = saved;
      updateKeyBadge(true);
    }
  } catch(e) {}
})();

function updateKeyBadge(saved) {
  if (saved) {
    keyBadge.innerHTML = `
      <span style="color:#10b981">✓ 키가 저장되어 있어요</span>
      <button id="cn-key-clear" style="background:none;border:none;color:var(--cn-text-muted);cursor:pointer;font-size:11px;font-family:inherit;padding:0;text-decoration:underline;">삭제</button>`;
    document.getElementById('cn-key-clear').addEventListener('click', clearSavedKey);
  } else {
    keyBadge.innerHTML = '';
  }
}

apiKeyInput.addEventListener('input', () => {
  try {
    const val = apiKeyInput.value.trim();
    if (val.startsWith('sk-ant-') && val.length > 20) {
      localStorage.setItem(STORAGE_KEY, val);
      updateKeyBadge(true);
    } else {
      localStorage.removeItem(STORAGE_KEY);
      updateKeyBadge(false);
    }
  } catch(e) {}
});

function clearSavedKey() {
  try {
    localStorage.removeItem(STORAGE_KEY);
    apiKeyInput.value = '';
    updateKeyBadge(false);
  } catch(e) {}
}
