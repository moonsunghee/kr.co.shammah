<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

// ── 순서 저장 (AJAX) ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'reorder_categories' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $ids = array_filter(array_map('intval', explode(',', $_POST['ids'] ?? '')));
    foreach (array_values($ids) as $i => $id) {
        $pdo->prepare('UPDATE lesson_categories SET sort_order = ? WHERE id = ?')->execute([$i + 1, $id]);
    }
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'reorder_levels' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $category = trim($_POST['category'] ?? '');
    $levels   = array_values(array_filter($_POST['levels'] ?? []));
    foreach ($levels as $i => $level) {
        $stmt = $pdo->prepare('SELECT id FROM lessons WHERE category = ? AND level = ? ORDER BY sort_order ASC');
        $stmt->execute([$category, $level]);
        $ids = array_column($stmt->fetchAll(), 'id');
        foreach ($ids as $j => $id) {
            $pdo->prepare('UPDATE lessons SET sort_order = ? WHERE id = ?')
                ->execute([($i * 1000) + $j + 1, $id]);
        }
    }
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'reorder_lessons' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $ids = array_filter(array_map('intval', explode(',', $_POST['ids'] ?? '')));
    foreach (array_values($ids) as $i => $id) {
        $pdo->prepare('UPDATE lessons SET sort_order = ? WHERE id = ?')->execute([$i + 1, $id]);
    }
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'rename_level' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $category = trim($_POST['category'] ?? '');
    $oldLevel = trim($_POST['old_level'] ?? '');
    $newLevel = trim($_POST['new_level'] ?? '');
    if ($category && $oldLevel && $newLevel && $oldLevel !== $newLevel) {
        $pdo->prepare('UPDATE lessons SET level = ? WHERE category = ? AND level = ?')
            ->execute([$newLevel, $category, $oldLevel]);
    }
    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);
    exit;
}

// ── POST 처리 ──
if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? '';

    // 카테고리 추가
    if ($action === 'add_category') {
        $name = trim($_POST['cat_name'] ?? '');
        if ($name !== '') {
            $maxSort = $pdo->query('SELECT COALESCE(MAX(sort_order),0) FROM lesson_categories')->fetchColumn();
            $pdo->prepare('INSERT IGNORE INTO lesson_categories (name, sort_order) VALUES (?, ?)')
                 ->execute([$name, $maxSort + 1]);
        }
        header('Location: /admin/lesson-admin.php');
        exit;
    }

    // 카테고리 수정
    if ($action === 'update_category') {
        $catId   = (int)($_POST['cat_id'] ?? 0);
        $newName = trim($_POST['cat_name'] ?? '');
        if ($catId && $newName !== '') {
            $oldName = $pdo->prepare('SELECT name FROM lesson_categories WHERE id = ?');
            $oldName->execute([$catId]);
            $oldNameVal = $oldName->fetchColumn();
            if ($oldNameVal && $oldNameVal !== $newName) {
                $pdo->prepare('UPDATE lessons SET category = ? WHERE category = ?')->execute([$newName, $oldNameVal]);
            }
            $pdo->prepare('UPDATE lesson_categories SET name = ? WHERE id = ?')->execute([$newName, $catId]);
        }
        header('Location: /admin/lesson-admin.php?cat=' . $catId);
        exit;
    }

    // 카테고리 삭제
    if ($action === 'delete_category') {
        $catId = (int)($_POST['cat_id'] ?? 0);
        if ($catId) {
            $catRow = $pdo->prepare('SELECT name FROM lesson_categories WHERE id = ?');
            $catRow->execute([$catId]);
            $catName = $catRow->fetchColumn();
            if ($catName) {
                $pdo->prepare('DELETE FROM lessons WHERE category = ?')->execute([$catName]);
                $pdo->prepare('DELETE FROM lesson_categories WHERE id = ?')->execute([$catId]);
            }
        }
        header('Location: /admin/lesson-admin.php');
        exit;
    }

    // 강좌 개별 추가
    if ($action === 'add_lesson') {
        $category = trim($_POST['category'] ?? '');
        $level    = trim($_POST['level'] ?? '');
        $title    = trim($_POST['title'] ?? '');
        $hours    = trim($_POST['hours'] ?? '');
        if ($category !== '' && $level !== '' && $title !== '') {
            $maxSort = $pdo->prepare('SELECT COALESCE(MAX(sort_order),0) FROM lessons WHERE category = ? AND level = ?');
            $maxSort->execute([$category, $level]);
            $nextSort = (int)$maxSort->fetchColumn() + 1;
            $pdo->prepare('INSERT INTO lessons (title, category, level, hours, sort_order, is_active) VALUES (?, ?, ?, ?, ?, 1)')
                ->execute([$title, $category, $level, $hours, $nextSort]);
        }
        header('Location: /admin/lesson-admin.php?cat=' . (int)($_POST['cat_id_ref'] ?? 0));
        exit;
    }

    // 강좌 수정
    if ($action === 'update_lesson') {
        $id    = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $hours = trim($_POST['hours'] ?? '');
        $level = trim($_POST['level'] ?? '');
        if ($id && $title !== '' && $level !== '') {
            $pdo->prepare('UPDATE lessons SET title = ?, hours = ?, level = ? WHERE id = ?')->execute([$title, $hours, $level, $id]);
        }
        header('Location: /admin/lesson-admin.php?cat=' . (int)($_POST['cat_id_ref'] ?? 0));
        exit;
    }

    // 강좌 삭제
    if ($action === 'delete_lesson') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $pdo->prepare('DELETE FROM lessons WHERE id = ?')->execute([$id]);
        header('Location: /admin/lesson-admin.php?cat=' . (int)($_POST['cat_id_ref'] ?? 0));
        exit;
    }

    // 강좌 일괄 삭제
    if ($action === 'bulk_delete_lessons') {
        $ids = array_values(array_filter(array_map('intval', $_POST['ids'] ?? [])));
        if (!empty($ids)) {
            $placeholders = implode(',', array_fill(0, count($ids), '?'));
            $pdo->prepare("DELETE FROM lessons WHERE id IN ($placeholders)")->execute($ids);
        }
        header('Location: /admin/lesson-admin.php?cat=' . (int)($_POST['cat_id_ref'] ?? 0));
        exit;
    }
}

