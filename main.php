<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'کاتالوگ بازی‌ها | GameZone';
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
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

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
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
