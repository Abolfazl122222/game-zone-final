<<<<<<< HEAD
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
          <span class="badge text-bg-info mb-3">Bootstrap Professional Edition</span>
          <h1 class="display-5 fw-bold mb-3">پلتفرم کامل گیمینگ با طراحی حرفه‌ای و ساده</h1>
          <p class="lead text-light-emphasis mb-4">همه‌چیز از نو: رابط کاربری مدرن، ثبت‌نام و ورود امن، کاتالوگ حرفه‌ای و پنل مدیریت برای کنترل کامل محتوا.</p>
          <div class="d-flex gap-2 flex-wrap mb-4">
            <a href="main.php" class="btn btn-info btn-lg"><i class="bi bi-grid"></i> شروع کاتالوگ</a>
            <a href="register.php" class="btn btn-outline-light btn-lg"><i class="bi bi-person-plus"></i> ثبت‌نام سریع</a>
          </div>
          <div class="row g-3">
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">بازی‌ها</small><div class="h4 mb-0"><?php echo $totals['game']; ?></div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">محصولات</small><div class="h4 mb-0"><?php echo $totals['product']; ?></div></div></div>
            <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">سیستم‌ها</small><div class="h4 mb-0">ورود / مدیریت</div></div></div>
=======
<?php $pageTitle = 'خانه | GameZone'; include __DIR__ . '/includes/header.php'; ?>
<section class="hero d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="p-4 p-md-5 rounded-4 glass-card">
          <span class="badge text-bg-info mb-3">نسخه بازطراحی‌شده با Bootstrap</span>
          <h1 class="display-5 fw-bold mb-3">تجربه حرفه‌ای گیمینگ از معرفی تا مدیریت محتوا</h1>
          <p class="lead text-secondary mb-4">از بررسی بازی‌ها و محصولات تا پنل مدیریت، ثبت‌نام و ورود امن؛ همه‌چیز برای یک پلتفرم مدرن آماده شده است.</p>
          <div class="d-flex gap-2 flex-wrap">
            <a href="main.php" class="btn btn-info btn-lg">مشاهده کاتالوگ</a>
            <a href="register.php" class="btn btn-outline-light btn-lg">شروع با حساب کاربری</a>
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<<<<<<< HEAD

<main class="container py-5">
  <div class="row g-4">
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-shield-check text-info"></i> امنیت استاندارد</h2><p class="text-secondary mb-0">رمزها با `password_hash` ذخیره می‌شوند و ورود با نقش کاربری کنترل می‌شود.</p></div></div></div>
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-layout-text-window-reverse text-info"></i> پنل ساده و کامل</h2><p class="text-secondary mb-0">افزودن، ویرایش و حذف محتوا از یک فرم مرکزی و جدول مدیریتی.</p></div></div></div>
    <div class="col-md-4"><div class="card bg-black text-light panel-card h-100"><div class="card-body"><h2 class="h5"><i class="bi bi-phone text-info"></i> واکنش‌گرا</h2><p class="text-secondary mb-0">چیدمان کاملاً سازگار با موبایل و دسکتاپ با Bootstrap 5.</p></div></div></div>
  </div>
</main>
=======
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
<?php include __DIR__ . '/includes/footer.php'; ?>
