<?php
require_once __DIR__ . '/includes/games.php';

$slug = $gameSlug ?? ($_GET['game'] ?? '');
$slug = is_string($slug) ? strtolower(trim($slug)) : '';

$game = $games[$slug] ?? null;

if (!$game) {
    http_response_code(404);
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title><?php echo $game ? htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8') : 'بازی پیدا نشد'; ?> | GameZone</title>
  <link rel="stylesheet" href="css/game.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<?php if (!$game): ?>
  <section class="game-description">
    <h2>بازی پیدا نشد</h2>
    <p>بازی موردنظر یافت نشد. لطفاً به صفحه بازی‌ها برگردید.</p>
    <a class="more-btn" href="main.php">بازگشت به بازی‌ها</a>
  </section>
<?php else: ?>
  <section class="game-header">
    <img src="<?php echo htmlspecialchars($game['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="game-cover" alt="<?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?>">
    <div class="game-info">
      <h1><?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?></h1>
      <p class="genre">ژانر: <?php echo htmlspecialchars($game['genre'], ENT_QUOTES, 'UTF-8'); ?></p>
      <p class="rating">امتیاز: ⭐ <?php echo htmlspecialchars($game['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
    </div>
  </section>

  <section class="game-description">
    <h2>داستان بازی</h2>
    <?php foreach ($game['story'] as $paragraph): ?>
      <p dir="rtl"><?php echo $paragraph; ?></p>
    <?php endforeach; ?>

    <?php if (!empty($game['features'])): ?>
      <div class="game-details" dir="rtl">
        <h2>ویژگی‌های برجسته بازی</h2>
        <ul>
          <?php foreach ($game['features'] as $feature): ?>
            <li><?php echo htmlspecialchars($feature, ENT_QUOTES, 'UTF-8'); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
  </section>

  <?php if (!empty($game['gallery'])): ?>
    <section class="game-gallery">
      <h2>تصاویر بازی</h2>
      <div class="gallery-grid">
        <?php foreach ($game['gallery'] as $image): ?>
          <img src="<?php echo htmlspecialchars($image, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?>">
        <?php endforeach; ?>
      </div>
    </section>
  <?php endif; ?>

  <?php if (!empty($game['video_link'])): ?>
    <section class="download-section">
      <a class="download-btn" href="<?php echo htmlspecialchars($game['video_link'], ENT_QUOTES, 'UTF-8'); ?>">مشاهده ویدیو</a>
    </section>
  <?php endif; ?>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>

</body>
</html>