// ── 데이터 조회 ──
$categories = $pdo->query('SELECT * FROM lesson_categories ORDER BY sort_order ASC')->fetchAll();

$selectedCatId = isset($_GET['cat']) ? (int)$_GET['cat'] : ($categories[0]['id'] ?? 0);
$selectedCat = null;
foreach ($categories as $c) {
    if ($c['id'] === $selectedCatId) { $selectedCat = $c; break; }
}

$editCatId    = isset($_GET['edit_cat']) ? (int)$_GET['edit_cat'] : 0;
$editLessonId = isset($_GET['edit_lesson']) ? (int)$_GET['edit_lesson'] : 0;

$lessonsGrouped = [];
if ($selectedCat) {
    $stmt = $pdo->prepare('SELECT * FROM lessons WHERE category = ? ORDER BY sort_order ASC');
    $stmt->execute([$selectedCat['name']]);
    foreach ($stmt->fetchAll() as $l) {
        $lessonsGrouped[$l['level']][] = $l;
    }
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>교육 관리 | 삼마디자인 관리자</title>
  <link rel="stylesheet" href="/css/admin.css">
  <style>
    /* ── 전체 레이아웃: 위아래 ── */
    .lesson-admin-layout {
      display: flex;
      flex-direction: column;
      gap: 24px;
    }

    /* ── 과정명 패널 (상단, 전체 너비) ── */
    .cat-panel {
      background: #fff;
      border-radius: 10px;
      border: 1px solid #eee;
      padding: 20px;
    }
    .cat-panel h2 {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 12px;
      color: #1A1A1A;
    }
    /* 과정명: 수평 정렬 */
    .cat-list {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 16px;
    }
    .cat-list__item {
      display: flex;
      align-items: center;
      gap: 4px;
      padding: 6px 14px;
      border-radius: 20px;
      font-size: .88rem;
      border: 1px solid #eee;
      background: #fafafa;
      transition: all .15s;
      white-space: nowrap;
    }
    .cat-list__item:hover { background: #f0f0f0; border-color: #ddd; }
    .cat-list__item.is-active { background: #FF6B6B; border-color: #FF6B6B; color: #fff; }
    .cat-list__item.is-active .cat-actions button { color: rgba(255,255,255,.7); }
    .cat-list__item.is-active .cat-actions button:hover { color: #fff; }
    .cat-list__item > a { display: block; }
    .cat-actions { display: flex; gap: 2px; flex-shrink: 0; }
    .cat-actions button {
      background: none; border: none; font-size: .75rem;
      color: #bbb; padding: 2px 4px; cursor: pointer; line-height: 1;
    }
    .cat-actions button:hover { color: #FF6B6B; }
    .cat-actions .btn-del:hover { color: #e74c3c; }
    .cat-edit-form { display: flex; gap: 4px; align-items: center; }
    .cat-edit-form input {
      padding: 5px 8px; font-size: .85rem;
      border: 1px solid #FF6B6B; border-radius: 4px; outline: none;
    }
    .cat-edit-form button {
      padding: 4px 8px; font-size: .75rem; border-radius: 4px; border: none; cursor: pointer;
    }
    .cat-edit-form .btn-save { background: #FF6B6B; color: #fff; }
    .cat-edit-form .btn-cancel { background: #eee; color: #666; }
    .cat-add-form { display: flex; gap: 6px; }
    .cat-add-form input {
      padding: 6px 10px; font-size: .85rem;
      border: 1px solid #ddd; border-radius: 6px; width: 200px;
    }
    .cat-add-form input:focus { border-color: #FF6B6B; outline: none; }

    /* ── 강좌 패널 (하단, 전체 너비) ── */
    .course-panel {
      background: #fff; border-radius: 10px; border: 1px solid #eee; padding: 24px;
    }
    .course-panel h2 {
      font-size: 1.1rem; font-weight: 700; margin-bottom: 20px; color: #1A1A1A;
    }
    /* 강좌 레벨 섹션: 2컬럼 수평 배치 */
    .course-sections-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-bottom: 28px;
    }
    .course-section { }

    /* 레벨명 인라인 편집 */
    .level-name-edit {
      outline: none;
      border-radius: 4px;
      padding: 1px 4px;
      cursor: text;
      transition: background .15s;
    }
    .level-name-edit:hover { background: rgba(255,107,107,.1); }
    .level-name-edit:focus { background: #fff3f3; box-shadow: 0 0 0 2px #FF6B6B; }
    .level-name-hint { font-size: .72rem; color: #bbb; margin-left: 4px; font-weight: 400; }

    /* 강좌 추가 2컬럼 */
    .lesson-add { margin-top: 28px; border-top: 2px solid #eee; padding-top: 20px; }
    .lesson-add__title { font-size: 1rem; font-weight: 700; color: #1A1A1A; margin-bottom: 14px; }
    .lesson-add-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
    }
    .lesson-add-col__label {
      font-size: .88rem; font-weight: 600; color: #FF6B6B;
      border-bottom: 2px solid #FF6B6B; padding-bottom: 6px; margin-bottom: 12px;
      display: flex; align-items: center; justify-content: space-between;
    }
    .lesson-add-col__count { font-size: .78rem; font-weight: 400; color: #aaa; }
    .lesson-add-col__full { font-size: .83rem; color: #bbb; padding: 8px 0; }
    .lesson-add-form {
      display: flex; flex-direction: column; gap: 8px;
    }
    .lesson-add-form input {
      padding: 7px 10px; font-size: .85rem;
      border: 1px solid #ddd; border-radius: 6px; width: 100%;
    }
    .lesson-add-form input:focus { border-color: #FF6B6B; outline: none; box-shadow: 0 0 0 3px rgba(255,107,107,.1); }
    .lesson-add-form .lesson-add-row { display: flex; gap: 8px; }
    .lesson-add-form .lesson-add-row input[name="title"] { flex: 1; }
    .lesson-add-form .lesson-add-row input[name="hours"] { width: 110px; flex-shrink: 0; }
    .course-section h3 {
      font-size: .95rem; font-weight: 600; color: #FF6B6B;
      border-bottom: 2px solid #FF6B6B; padding-bottom: 6px; margin-bottom: 12px;
    }
    .course-row {
      display: flex; align-items: center; gap: 10px;
      padding: 8px 0; border-bottom: 1px solid #f5f5f5; font-size: .88rem;
    }
    .course-row__name { flex: 1; }
    .course-row__hours { width: 80px; color: #666; }
    .course-row__actions { display: flex; gap: 4px; flex-shrink: 0; }
    .course-empty { color: #bbb; font-size: .85rem; padding: 8px 0; }
    .course-edit-form {
      display: flex; align-items: center; gap: 8px;
      padding: 6px 0; border-bottom: 1px solid #f5f5f5;
    }
    .course-edit-form input {
      padding: 5px 8px; font-size: .85rem;
      border: 1px solid #FF6B6B; border-radius: 4px; outline: none;
    }
    .course-edit-form input[name="title"] { flex: 1; }
    .course-edit-form input[name="hours"] { width: 100px; }
    .course-edit-form select { padding: 5px 8px; font-size: .85rem; border: 1px solid #FF6B6B; border-radius: 4px; background: #fff; }
    .course-edit-form button {
      padding: 4px 10px; font-size: .78rem; border-radius: 4px; border: none; cursor: pointer;
    }
    .course-edit-form .btn-save { background: #FF6B6B; color: #fff; }
    .course-edit-form .btn-cancel { background: #eee; color: #666; }


    .no-cat-selected {
      color: #999; font-size: .95rem; text-align: center; padding: 60px 0;
    }
    /* ── 일괄 삭제 액션 바 ── */
    .bulk-action-bar {
      display: none;
      align-items: center;
      gap: 12px;
      padding: 10px 16px;
      background: #fff8f8;
      border: 1px solid #ffd0d0;
      border-radius: 8px;
      margin-bottom: 16px;
    }
    .bulk-action-bar.visible { display: flex; }
    .bulk-count { font-size: .88rem; color: #FF6B6B; font-weight: 600; flex: 1; }

    /* ── 섹션 헤더 체크박스 ── */
    .course-section__head {
      display: flex;
      align-items: center;
      gap: 8px;
      font-size: .95rem;
      font-weight: 600;
      color: #FF6B6B;
      border-bottom: 2px solid #FF6B6B;
      padding-bottom: 6px;
      margin-bottom: 12px;
    }
    .course-section__head input[type=checkbox] { cursor: pointer; width: 15px; height: 15px; accent-color: #FF6B6B; }

    /* ── 강좌 행 체크박스 ── */
    .lesson-check { cursor: pointer; width: 15px; height: 15px; accent-color: #FF6B6B; flex-shrink: 0; }
    .course-row.is-checked { background: #fff8f8; border-radius: 4px; }

    .drag-handle {
      cursor: grab; color: #ccc; font-size: 1rem; padding: 0 4px;
      flex-shrink: 0; user-select: none; line-height: 1;
    }
    .drag-handle:hover { color: #999; }
    .drag-handle:active { cursor: grabbing; }
    .sortable-ghost { opacity: 0.3; background: #ffe8e8; border-radius: 4px; }
    @media (max-width: 700px) {
      .course-sections-grid { grid-template-columns: 1fr; }
      .lesson-add-grid { grid-template-columns: 1fr; }
      .cat-list { gap: 6px; }
    }
  </style>
</head>
<body class="admin-page">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li><a href="/admin/">대시보드</a></li>
        <li><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li class="active"><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header">
      <h1>교육 강좌 관리</h1>
    </div>

    <div class="lesson-admin-layout">
      <!-- ====== 왼쪽: 카테고리(과정명) 목록 ====== -->
      <div class="cat-panel">
        <h2>과정명 목록</h2>
        <div class="cat-list">
          <?php foreach ($categories as $c): ?>
            <?php if ($editCatId === $c['id']): ?>
            <form method="post" class="cat-edit-form">
              <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
              <input type="hidden" name="action" value="update_category">
              <input type="hidden" name="cat_id" value="<?php echo (int)$c['id']; ?>">
              <input type="text" name="cat_name" value="<?php echo h($c['name']); ?>" required autofocus>
              <button type="submit" class="btn-save">저장</button>
              <a href="?cat=<?php echo $selectedCatId; ?>" style="text-decoration:none;"><button type="button" class="btn-cancel">취소</button></a>
            </form>
            <?php else: ?>
            <div class="cat-list__item<?php echo $c['id'] === $selectedCatId ? ' is-active' : ''; ?>" data-cat-id="<?php echo (int)$c['id']; ?>">
              <span class="drag-handle">⠿</span>
              <a href="?cat=<?php echo (int)$c['id']; ?>"><?php echo h($c['name']); ?></a>
              <div class="cat-actions">
                <a href="?cat=<?php echo $selectedCatId; ?>&edit_cat=<?php echo (int)$c['id']; ?>" title="수정"><button type="button">&#9998;</button></a>
                <form method="post" style="margin:0" onsubmit="return confirm('이 과정명과 소속 강좌가 모두 삭제됩니다.\n계속하시겠습니까?');">
                  <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                  <input type="hidden" name="action" value="delete_category">
                  <input type="hidden" name="cat_id" value="<?php echo (int)$c['id']; ?>">
                  <button type="submit" class="btn-del" title="삭제">&times;</button>
                </form>
              </div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>
          <?php if (empty($categories)): ?>
          <p style="color:#999;font-size:.85rem;">등록된 과정명이 없습니다.</p>
          <?php endif; ?>
        </div>
        <form method="post" class="cat-add-form">
          <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
          <input type="hidden" name="action" value="add_category">
          <input type="text" name="cat_name" placeholder="새 과정명 입력" required>
          <button type="submit" class="btn btn--primary btn--sm">추가</button>
        </form>
      </div>

      <!-- ====== 오른쪽: 선택된 카테고리의 강좌 관리 ====== -->
      <div class="course-panel">
        <?php if ($selectedCat): ?>
        <h2><?php echo h($selectedCat['name']); ?> 강좌 관리</h2>

        <!-- 일괄 삭제 액션 바 -->
        <div class="bulk-action-bar" id="bulkActionBar">
          <span class="bulk-count" id="bulkCount">0개 선택됨</span>
          <button type="button" class="btn btn--sm btn--danger" onclick="bulkDelete()">선택 삭제</button>
        </div>
        <!-- 일괄 삭제 폼 (숨김) -->
        <form method="post" id="bulkDeleteForm" style="display:none">
          <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
          <input type="hidden" name="action" value="bulk_delete_lessons">
          <input type="hidden" name="cat_id_ref" value="<?php echo $selectedCatId; ?>">
          <div id="bulkDeleteIds"></div>
        </form>

        <?php if (!empty($lessonsGrouped)): ?>
        <div class="course-sections-grid">
          <?php foreach ($lessonsGrouped as $levelName => $levelLessons): ?>
          <div class="course-section">
            <div class="course-section__head">
              <span class="section-drag-handle drag-handle" title="드래그하여 순서 변경">⠿</span>
              <input type="checkbox" class="section-check-all" title="이 레벨 전체 선택">
              <span class="level-name-edit"
                    contenteditable="true"
                    data-category="<?php echo h($selectedCat['name']); ?>"
                    data-level="<?php echo h($levelName); ?>"
                    title="클릭하여 레벨명 수정"><?php echo h($levelName); ?></span>
              <span class="level-name-hint">✎</span>
            </div>
            <?php foreach ($levelLessons as $l): ?>
              <?php if ($editLessonId === (int)$l['id']): ?>
              <form method="post" class="course-edit-form">
                <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                <input type="hidden" name="action" value="update_lesson">
                <input type="hidden" name="id" value="<?php echo (int)$l['id']; ?>">
                <input type="hidden" name="cat_id_ref" value="<?php echo $selectedCatId; ?>">
                <input type="text" name="title" value="<?php echo h($l['title']); ?>" required autofocus>
                <input type="text" name="hours" value="<?php echo h($l['hours']); ?>" placeholder="시간">
                <input type="text" name="level" value="<?php echo h($l['level']); ?>" placeholder="레벨명" required style="width:100px;">
                <button type="submit" class="btn-save">저장</button>
                <a href="?cat=<?php echo $selectedCatId; ?>" style="text-decoration:none;"><button type="button" class="btn-cancel">취소</button></a>
              </form>
              <?php else: ?>
              <div class="course-row" data-lesson-id="<?php echo (int)$l['id']; ?>">
                <input type="checkbox" class="lesson-check" value="<?php echo (int)$l['id']; ?>">
                <span class="drag-handle">⠿</span>
                <span class="course-row__name"><?php echo h($l['title']); ?></span>
                <span class="course-row__hours"><?php echo h($l['hours']); ?></span>
                <div class="course-row__actions">
                  <a href="?cat=<?php echo $selectedCatId; ?>&edit_lesson=<?php echo (int)$l['id']; ?>" class="btn btn--sm">수정</a>
                  <form method="post" style="margin:0" onsubmit="return confirm('삭제하시겠습니까?');">
                    <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                    <input type="hidden" name="action" value="delete_lesson">
                    <input type="hidden" name="id" value="<?php echo (int)$l['id']; ?>">
                    <input type="hidden" name="cat_id_ref" value="<?php echo $selectedCatId; ?>">
                    <button type="submit" class="btn btn--sm btn--danger">삭제</button>
                  </form>
                </div>
              </div>
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
          <?php endforeach; ?>
        </div>
        <?php else: ?>
          <p class="course-empty">등록된 강좌가 없습니다.</p>
        <?php endif; ?>

        <!-- ====== 강좌 추가 (2컬럼) ====== -->
        <div class="lesson-add">
          <h3 class="lesson-add__title">강좌 추가</h3>
          <div class="lesson-add-grid">
            <?php
            $levelKeys = array_keys($lessonsGrouped);
            for ($col = 0; $col < 2; $col++):
              $levelName  = $levelKeys[$col] ?? '';
              $levelCount = isset($lessonsGrouped[$levelName]) ? count($lessonsGrouped[$levelName]) : 0;
              $isFull     = $levelCount >= 12;
              $colLabel   = $col === 0 ? '왼쪽' : '오른쪽';
            ?>
            <div class="lesson-add-col">
              <div class="lesson-add-col__label">
                <?php echo $levelName ? h($levelName) : $colLabel . ' (레벨명 없음)'; ?>
                <span class="lesson-add-col__count"><?php echo $levelCount; ?>/12</span>
              </div>
              <?php if ($isFull): ?>
                <p class="lesson-add-col__full">최대 12개 강좌가 입력되었습니다.</p>
              <?php else: ?>
              <form method="post" class="lesson-add-form">
                <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                <input type="hidden" name="action" value="add_lesson">
                <input type="hidden" name="category" value="<?php echo h($selectedCat['name']); ?>">
                <input type="hidden" name="cat_id_ref" value="<?php echo $selectedCatId; ?>">
                <?php if ($levelName): ?>
                  <input type="hidden" name="level" value="<?php echo h($levelName); ?>">
                <?php else: ?>
                  <input type="text" name="level" placeholder="레벨명 (예: <?php echo $colLabel; ?>급)" required>
                <?php endif; ?>
                <div class="lesson-add-row">
                  <input type="text" name="title" placeholder="강좌명" required>
                  <input type="text" name="hours" placeholder="시간">
                </div>
                <button type="submit" class="btn btn--primary btn--sm">추가</button>
              </form>
              <?php endif; ?>
            </div>
            <?php endfor; ?>
          </div>
        </div>

        <?php else: ?>
        <p class="no-cat-selected">왼쪽에서 과정명을 선택하세요.</p>
        <?php endif; ?>
      </div>
    </div>
  </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>
<script>
var CSRF = '<?php echo h(csrf_token()); ?>';

// ── 일괄 삭제 ──
function updateBulkBar() {
  var checked = document.querySelectorAll('.lesson-check:checked');
  var bar = document.getElementById('bulkActionBar');
  document.getElementById('bulkCount').textContent = checked.length + '개 선택됨';
  bar.classList.toggle('visible', checked.length > 0);

  // 각 섹션의 전체선택 체크박스 상태 동기화
  document.querySelectorAll('.course-section').forEach(function (section) {
    var all  = section.querySelectorAll('.lesson-check');
    var chk  = section.querySelectorAll('.lesson-check:checked');
    var head = section.querySelector('.section-check-all');
    if (!head) return;
    head.indeterminate = chk.length > 0 && chk.length < all.length;
    head.checked = all.length > 0 && chk.length === all.length;
  });
}

function bulkDelete() {
  var checked = document.querySelectorAll('.lesson-check:checked');
  if (!checked.length) return;
  if (!confirm(checked.length + '개 강좌를 삭제하시겠습니까?')) return;
  var container = document.getElementById('bulkDeleteIds');
  container.innerHTML = '';
  checked.forEach(function (cb) {
    var inp = document.createElement('input');
    inp.type = 'hidden'; inp.name = 'ids[]'; inp.value = cb.value;
    container.appendChild(inp);
  });
  document.getElementById('bulkDeleteForm').submit();
}

document.addEventListener('DOMContentLoaded', function () {
  // 강좌 체크박스 변경
  document.addEventListener('change', function (e) {
    if (e.target.classList.contains('lesson-check')) {
      e.target.closest('.course-row').classList.toggle('is-checked', e.target.checked);
      updateBulkBar();
    }
    // 섹션 전체선택
    if (e.target.classList.contains('section-check-all')) {
      var section = e.target.closest('.course-section');
      section.querySelectorAll('.lesson-check').forEach(function (cb) {
        cb.checked = e.target.checked;
        cb.closest('.course-row').classList.toggle('is-checked', e.target.checked);
      });
      updateBulkBar();
    }
  });
});

function reorder(action, ids) {
  fetch('', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: new URLSearchParams({ action: action, csrf_token: CSRF, ids: ids.join(',') })
  });
}

// 카테고리 순서
var catList = document.querySelector('.cat-list');
if (catList) {
  Sortable.create(catList, {
    handle: '.drag-handle',
    draggable: '.cat-list__item',
    animation: 150,
    ghostClass: 'sortable-ghost',
    onEnd: function () {
      var ids = [...catList.querySelectorAll('.cat-list__item[data-cat-id]')].map(el => el.dataset.catId);
      reorder('reorder_categories', ids);
    }
  });
}

// 레벨(컬럼) 순서
var sectionsGrid = document.querySelector('.course-sections-grid');
var currentCat = '<?php echo $selectedCat ? h($selectedCat['name']) : ''; ?>';
if (sectionsGrid && currentCat) {
  Sortable.create(sectionsGrid, {
    handle: '.section-drag-handle',
    animation: 150,
    ghostClass: 'sortable-ghost',
    onEnd: function () {
      var levels = [...sectionsGrid.querySelectorAll('.level-name-edit')].map(function (el) {
        return el.textContent.trim();
      });
      var params = new URLSearchParams({ action: 'reorder_levels', csrf_token: CSRF, category: currentCat });
      levels.forEach(function (lv) { params.append('levels[]', lv); });
      fetch('', { method: 'POST', headers: { 'Content-Type': 'application/x-www-form-urlencoded' }, body: params });
    }
  });
}

// 강좌 순서 (레벨 섹션별)
document.querySelectorAll('.course-section').forEach(function (section) {
  Sortable.create(section, {
    handle: '.drag-handle',
    draggable: '.course-row',
    animation: 150,
    ghostClass: 'sortable-ghost',
    onEnd: function () {
      var ids = [...section.querySelectorAll('.course-row[data-lesson-id]')].map(el => el.dataset.lessonId);
      reorder('reorder_lessons', ids);
    }
  });
});

// ── 레벨명 인라인 편집 ──
document.querySelectorAll('.level-name-edit').forEach(function (el) {
  var original = el.textContent.trim();

  el.addEventListener('keydown', function (e) {
    if (e.key === 'Enter') { e.preventDefault(); el.blur(); }
    if (e.key === 'Escape') { el.textContent = original; el.blur(); }
  });

  el.addEventListener('focus', function () {
    // 커서를 텍스트 끝으로
    var range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    window.getSelection().removeAllRanges();
    window.getSelection().addRange(range);
  });

  el.addEventListener('blur', function () {
    var newVal = el.textContent.trim();
    if (!newVal) { el.textContent = original; return; }
    if (newVal === original) return;
    fetch('', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: new URLSearchParams({
        action: 'rename_level',
        csrf_token: CSRF,
        category: el.dataset.category,
        old_level: original,
        new_level: newVal
      })
    }).then(function (r) { return r.json(); }).then(function (d) {
      if (d.ok) {
        original = newVal;
        el.dataset.level = newVal;
        // datalist 옵션도 갱신
        document.querySelectorAll('#level-hints option').forEach(function (opt) {
          if (opt.value === el.dataset.level) opt.value = newVal;
        });
      } else {
        el.textContent = original;
      }
    }).catch(function () { el.textContent = original; });
  });
});
</script>
</body>
</html>
