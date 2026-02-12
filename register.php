<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) {
    redirect('main.php');
}
$pageTitle = 'ثبت‌نام | GameZone';
include __DIR__ . '/includes/header.php';
$error = $_GET['error'] ?? '';
<<<<<<< HEAD
?>
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
      <div class="card bg-black text-light panel-card">
        <div class="card-body p-4">
          <h1 class="h3 mb-3">ایجاد حساب کاربری</h1>
          <?php if ($error === 'exists'): ?><div class="alert alert-warning">این ایمیل قبلاً ثبت شده است.</div><?php endif; ?>
          <?php if ($error === 'validation'): ?><div class="alert alert-danger">لطفاً فیلدها را به‌درستی تکمیل کنید (رمز حداقل 8 کاراکتر).</div><?php endif; ?>
          <form action="register-process.php" method="post" class="vstack gap-3">
            <div>
              <label class="form-label">نام کامل</label>
              <input class="form-control" type="text" name="name" required maxlength="100">
            </div>
            <div>
              <label class="form-label">ایمیل</label>
              <input class="form-control" type="email" name="email" required>
=======
$name = trim((string) ($_GET['name'] ?? ''));
$email = trim((string) ($_GET['email'] ?? ''));
?>
<main class="container py-5 auth-wrap d-flex align-items-center">
  <div class="row justify-content-center w-100">
    <div class="col-md-7 col-lg-6">
      <div class="card bg-black text-light panel-card">
        <div class="card-body p-4 p-lg-5">
          <h1 class="h3 mb-3">ایجاد حساب کاربری</h1>
          <?php if ($error === 'exists'): ?><div class="alert alert-warning">این ایمیل قبلاً ثبت شده است.</div><?php endif; ?>
          <?php if ($error === 'validation'): ?><div class="alert alert-danger">لطفاً فیلدها را درست تکمیل کنید (رمز حداقل 8 کاراکتر).</div><?php endif; ?>
          <?php if ($error === 'password_mismatch'): ?><div class="alert alert-danger">رمز عبور و تکرار آن یکسان نیست.</div><?php endif; ?>

          <form action="register-process.php" method="post" class="vstack gap-3">
            <div>
              <label class="form-label">نام کامل</label>
              <input class="form-control" type="text" name="name" required maxlength="100" value="<?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>">
            </div>
            <div>
              <label class="form-label">ایمیل</label>
              <input class="form-control" type="email" name="email" required value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>">
>>>>>>> d21b39b311223a6f10fb19cd9127c28970aa1a2a
            </div>
            <div>
              <label class="form-label">رمز عبور</label>
              <input class="form-control" type="password" name="password" required minlength="8">
            </div>
<<<<<<< HEAD
=======
            <div>
              <label class="form-label">تکرار رمز عبور</label>
              <input class="form-control" type="password" name="confirm_password" required minlength="8">
            </div>
>>>>>>> d21b39b311223a6f10fb19cd9127c28970aa1a2a
            <button class="btn btn-info" type="submit">ثبت‌نام</button>
          </form>
          <p class="small text-secondary mt-3 mb-0">قبلاً ثبت‌نام کردید؟ <a href="login.php" class="link-info">وارد شوید</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
