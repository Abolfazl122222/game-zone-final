<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ورود | GameZone</title>
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php
include "includes/header.php";
$error = $_GET['error'] ?? '';
?>

<div class="login-container">
  <h2>ورود به حساب</h2>
  <?php if ($error === 'invalid'): ?>
    <div class="alert">نام کاربری یا رمز عبور اشتباه است.</div>
  <?php elseif ($error === 'unauthorized'): ?>
    <div class="alert">برای ورود به پنل مدیریت ابتدا لاگین کنید.</div>
  <?php endif; ?>

  <form action="login-process.php" method="POST">
    <input type="email" name="email" placeholder="ایمیل" required>
    <input type="password" name="password" placeholder="رمز عبور" required>

    <button type="submit">ورود</button>
  </form>
  <p class="login-help">اطلاعات پیش‌فرض مدیر: admin@gamezone.local / admin123</p>
</div>

<?php include "includes/footer.php"; ?>

</body>
</html>
