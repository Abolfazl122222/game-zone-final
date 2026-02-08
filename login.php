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

<?php include "includes/header.php"; ?>

<div class="login-container">
  <h2>ورود به حساب</h2>

  <form action="login-process.php" method="POST">
    <input type="text" name="username" placeholder="نام کاربری" required>
    <input type="password" name="password" placeholder="رمز عبور" required>

    <button type="submit">ورود</button>
  </form>
</div>

<?php include "includes/footer.php"; ?>

</body>
</html>
