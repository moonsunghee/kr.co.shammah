<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

$message = '';

$validRoles  = ['교강사', '기획자', '디자이너', '퍼블리셔', '프론트개발', '백엔드개발'];
$validLevels = ['초급', '중급', '고급', '특급'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && verify_csrf($_POST['csrf_token'] ?? '')) {
    $action = $_POST['action'] ?? 'hero';

    // ── 프리랜서 저장/수정 ──────────────────────
    if ($action === 'save') {
        $id          = (int)($_POST['id'] ?? 0);
        $name        = trim($_POST['name'] ?? '');
        $skills      = trim($_POST['skills'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $sortOrder   = (int)($_POST['sort_order'] ?? 0);
        $isActive    = isset($_POST['is_active']) ? 1 : 0;

        // roles JSON 처리
        $rolesRaw = $_POST['roles_json'] ?? '[]';
        $rolesArr = json_decode($rolesRaw, true);
        if (!is_array($rolesArr)) $rolesArr = [];
        $rolesArr = array_values(array_filter($rolesArr, function ($r) use ($validRoles, $validLevels) {
            return isset($r['role'], $r['level'])
                && in_array($r['role'],  $validRoles,  true)
                && in_array($r['level'], $validLevels, true);
        }));
        $role = json_encode($rolesArr, JSON_UNESCAPED_UNICODE);

        $avatar = trim($_POST['current_avatar'] ?? '');
        if (!empty($_FILES['avatar']['name'])) {
            try { $avatar = upload_image($_FILES['avatar'], 'freelancer'); } catch (RuntimeException $e) {}
        }

        if ($id) {
            $pdo->prepare('
                UPDATE freelancers SET name=?, role=?, skills=?, description=?, avatar=?, sort_order=?, is_active=?
                WHERE id=?
            ')->execute([$name, $role, $skills, $description, $avatar, $sortOrder, $isActive, $id]);
        } else {
            $pdo->prepare('
                INSERT INTO freelancers (name, role, skills, description, avatar, sort_order, is_active)
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ')->execute([$name, $role, $skills, $description, $avatar, $sortOrder, $isActive]);
        }
        header('Location: /admin/freelancer-admin.php');
        exit;

    // ── 프리랜서 삭제 ───────────────────────────
    } elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id) $pdo->prepare('DELETE FROM freelancers WHERE id=?')->execute([$id]);
        header('Location: /admin/freelancer-admin.php');
        exit;

    // ── Hero 설정 저장 ──────────────────────────
    } else {
        $fields = ['freelancer_hero_title', 'freelancer_hero_sub', 'freelancer_hero_image'];
        if (!empty($_FILES['freelancer_hero_image']['name'])) {
            try { $_POST['freelancer_hero_image'] = upload_image($_FILES['freelancer_hero_image'], 'banner'); } catch (RuntimeException $e) {}
        }
        $stmt = $pdo->prepare('INSERT INTO site_contents (page_key, content_val) VALUES (?, ?) ON DUPLICATE KEY UPDATE content_val = VALUES(content_val)');
        foreach ($fields as $field) {
            if (isset($_POST[$field])) $stmt->execute([$field, $_POST[$field]]);
        }
        $message = '저장되었습니다.';
    }
}

// 데이터 로드
$keys = ['freelancer_hero_title','freelancer_hero_sub','freelancer_hero_image'];
$placeholders = implode(',', array_fill(0, count($keys), '?'));
$stmt = $pdo->prepare("SELECT page_key, content_val FROM site_contents WHERE page_key IN ($placeholders)");
$stmt->execute($keys);
$contents = [];
foreach ($stmt->fetchAll() as $row) $contents[$row['page_key']] = $row['content_val'];

$freelancers = $pdo->query('SELECT * FROM freelancers ORDER BY sort_order ASC, id ASC')->fetchAll();

$edit = null;
if (isset($_GET['edit'])) {
    $stmt = $pdo->prepare('SELECT * FROM freelancers WHERE id=?');
    $stmt->execute([(int)$_GET['edit']]);
    $edit = $stmt->fetch() ?: [];
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>프리랜서 관리 | 삼마디자인 관리자</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="admin-page">
<div class="admin-layout">
  <aside class="admin-sidebar">
    <div class="admin-sidebar__logo"><a href="/admin/">SHAMMAH 관리자</a></div>
    <nav class="admin-sidebar__nav">
      <ul>
        <li><a href="/admin/">대시보드</a></li>
        <li><a href="/admin/index-admin.php">인덱스 관리</a></li>
        <li class="active"><a href="/admin/freelancer-admin.php">프리랜서 관리</a></li>
        <li><a href="/admin/portfolio-admin.php">포트폴리오 관리</a></li>
        <li><a href="/admin/lesson-admin.php">교육 관리</a></li>
        <li><a href="/admin/quote-admin.php">견적 관리</a></li>
        <li><a href="/admin/logout.php" class="logout">로그아웃</a></li>
      </ul>
    </nav>
  </aside>
  <main class="admin-content">
    <div class="admin-header"><h1>프리랜서 관리</h1></div>

    <?php if ($message): ?><div class="alert alert--success"><?php echo h($message); ?></div><?php endif; ?>

    <!-- Hero 설정 -->
    <div class="admin-section">
      <h2>Hero 섹션</h2>
      <form method="post" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
        <input type="hidden" name="action" value="hero">
        <div class="form-group">
          <label>제목</label>
          <input type="text" name="freelancer_hero_title" value="<?php echo h($contents['freelancer_hero_title'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>서브 텍스트</label>
          <input type="text" name="freelancer_hero_sub" value="<?php echo h($contents['freelancer_hero_sub'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>배경 이미지</label>
          <?php if (!empty($contents['freelancer_hero_image'])): ?>
          <img src="<?php echo h($contents['freelancer_hero_image']); ?>" style="max-width:300px; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="freelancer_hero_image" accept="image/*">
          <input type="hidden" name="freelancer_hero_image" value="<?php echo h($contents['freelancer_hero_image'] ?? ''); ?>">
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn--primary">저장</button>
          <a href="/freelancer.php" target="_blank" class="btn">프론트 미리보기</a>
        </div>
      </form>
    </div>

    <!-- 프리랜서 추가/수정 폼 -->
    <?php if (isset($_GET['edit'])): ?>
    <?php $existingRolesJson = json_encode(json_decode($edit['role'] ?? '[]', true) ?: [], JSON_UNESCAPED_UNICODE); ?>
    <div class="admin-section">
      <h2><?php echo ($edit && !empty($edit['id'])) ? '프리랜서 수정' : '새 프리랜서 추가'; ?></h2>
      <form id="freelancerForm" method="post" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
        <input type="hidden" name="action" value="save">
        <input type="hidden" name="id" value="<?php echo (int)($edit['id'] ?? 0); ?>">
        <input type="hidden" name="current_avatar" value="<?php echo h($edit['avatar'] ?? ''); ?>">

        <div class="form-row">
          <div class="form-group" style="flex:2;">
            <label>이름 *</label>
            <input type="text" name="name" value="<?php echo h($edit['name'] ?? ''); ?>" required>
          </div>
        </div>

        <!-- 업무유형 / 레벨 (다중) -->
        <div class="form-group">
          <label>업무유형 / 레벨 * <small>(복수 선택 가능)</small></label>
          <div id="rolesContainer"></div>
          <button type="button" id="addRoleBtn" class="btn btn--sm" style="margin-top:8px;">+ 업무유형 추가</button>
          <input type="hidden" name="roles_json" id="rolesJson">
        </div>

        <div class="form-group">
          <label>기술 스택 <small>(콤마로 구분, 예: Figma,Photoshop,Illustrator)</small></label>
          <input type="text" name="skills" value="<?php echo h($edit['skills'] ?? ''); ?>" placeholder="Figma,Photoshop,Illustrator">
        </div>
        <div class="form-group">
          <label>한 줄 소개</label>
          <input type="text" name="description" value="<?php echo h($edit['description'] ?? ''); ?>">
        </div>
        <div class="form-group">
          <label>프로필 이미지</label>
          <?php if (!empty($edit['avatar'])): ?>
          <img src="<?php echo h($edit['avatar']); ?>" style="width:80px; height:80px; object-fit:cover; border-radius:50%; display:block; margin-bottom:8px;">
          <?php endif; ?>
          <input type="file" name="avatar" accept="image/*">
        </div>
        <div class="form-row">
          <div class="form-group">
            <label>정렬 순서</label>
            <input type="number" name="sort_order" value="<?php echo (int)($edit['sort_order'] ?? 0); ?>">
          </div>
          <div class="form-group">
            <label class="checkbox-label">
              <input type="checkbox" name="is_active" <?php echo ($edit['is_active'] ?? 1) ? 'checked' : ''; ?>>
              공개
            </label>
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn--primary">저장</button>
          <a href="/admin/freelancer-admin.php" class="btn">취소</a>
        </div>
      </form>
    </div>

    <script>
    (function () {
      var ROLES  = <?php echo json_encode($validRoles,  JSON_UNESCAPED_UNICODE); ?>;
      var LEVELS = <?php echo json_encode($validLevels, JSON_UNESCAPED_UNICODE); ?>;
      var existing = <?php echo $existingRolesJson; ?>;

      function makeSelect(options, selected, cls, placeholder) {
        var s = document.createElement('select');
        s.className = cls;
        s.style.cssText = 'padding:6px 10px; border:1px solid #ddd; border-radius:6px; font-size:14px; height:36px;';
        var ph = document.createElement('option');
        ph.value = ''; ph.textContent = placeholder; ph.disabled = true;
        if (!selected) ph.selected = true;
        s.appendChild(ph);
        options.forEach(function (o) {
          var opt = document.createElement('option');
          opt.value = o; opt.textContent = o;
          if (o === selected) opt.selected = true;
          s.appendChild(opt);
        });
        return s;
      }

      function addRoleRow(roleVal, levelVal) {
        var row = document.createElement('div');
        row.className = 'role-entry';
        row.style.cssText = 'display:flex; gap:8px; align-items:center; margin-top:6px;';

        var rs = makeSelect(ROLES,  roleVal  || '', 'role-sel',  '--업무유형--');
        var ls = makeSelect(LEVELS, levelVal || '', 'level-sel', '--레벨--');

        var del = document.createElement('button');
        del.type = 'button'; del.textContent = '삭제';
        del.className = 'btn btn--sm btn--danger';
        del.addEventListener('click', function () { row.remove(); });

        row.appendChild(rs);
        row.appendChild(ls);
        row.appendChild(del);
        document.getElementById('rolesContainer').appendChild(row);
      }

      function syncJson() {
        var data = [];
        document.querySelectorAll('.role-entry').forEach(function (row) {
          var r = row.querySelector('.role-sel').value;
          var l = row.querySelector('.level-sel').value;
          if (r && l) data.push({ role: r, level: l });
        });
        document.getElementById('rolesJson').value = JSON.stringify(data);
        return data.length > 0;
      }

      // 초기화
      if (existing && existing.length) {
        existing.forEach(function (r) { addRoleRow(r.role, r.level); });
      } else {
        addRoleRow();
      }

      document.getElementById('addRoleBtn').addEventListener('click', function () { addRoleRow(); });

      document.getElementById('freelancerForm').addEventListener('submit', function (e) {
        if (!syncJson()) {
          alert('업무유형을 최소 1개 이상 추가해주세요.');
          e.preventDefault();
        }
      });
    }());
    </script>
    <?php endif; ?>

    <!-- 프리랜서 목록 -->
    <div class="admin-section">
      <div class="admin-header" style="padding:0 0 16px;">
        <h2 style="margin:0;">프리랜서 목록</h2>
        <a href="?edit=0" class="btn btn--primary btn--sm">+ 추가</a>
      </div>
      <table class="admin-table">
        <thead>
          <tr><th>이름</th><th>업무유형 / 레벨</th><th>기술 스택</th><th>공개</th><th>관리</th></tr>
        </thead>
        <tbody>
          <?php if (empty($freelancers)): ?>
          <tr><td colspan="5" class="empty">등록된 프리랜서가 없습니다.</td></tr>
          <?php else: ?>
          <?php foreach ($freelancers as $f): ?>
          <?php
            $rolesArr = json_decode($f['role'], true) ?: [];
            $rolesDisplay = implode(', ', array_map(function ($r) {
                return htmlspecialchars($r['role'], ENT_QUOTES) . '(' . htmlspecialchars($r['level'], ENT_QUOTES) . ')';
            }, $rolesArr));
          ?>
          <tr>
            <td><?php echo h($f['name']); ?></td>
            <td style="font-size:13px;"><?php echo $rolesDisplay ?: '-'; ?></td>
            <td style="font-size:13px; color:#666;"><?php echo h($f['skills']); ?></td>
            <td><?php echo $f['is_active'] ? '✅' : '❌'; ?></td>
            <td>
              <a href="?edit=<?php echo (int)$f['id']; ?>" class="btn btn--sm">수정</a>
              <form method="post" style="display:inline" onsubmit="return confirm('삭제하시겠습니까?');">
                <input type="hidden" name="csrf_token" value="<?php echo h(csrf_token()); ?>">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$f['id']; ?>">
                <button type="submit" class="btn btn--sm btn--danger">삭제</button>
              </form>
            </td>
          </tr>
          <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

  </main>
</div>
</body>
</html>
