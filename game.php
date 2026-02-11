<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'جزئیات آیتم | GameZone';

$slug = isset($_GET['game']) ? trim((string) $_GET['game']) : '';
$stmt = $pdo->prepare('SELECT * FROM games WHERE slug = :slug LIMIT 1');
$stmt->execute(['slug' => $slug]);
$item = $stmt->fetch();

if ($item) {
    $item['story'] = json_decode($item['story'], true) ?: [];
    $item['features'] = json_decode($item['features'] ?? '[]', true) ?: [];
    $item['gallery'] = json_decode($item['gallery'] ?? '[]', true) ?: [];
    $item['min_requirements'] = array_filter(array_map('trim', explode("\n", (string) ($item['min_requirements'] ?? ''))));
    $item['rec_requirements'] = array_filter(array_map('trim', explode("\n", (string) ($item['rec_requirements'] ?? ''))));
    $pageTitle = $item['title'] . ' | GameZone';
} else {
    http_response_code(404);
}

include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
  <?php if (!$item): ?>
    <div class="alert alert-warning">آیتم مورد نظر پیدا نشد.</div>
    <a href="main.php" class="btn btn-outline-light">بازگشت به کاتالوگ</a>
  <?php else: ?>
    <div class="row g-4">
      <div class="col-lg-5"><img class="img-fluid rounded-4 shadow" src="<?php echo htmlspecialchars($item['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>"></div>
      <div class="col-lg-7">
        <span class="badge text-bg-info mb-2"><?php echo htmlspecialchars($item['content_type'] === 'product' ? 'محصول' : 'بازی', ENT_QUOTES, 'UTF-8'); ?></span>
        <h1 class="display-6 fw-bold"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
        <p class="text-secondary mb-2">ژانر: <?php echo htmlspecialchars($item['genre'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p class="text-secondary mb-4">امتیاز: <?php echo htmlspecialchars($item['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
        <?php foreach ($item['story'] as $paragraph): ?>
          <p><?php echo $paragraph; ?></p>
        <?php endforeach; ?>
      </div>
    </div>

    <?php if ($item['features']): ?>
      <section class="mt-5">
        <h2 class="h4 mb-3">ویژگی‌ها</h2>
        <ul class="list-group">
          <?php foreach ($item['features'] as $feature): ?>
            <li class="list-group-item bg-black text-light border-secondary-subtle"><?php echo htmlspecialchars($feature, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      </section>
    <?php endif; ?>

    <?php if ($item['gallery']): ?>
      <section class="mt-5">
        <h2 class="h4 mb-3">گالری</h2>
        <div class="row g-3">
          <?php foreach ($item['gallery'] as $image): ?>
            <div class="col-md-6"><img class="img-fluid rounded-3" src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="gallery"></div>
          <?php endforeach; ?>
        </div>
      </section>
    <?php endif; ?>

    <?php if ($item['min_requirements'] || $item['rec_requirements']): ?>
      <section class="mt-5">
        <h2 class="h4 mb-3">سیستم مورد نیاز</h2>
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
