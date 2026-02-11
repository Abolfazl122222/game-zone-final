<?php
require_once __DIR__ . '/includes/auth.php';
if (is_logged_in()) {
    redirect('main.php');
}
$pageTitle = 'ورود | GameZone';
include __DIR__ . '/includes/header.php';
$error = $_GET['error'] ?? '';
?>
<main class="container py-5 auth-wrap d-flex align-items-center">
  <div class="row justify-content-center w-100 g-4">
    <div class="col-lg-5">
      <div class="card bg-black text-light panel-card h-100">
        <div class="card-body p-4 p-lg-5">
          <span class="badge text-bg-info mb-3">ورود امن</span>
          <h1 class="h3 mb-2">خوش برگشتی 👋</h1>
          <p class="text-secondary mb-4">برای دسترسی به پنل کاربری و مدیریت وارد شوید.</p>

          <?php if ($error === 'invalid'): ?><div class="alert alert-danger">ایمیل یا رمز عبور اشتباه است.</div><?php endif; ?>
          <?php if ($error === 'unauthorized'): ?><div class="alert alert-warning">برای ورود به پنل مدیریت ابتدا لاگین کنید.</div><?php endif; ?>
          <?php if ($error === 'login_required'): ?><div class="alert alert-info">برای ادامه لطفاً وارد حساب خود شوید.</div><?php endif; ?>

          <form action="login-process.php" method="post" class="vstack gap-3">
            <div>
              <label class="form-label">ایمیل</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input class="form-control" type="email" name="email" required>
              </div>
            </div>
            <div>
              <label class="form-label">رمز عبور</label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input class="form-control" type="password" name="password" required>
              </div>
            </div>
            <button class="btn btn-info btn-lg" type="submit">ورود</button>
          </form>

          <p class="small text-secondary mt-3 mb-0">حساب ندارید؟ <a href="register.php" class="link-info">ثبت‌نام کنید</a></p>
        </div>
      </div>
    </div>

    <div class="col-lg-5">
      <div class="card bg-black text-light panel-card h-100">
        <div class="card-body p-4 p-lg-5">
          <h2 class="h4 mb-3">چرا حساب بسازیم؟</h2>
          <ul class="list-group list-group-flush">
            <li class="list-group-item bg-transparent text-light">✅ دسترسی سریع به محتوای جدید</li>
            <li class="list-group-item bg-transparent text-light">✅ احراز هویت امن و استاندارد</li>
            <li class="list-group-item bg-transparent text-light">✅ امکان ارتقاء سطح دسترسی توسط مدیر</li>
          </ul>
          <a href="register.php" class="btn btn-outline-info mt-4">ایجاد حساب جدید</a>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
