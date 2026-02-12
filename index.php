<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'خانه | GameZone';
$stats = $pdo->query("SELECT content_type, COUNT(*) AS total FROM games GROUP BY content_type")->fetchAll();
$totals = ['game' => 0, 'product' => 0];
foreach ($stats as $row) {
    $totals[$row['content_type']] = (int) $row['total'];
}
include __DIR__ . '/includes/header.php';
?>
<section class="hero d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-xl-8">
        <div class="p-4 p-md-5 rounded-4 glass-card">
          <span class="badge text-bg-info mb-3">GameZone Professional</span>
          <h1 class="display-5 fw-bold mb-3">پلتفرم حرفه‌ای بازی و محصولات گیمینگ</h1>
          <p class="lead text-light-emphasis mb-4">رابط کاربری تمیز، تجربه سریع و مدیریت کامل محتوا در یک ساختار حرفه‌ای.</p>
          <div class="d-flex gap-2 flex-wrap mb-4">
            <a href="main.php" class="btn btn-info btn-lg"><i class="bi bi-grid"></i> ورود به کاتالوگ</a>
            <a href="register.php" class="btn btn-outline-light btn-lg"><i class="bi bi-person-plus"></i> ایجاد حساب</a>
          </div>
          <div class="row g-3">
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">بازی‌ها</small><div class="h4 mb-0"><?php echo $totals['game']; ?></div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">محصولات</small><div class="h4 mb-0"><?php echo $totals['product']; ?></div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">پنل</small><div class="h4 mb-0">کاربر / مدیریت</div></div></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<main class="container py-5">
  <div class="row g-4">
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-shield-check text-info"></i> امنیت استاندارد</h2><p class="text-secondary mb-0">ذخیره امن رمز عبور با <code>password_hash</code> و کنترل سطح دسترسی.</p></div></div></div>
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-layout-text-window-reverse text-info"></i> مدیریت ساده</h2><p class="text-secondary mb-0">افزودن، ویرایش و حذف بازی‌ها و محصولات در پنل یکپارچه.</p></div></div></div>
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-phone text-info"></i> واکنش‌گرا</h2><p class="text-secondary mb-0">نمایش حرفه‌ای در موبایل، تبلت و دسکتاپ.</p></div></div></div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
