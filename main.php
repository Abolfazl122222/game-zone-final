<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'کاتالوگ بازی‌ها | GameZone';
<<<<<<< HEAD
$search = trim((string) ($_GET['q'] ?? ''));
$type = ($_GET['type'] ?? 'all');
$type = in_array($type, ['all', 'game', 'product'], true) ? $type : 'all';

$sql = 'SELECT slug, title, cover, short_description, genre, rating, content_type FROM games';
$params = [];
$conditions = [];

if ($type !== 'all') {
    $conditions[] = 'content_type = :type';
    $params['type'] = $type;
}
if ($search !== '') {
    $conditions[] = '(title LIKE :q OR genre LIKE :q OR short_description LIKE :q)';
    $params['q'] = '%' . $search . '%';
}
if ($conditions) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}
$sql .= ' ORDER BY id DESC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
      <h1 class="h2 mb-1">کاتالوگ حرفه‌ای</h1>
      <p class="text-secondary mb-0">جستجو و فیلتر بازی‌ها و محصولات</p>
    </div>
    <?php if (is_admin()): ?>
      <a href="admin.php" class="btn btn-outline-info"><i class="bi bi-speedometer2"></i> ورود به مدیریت</a>
    <?php endif; ?>
  </div>

  <form method="get" class="card bg-black panel-card p-3 mb-4">
    <div class="row g-3 align-items-end">
      <div class="col-md-5">
        <label class="form-label">جستجو</label>
        <input name="q" class="form-control" placeholder="نام، ژانر یا توضیح..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>">
      </div>
      <div class="col-md-4">
        <label class="form-label">نوع محتوا</label>
        <select name="type" class="form-select">
          <option value="all" <?php echo $type === 'all' ? 'selected' : ''; ?>>همه</option>
          <option value="game" <?php echo $type === 'game' ? 'selected' : ''; ?>>فقط بازی‌ها</option>
          <option value="product" <?php echo $type === 'product' ? 'selected' : ''; ?>>فقط محصولات</option>
        </select>
      </div>
      <div class="col-md-3 d-grid">
        <button class="btn btn-info" type="submit">اعمال فیلتر</button>
      </div>
    </div>
  </form>

  <div class="row g-4">
    <?php if (!$items): ?>
      <div class="col-12"><div class="alert alert-warning">موردی با این فیلتر پیدا نشد.</div></div>
    <?php endif; ?>

    <?php foreach ($items as $item): ?>
      <div class="col-md-6 col-xl-4">
        <div class="card bg-black text-light h-100 game-card panel-card">
          <img src="<?php echo htmlspecialchars($item['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>">
          <div class="card-body d-flex flex-column">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h3 class="h5 mb-0"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
              <span class="badge <?php echo $item['content_type'] === 'product' ? 'text-bg-secondary' : 'text-bg-info'; ?>"><?php echo htmlspecialchars($item['content_type'] === 'product' ? 'محصول' : 'بازی', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <p class="small text-secondary mb-2"><?php echo htmlspecialchars($item['genre'], ENT_QUOTES, 'UTF-8'); ?> | ⭐ <?php echo htmlspecialchars($item['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="text-secondary"><?php echo htmlspecialchars($item['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a class="btn btn-info mt-auto" href="game.php?game=<?php echo urlencode($item['slug']); ?>">مشاهده جزئیات</a>
=======
$items = $pdo->query('SELECT slug, title, cover, short_description, genre, rating, content_type FROM games ORDER BY id DESC')->fetchAll();
$games = array_values(array_filter($items, fn($item) => $item['content_type'] === 'game'));
$products = array_values(array_filter($items, fn($item) => $item['content_type'] === 'product'));

include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h2 mb-1">کاتالوگ حرفه‌ای</h1>
      <p class="text-secondary mb-0">بازی‌ها و محصولات گیمینگ با اطلاعات کامل</p>
    </div>
    <?php if (is_admin()): ?>
      <a href="admin.php" class="btn btn-outline-info"><i class="bi bi-speedometer2"></i> مدیریت</a>
    <?php endif; ?>
  </div>

  <h2 class="h4 mb-3">بازی‌ها</h2>
  <div class="row g-4 mb-5">
    <?php if (!$games): ?><p class="text-secondary">هیچ بازی‌ای ثبت نشده است.</p><?php endif; ?>
    <?php foreach ($games as $game): ?>
      <div class="col-md-6 col-xl-4">
        <div class="card bg-black text-light h-100 game-card panel-card">
          <img src="<?php echo htmlspecialchars($game['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?>">
          <div class="card-body d-flex flex-column">
            <h3 class="h5"><?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p class="small text-secondary mb-2"><?php echo htmlspecialchars($game['genre'], ENT_QUOTES, 'UTF-8'); ?> | ⭐ <?php echo htmlspecialchars($game['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="text-secondary"><?php echo htmlspecialchars($game['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a class="btn btn-info mt-auto" href="game.php?game=<?php echo urlencode($game['slug']); ?>">مشاهده جزئیات</a>
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
<<<<<<< HEAD
=======

  <h2 class="h4 mb-3">محصولات</h2>
  <div class="row g-4">
    <?php if (!$products): ?><p class="text-secondary">محصولی ثبت نشده است.</p><?php endif; ?>
    <?php foreach ($products as $product): ?>
      <div class="col-md-6 col-xl-4">
        <div class="card bg-black text-light h-100 game-card panel-card">
          <img src="<?php echo htmlspecialchars($product['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
          <div class="card-body d-flex flex-column">
            <h3 class="h5"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p class="small text-secondary mb-2"><?php echo htmlspecialchars($product['genre'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p class="text-secondary"><?php echo htmlspecialchars($product['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a class="btn btn-outline-info mt-auto" href="game.php?game=<?php echo urlencode($product['slug']); ?>">مشاهده جزئیات</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
