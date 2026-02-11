<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) {
    redirect('main.php');
}
$pageTitle = 'ورود | GameZone';
include __DIR__ . '/includes/header.php';
$error = $_GET['error'] ?? '';
?>
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card bg-black text-light panel-card">
        <div class="card-body p-4">
          <h1 class="h3 mb-3">ورود به حساب</h1>
          <?php if ($error === 'invalid'): ?><div class="alert alert-danger">ایمیل یا رمز عبور اشتباه است.</div><?php endif; ?>
          <?php if ($error === 'unauthorized'): ?><div class="alert alert-warning">برای ورود به پنل مدیریت ابتدا احراز هویت کنید.</div><?php endif; ?>
          <form action="login-process.php" method="post" class="vstack gap-3">
            <div>
              <label class="form-label">ایمیل</label>
              <input class="form-control" type="email" name="email" required>
            </div>
            <div>
              <label class="form-label">رمز عبور</label>
              <input class="form-control" type="password" name="password" required>
            </div>
            <button class="btn btn-info" type="submit">ورود</button>
          </form>
          <p class="small text-secondary mt-3 mb-0">حساب ندارید؟ <a href="register.php" class="link-info">ثبت‌نام کنید</a></p>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
