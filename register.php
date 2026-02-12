<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) {
    redirect('main.php');
}
$pageTitle = 'ثبت‌نام | GameZone';
include __DIR__ . '/includes/header.php';
$error = $_GET['error'] ?? '';
<<<<<<< HEAD
$oldName = trim((string) ($_GET['name'] ?? ''));
$oldEmail = trim((string) ($_GET['email'] ?? ''));
?>
<main class="container py-5 auth-wrap d-flex align-items-center">
  <div class="row justify-content-center w-100 g-4">
    <div class="col-lg-6">
      <div class="card bg-black text-light panel-card h-100">
        <div class="card-body p-4 p-lg-5">
          <span class="badge text-bg-info mb-3">ثبت‌نام حرفه‌ای</span>
          <h1 class="h3 mb-2">ایجاد حساب کاربری</h1>
          <p class="text-secondary mb-4">در کمتر از یک دقیقه حساب خودت رو بساز.</p>

          <?php if ($error === 'exists'): ?><div class="alert alert-warning">این ایمیل قبلاً ثبت شده است.</div><?php endif; ?>
          <?php if ($error === 'validation'): ?><div class="alert alert-danger">اطلاعات کامل نیست. نام، ایمیل معتبر و رمز حداقل 8 کاراکتر الزامی است.</div><?php endif; ?>
          <?php if ($error === 'password_mismatch'): ?><div class="alert alert-danger">تکرار رمز عبور با رمز عبور یکسان نیست.</div><?php endif; ?>

          <form action="register-process.php" method="post" class="vstack gap-3">
            <div>
              <label class="form-label">نام کامل</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input class="form-control" type="text" name="name" required maxlength="100" value="<?php echo htmlspecialchars($oldName, ENT_QUOTES, 'UTF-8'); ?>">
              </div>
            </div>
            <div>
              <label class="form-label">ایمیل</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input class="form-control" type="email" name="email" required value="<?php echo htmlspecialchars($oldEmail, ENT_QUOTES, 'UTF-8'); ?>">
              </div>
            </div>
            <div>
              <label class="form-label">رمز عبور</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input class="form-control" type="password" name="password" required minlength="8">
              </div>
              <small class="text-secondary">حداقل 8 کاراکتر</small>
            </div>
            <div>
              <label class="form-label">تکرار رمز عبور</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input class="form-control" type="password" name="confirm_password" required minlength="8">
              </div>
            </div>
            <button class="btn btn-info btn-lg" type="submit">ثبت‌نام</button>
          </form>

=======
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
            </div>
            <div>
              <label class="form-label">رمز عبور</label>
              <input class="form-control" type="password" name="password" required minlength="8">
            </div>
            <button class="btn btn-info" type="submit">ثبت‌نام</button>
          </form>
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
          <p class="small text-secondary mt-3 mb-0">قبلاً ثبت‌نام کردید؟ <a href="login.php" class="link-info">وارد شوید</a></p>
        </div>
      </div>
    </div>
<<<<<<< HEAD

    <div class="col-lg-4">
      <div class="card bg-black text-light panel-card h-100">
        <div class="card-body p-4">
          <h2 class="h5 mb-3">بعد از ثبت‌نام چه چیزی دارید؟</h2>
          <ul class="list-group list-group-flush small">
            <li class="list-group-item bg-transparent text-light">دسترسی به محتوای جدید بازی‌ها</li>
            <li class="list-group-item bg-transparent text-light">تجربه سریع‌تر و شخصی‌تر</li>
            <li class="list-group-item bg-transparent text-light">زیرساخت آماده برای امکانات بعدی</li>
          </ul>
        </div>
      </div>
    </div>
=======
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
