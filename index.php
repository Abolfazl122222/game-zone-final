<?php
require_once __DIR__ . '/includes/db.php';
$pageTitle = 'خانه | GameZone';

$stats = $pdo->query("SELECT content_type, COUNT(*) AS total FROM games GROUP BY content_type")->fetchAll();
$totals = ['game' => 0, 'product' => 0];
foreach ($stats as $row) {
    $totals[$row['content_type']] = (int) $row['total'];
}

$featuredArticleStmt = $pdo->prepare("SELECT title, short_description, cover, rating, genre FROM games WHERE content_type = 'game' ORDER BY created_at DESC LIMIT 1");
$featuredArticleStmt->execute();
$featuredArticle = $featuredArticleStmt->fetch();

$articlesStmt = $pdo->prepare("SELECT title, short_description, cover, rating, genre, created_at FROM games WHERE content_type = 'game' ORDER BY created_at DESC LIMIT 6");
$articlesStmt->execute();
$articles = $articlesStmt->fetchAll();

$productsStmt = $pdo->prepare("SELECT title, short_description, cover, genre FROM games WHERE content_type = 'product' ORDER BY created_at DESC LIMIT 6");
$productsStmt->execute();
$products = $productsStmt->fetchAll();

$productPrices = ['2,490,000', '3,190,000', '1,850,000', '2,150,000', '1,990,000', '2,390,000'];

include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="container hero-grid">
    <img src="<?php echo htmlspecialchars($featuredArticle['cover'] ?? 'images/rdr2.jpg', ENT_QUOTES, 'UTF-8'); ?>" class="hero-cover" alt="تصویر کاور بازی شاخص" loading="lazy">
    <div>
      <span class="tag">GameZone Magazine</span>
      <h1><?php echo htmlspecialchars($featuredArticle['title'] ?? 'پلتفرم حرفه‌ای بازی و محصولات گیمینگ', ENT_QUOTES, 'UTF-8'); ?></h1>
      <p><?php echo htmlspecialchars($featuredArticle['short_description'] ?? 'رابط کاربری تمیز، تجربه سریع و مدیریت کامل محتوا در یک ساختار حرفه‌ای.', ENT_QUOTES, 'UTF-8'); ?></p>
      <div class="btn-row">
        <a href="main.php" class="btn btn-primary">مطالعه بررسی</a>
        <a href="main.php" class="btn btn-outline">مشاهده محصول</a>
      </div>
      <div class="stats-grid">
        <div class="stat-box"><small>بازی‌ها</small><strong><?php echo $totals['game']; ?></strong></div>
        <div class="stat-box"><small>محصولات</small><strong><?php echo $totals['product']; ?></strong></div>
        <div class="stat-box"><small>امتیاز</small><strong><?php echo htmlspecialchars($featuredArticle['rating'] ?? '--', ENT_QUOTES, 'UTF-8'); ?></strong></div>
      </div>
    </div>
  </div>
</section>

<main class="container page-section">
  <section class="section-block">
    <h2>مجله بازی</h2>
    <div class="cards-grid">
      <?php foreach ($articles as $article): ?>
        <?php $numericRating = (float) preg_replace('/[^0-9.]/', '', (string) ($article['rating'] ?? '0')); ?>
        <?php $starCount = max(1, min(5, (int) round($numericRating / 2))); ?>
        <article class="content-card">
          <img src="<?php echo htmlspecialchars($article['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
          <div class="card-body">
            <span class="tag"><?php echo htmlspecialchars($article['genre'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h3><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p><?php echo htmlspecialchars(mb_strimwidth($article['short_description'], 0, 100, '...'), ENT_QUOTES, 'UTF-8'); ?></p>
            <div class="meta-row">
              <span class="stars"><?php for ($i = 0; $i < $starCount; $i++): ?>★<?php endfor; ?></span>
              <span><?php echo htmlspecialchars(date('Y/m/d', strtotime($article['created_at'])), ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section-block">
    <h2>ویترین محصولات</h2>
    <div class="cards-grid">
      <?php foreach ($products as $index => $product): ?>
        <article class="content-card">
          <img src="<?php echo htmlspecialchars($product['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
          <div class="card-body">
            <h3><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
            <p><?php echo htmlspecialchars(mb_strimwidth($product['short_description'], 0, 90, '...'), ENT_QUOTES, 'UTF-8'); ?></p>
            <div class="meta-row">
              <span><?php echo htmlspecialchars($product['genre'], ENT_QUOTES, 'UTF-8'); ?></span>
              <strong class="price"><?php echo htmlspecialchars($productPrices[$index] ?? '2,000,000', ENT_QUOTES, 'UTF-8'); ?> تومان</strong>
            </div>
            <div class="btn-row">
              <a href="main.php" class="btn btn-primary">مشاهده</a>
              <button type="button" class="btn btn-outline">علاقه‌مندی</button>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
