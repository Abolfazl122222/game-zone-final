<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'جزئیات آیتم | GameZone';

$slug = isset($_GET['game']) ? trim((string) $_GET['game']) : '';
$stmt = $pdo->prepare('SELECT * FROM games WHERE slug = :slug LIMIT 1');
$stmt->execute(['slug' => $slug]);
$item = $stmt->fetch();

if ($item) {
    $isProduct = $item['content_type'] === 'product';
    $item['story'] = json_decode($item['story'], true) ?: [];
    $item['features'] = json_decode($item['features'] ?? '[]', true) ?: [];
    $item['gallery'] = json_decode($item['gallery'] ?? '[]', true) ?: [];
    $item['min_requirements'] = array_filter(array_map('trim', explode("\n", (string) ($item['min_requirements'] ?? ''))));
    $item['rec_requirements'] = array_filter(array_map('trim', explode("\n", (string) ($item['rec_requirements'] ?? ''))));
    $pageTitle = $item['title'] . ' | GameZone';
} else {
    $isProduct = false;
    http_response_code(404);
}

include __DIR__ . '/includes/header.php';
?>
<?php if ($item): ?>
  <section class="game-hero-header" style="--game-cover-image: url('<?php echo htmlspecialchars($item['cover'], ENT_QUOTES, 'UTF-8'); ?>');">
    <div class="container py-5 position-relative">
      <span class="badge text-bg-info mb-3"><?php echo htmlspecialchars($item['content_type'] === 'product' ? 'محصول' : 'بازی', ENT_QUOTES, 'UTF-8'); ?></span>
      <h1 class="display-5 fw-bold mb-2"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
      <p class="mb-0 text-light-emphasis">ژانر: <?php echo htmlspecialchars($item['genre'], ENT_QUOTES, 'UTF-8'); ?> · امتیاز: <?php echo htmlspecialchars($item['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
  </section>
<?php endif; ?>
<main class="container py-5 item-details <?php echo $isProduct ? 'product-details' : 'game-details'; ?>">
  <?php if (!$item): ?>
    <div class="alert alert-warning">آیتم مورد نظر پیدا نشد.</div>
    <a href="main.php" class="btn btn-outline-light">بازگشت به کاتالوگ</a>
  <?php else: ?>
    <div class="row g-4 intro-grid float-in delay-1">
      <div class="col-lg-5"><img class="img-fluid rounded-4 shadow game-cover-image" src="<?php echo htmlspecialchars($item['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>"></div>
      <div class="col-lg-7 story-panel">
        <h2 class="story-title"><?php echo htmlspecialchars($isProduct ? 'معرفی محصول' : 'معرفی بازی', ENT_QUOTES, 'UTF-8'); ?></h2>
        <?php foreach ($item['story'] as $paragraph): ?>
          <p class="story-text"><?php echo htmlspecialchars($paragraph, ENT_QUOTES, 'UTF-8'); ?></p>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if ($item['features']): ?>
      <section class="mt-5 feature-section float-in delay-2">
        <h2 class="h4 mb-3 section-title">ویژگی‌ها</h2>
        <ul class="list-group">
          <?php foreach ($item['features'] as $feature): ?>
            <li class="list-group-item bg-black text-light border-secondary-subtle"><?php echo htmlspecialchars($feature, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>

    <?php if ($item['gallery']): ?>
      <section class="mt-5 gallery-section float-in delay-3">
        <h2 class="h4 mb-3 section-title">گالری</h2>
        <div class="row g-3">
          <?php foreach ($item['gallery'] as $image): ?>
            <div class="col-md-6"><img class="img-fluid rounded-3 gallery-image" src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="gallery"></div>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php if ($item['min_requirements'] || $item['rec_requirements']): ?>
      <section class="mt-5 requirements-section float-in delay-4">
        <h2 class="h4 mb-3 section-title">سیستم مورد نیاز</h2>
        <div class="row g-3">
          <div class="col-md-6">
            <div class="card bg-black text-light h-100 panel-card"><div class="card-body"><h3 class="h6">حداقل سیستم</h3><ul class="small text-secondary"><?php foreach ($item['min_requirements'] as $line): ?><li><?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?></li><?php endforeach; ?></ul></div></div>
          </div>
          <div class="col-md-6">
            <div class="card bg-black text-light h-100 panel-card"><div class="card-body"><h3 class="h6">سیستم پیشنهادی</h3><ul class="small text-secondary"><?php foreach ($item['rec_requirements'] as $line): ?><li><?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?></li><?php endforeach; ?></ul></div></div>
          </div>
        </div>
      </section>
    <?php endif; ?>
  <?php endif; ?>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
