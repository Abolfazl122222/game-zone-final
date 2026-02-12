<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) {
    redirect('main.php');
}
$pageTitle = 'ثبت‌نام | GameZone';
include __DIR__ . '/includes/header.php';
$error = $_GET['error'] ?? '';
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
          <p class="small text-secondary mt-3 mb-0">قبلاً ثبت‌نام کردید؟ <a href="login.php" class="link-info">وارد شوید</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
