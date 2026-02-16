<?php
require_once '../config/config.php';
require_once '../config/db.php';
require_once '../includes/functions.php';

// 이미 로그인 중이면 대시보드로
if (isset($_SESSION['admin_id'])) {
    header('Location: /admin/');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username && $password) {
        $stmt = $pdo->prepare('SELECT id, password FROM admin_users WHERE username = ?');
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            session_regenerate_id(true); // 세션 하이재킹 방지
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_user'] = $username;
            header('Location: /admin/');
            exit;
        }
    }
    $error = '아이디 또는 비밀번호가 올바르지 않습니다.';
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>관리자 로그인 | 삼마디자인</title>
  <link rel="stylesheet" href="/css/admin.css">
</head>
<body class="login-page">

<div class="login-box">
  <div class="login-box__logo">
    <h1>SHAMMAH</h1>
    <p>관리자 로그인</p>
  </div>

  <?php if ($error): ?>
  <div class="alert alert--error"><?php echo h($error); ?></div>
  <?php endif; ?>

  <form method="post" class="login-form">
    <div class="form-group">
      <label for="username">아이디</label>
      <input type="text" id="username" name="username" value="<?php echo h($_POST['username'] ?? ''); ?>" required autofocus>
    </div>
    <div class="form-group">
      <label for="password">비밀번호</label>
      <input type="password" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn--primary btn--full">로그인</button>
  </form>
</div>

</body>
</html>
