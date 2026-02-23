<?php $pageTitle = 'درباره ما | GameZone'; include __DIR__ . '/includes/header.php'; ?>
<main class="container py-5">
  <div class="row g-4 align-items-center mb-4">
    <div class="col-lg-6">
      <span class="badge text-bg-info mb-2">About GameZone</span>
      <h1 class="fw-bold mb-3">نسخه حرفه‌ای و یکپارچه</h1>
      <p class="text-secondary">GameZone یک پروژه تمیز برای معرفی بازی‌ها و محصولات گیمینگ است که با استایل اختصاصی بازطراحی شده و شامل ثبت‌نام، ورود، خروج و پنل مدیریت کامل می‌شود.</p>
      <div class="row g-3 mt-1">
        <div class="col-sm-6"><div class="p-3 rounded-3 stat-card"><div class="small text-secondary">UI</div><div class="fw-bold">Custom RTL CSS</div></div></div>
        <div class="col-sm-6"><div class="p-3 rounded-3 stat-card"><div class="small text-secondary">Backend</div><div class="fw-bold">PHP + PDO</div></div></div>
      </div>
    </div>
    <div class="col-lg-6">
      <img class="img-fluid rounded-4 shadow" src="images/header-bg.jpg" alt="about gamezone">
    </div>
  </div>

  <div class="card bg-black text-light panel-card">
    <div class="card-body">
      <h2 class="h5 mb-3">ویژگی‌های اصلی</h2>
      <div class="row g-3">
        <div class="col-md-4"><div class="p-3 border rounded-3 border-secondary-subtle h-100"><i class="bi bi-person-lock text-info"></i> سیستم احراز هویت استاندارد</div></div>
        <div class="col-md-4"><div class="p-3 border rounded-3 border-secondary-subtle h-100"><i class="bi bi-speedometer2 text-info"></i> پنل مدیریت CRUD</div></div>
        <div class="col-md-4"><div class="p-3 border rounded-3 border-secondary-subtle h-100"><i class="bi bi-grid text-info"></i> کاتالوگ فیلترپذیر</div></div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
