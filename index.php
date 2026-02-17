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

$articlesStmt = $pdo->prepare("SELECT title, short_description, cover, rating, genre, created_at FROM games WHERE content_type = 'game' ORDER BY created_at DESC LIMIT 3");
$articlesStmt->execute();
$articles = $articlesStmt->fetchAll();

$productsStmt = $pdo->prepare("SELECT title, short_description, cover, genre FROM games WHERE content_type = 'product' ORDER BY created_at DESC LIMIT 3");
$productsStmt->execute();
$products = $productsStmt->fetchAll();

// قیمت نمونه برای نمایش کارت‌های محصول (در صورت نبود قیمت در دیتابیس)
$productPrices = ['2,490,000', '3,190,000', '1,850,000'];

// داده‌های لیدربرد به صورت آرایه PHP تا در HTML رندر شوند.
$leaderboardUsers = [
    ['id' => 1, 'username' => 'AstraVex', 'score' => 99340, 'country' => 'USA', 'flag' => '🇺🇸', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=11'],
    ['id' => 2, 'username' => 'KitsuneZero', 'score' => 98110, 'country' => 'Japan', 'flag' => '🇯🇵', 'online' => false, 'avatar' => 'https://i.pravatar.cc/80?img=12'],
    ['id' => 3, 'username' => 'Frostbyte77', 'score' => 96700, 'country' => 'Canada', 'flag' => '🇨🇦', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=13'],
    ['id' => 4, 'username' => 'NyxRogue', 'score' => 95335, 'country' => 'UK', 'flag' => '🇬🇧', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=14'],
    ['id' => 5, 'username' => 'EchoVolt', 'score' => 94215, 'country' => 'Germany', 'flag' => '🇩🇪', 'online' => false, 'avatar' => 'https://i.pravatar.cc/80?img=15'],
    ['id' => 6, 'username' => 'RaptorN1', 'score' => 93890, 'country' => 'Brazil', 'flag' => '🇧🇷', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=16'],
    ['id' => 7, 'username' => 'LunaCipher', 'score' => 92540, 'country' => 'France', 'flag' => '🇫🇷', 'online' => false, 'avatar' => 'https://i.pravatar.cc/80?img=17'],
    ['id' => 8, 'username' => 'StormSpectre', 'score' => 91870, 'country' => 'Australia', 'flag' => '🇦🇺', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=18'],
    ['id' => 9, 'username' => 'PixelSage', 'score' => 90510, 'country' => 'Sweden', 'flag' => '🇸🇪', 'online' => true, 'avatar' => 'https://i.pravatar.cc/80?img=19'],
    ['id' => 10, 'username' => 'NeoTitan', 'score' => 89125, 'country' => 'South Korea', 'flag' => '🇰🇷', 'online' => false, 'avatar' => 'https://i.pravatar.cc/80?img=20'],
];

// مرتب‌سازی اولیه از بیشترین امتیاز به کمترین امتیاز
usort($leaderboardUsers, static function (array $a, array $b): int {
    return $b['score'] <=> $a['score'];
});

include __DIR__ . '/includes/header.php';
?>
<section class="hero d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-xl-10">
        <div class="p-4 p-md-5 rounded-4 glass-card">
          <div class="row g-4 align-items-center">
            <div class="col-lg-6">
              <img src="<?php echo htmlspecialchars($featuredArticle['cover'] ?? 'images/rdr2.jpg', ENT_QUOTES, 'UTF-8'); ?>" class="img-fluid rounded-4 hero-cover" alt="تصویر کاور بازی شاخص" loading="lazy">
            </div>
            <div class="col-lg-6">
              <span class="badge text-bg-info mb-3">GameZone Magazine</span>
              <h1 class="display-5 fw-bold mb-3"><?php echo htmlspecialchars($featuredArticle['title'] ?? 'پلتفرم حرفه‌ای بازی و محصولات گیمینگ', ENT_QUOTES, 'UTF-8'); ?></h1>
              <p class="lead text-light-emphasis mb-4"><?php echo htmlspecialchars($featuredArticle['short_description'] ?? 'رابط کاربری تمیز، تجربه سریع و مدیریت کامل محتوا در یک ساختار حرفه‌ای.', ENT_QUOTES, 'UTF-8'); ?></p>
              <div class="d-flex gap-2 flex-wrap mb-4">
                <a href="main.php" class="btn btn-info btn-lg"><i class="bi bi-journal-text"></i> مطالعه بررسی</a>
                <a href="main.php" class="btn btn-outline-light btn-lg"><i class="bi bi-bag"></i> مشاهده محصول</a>
              </div>
              <div class="row g-3">
                <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">بازی‌ها</small><div class="h4 mb-0"><?php echo $totals['game']; ?></div></div></div>
                <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">محصولات</small><div class="h4 mb-0"><?php echo $totals['product']; ?></div></div></div>
                <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><small class="text-secondary">امتیاز</small><div class="h4 mb-0"><?php echo htmlspecialchars($featuredArticle['rating'] ?? '--', ENT_QUOTES, 'UTF-8'); ?></div></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<main class="container py-5">
  <div class="row g-4">
    <div class="col-xl-8">
      <section class="mb-4" aria-labelledby="article-title">
        <h2 id="article-title" class="h4 mb-3 text-info">مجله بازی</h2>
        <div class="row g-3">
          <?php foreach ($articles as $article): ?>
            <?php $numericRating = (float) preg_replace('/[^0-9.]/', '', (string) ($article['rating'] ?? '0')); ?>
            <?php $starCount = max(1, min(5, (int) round($numericRating / 2))); ?>
<<<<<<< HEAD
            <div class="col-md-6 col-lg-4">
=======
            <div class="col-md-6 col-xl-4">
>>>>>>> f3abb094ad1a63672441cff93e71fa7bd185f6e9
              <article class="card bg-black text-light panel-card h-100 article-card">
                <img src="<?php echo htmlspecialchars($article['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                <div class="card-body">
                  <span class="badge bg-primary-subtle text-info-emphasis mb-2"><?php echo htmlspecialchars($article['genre'], ENT_QUOTES, 'UTF-8'); ?></span>
                  <h3 class="h6"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                  <p class="small text-secondary mb-2"><?php echo htmlspecialchars(mb_strimwidth($article['short_description'], 0, 100, '...'), ENT_QUOTES, 'UTF-8'); ?></p>
                  <div class="small d-flex justify-content-between align-items-center">
                    <span class="text-warning" aria-label="امتیاز">
                      <?php for ($i = 0; $i < $starCount; $i++): ?>
                        <i class="bi bi-star-fill"></i>
                      <?php endfor; ?>
                    </span>
                    <span class="text-secondary"><?php echo htmlspecialchars(date('Y/m/d', strtotime($article['created_at'])), ENT_QUOTES, 'UTF-8'); ?></span>
                  </div>
                </div>
              </article>
            </div>
          <?php endforeach; ?>
        </div>
      </section>

      <section aria-labelledby="product-title">
        <h2 id="product-title" class="h4 mb-3 text-info">ویترین محصولات</h2>
        <div class="row g-3">
          <?php foreach ($products as $index => $product): ?>
<<<<<<< HEAD
            <div class="col-md-6 col-lg-4">
=======
            <div class="col-md-6 col-xl-4">
>>>>>>> f3abb094ad1a63672441cff93e71fa7bd185f6e9
              <article class="card bg-black text-light panel-card h-100 product-card">
                <img src="<?php echo htmlspecialchars($product['cover'], ENT_QUOTES, 'UTF-8'); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                <div class="card-body">
                  <h3 class="h6"><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                  <p class="small text-secondary mb-3"><?php echo htmlspecialchars(mb_strimwidth($product['short_description'], 0, 90, '...'), ENT_QUOTES, 'UTF-8'); ?></p>
                  <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="small text-secondary"><?php echo htmlspecialchars($product['genre'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <strong class="product-price"><?php echo htmlspecialchars($productPrices[$index] ?? '2,000,000', ENT_QUOTES, 'UTF-8'); ?> تومان</strong>
                  </div>
                  <div class="d-flex gap-2">
                    <a href="main.php" class="btn btn-info btn-sm">مشاهده</a>
                    <button type="button" class="btn btn-outline-light btn-sm" aria-label="افزودن به علاقه‌مندی‌ها">علاقه‌مندی</button>
                  </div>
                </div>
              </article>
            </div>
          <?php endforeach; ?>
        </div>
      </section>
    </div>

    <aside class="col-xl-4">
      <section class="card bg-black text-light panel-card h-100 leaderboard-card" aria-labelledby="leaderboard-title">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 id="leaderboard-title" class="h5 mb-0 text-info">Leaderboard کاربران</h2>
            <button id="leaderboard-toggle" class="btn btn-sm btn-outline-light d-xl-none" type="button" aria-expanded="false" aria-controls="leaderboard-list">نمایش</button>
          </div>

          <label for="leaderboard-search" class="form-label small">جستجو بر اساس نام کاربری</label>
          <input id="leaderboard-search" type="search" class="form-control form-control-sm bg-dark text-light border-secondary mb-3" placeholder="مثلاً Astra" aria-label="جستجوی کاربر در لیدربرد">

          <div class="btn-group w-100 mb-3" role="group" aria-label="مرتب‌سازی لیدربرد">
            <button type="button" class="btn btn-sm btn-info" data-sort="score">امتیاز</button>
            <button type="button" class="btn btn-sm btn-outline-info" data-sort="name">نام</button>
          </div>

          <ol id="leaderboard-list" class="list-unstyled mb-0 leaderboard-list" aria-live="polite">
            <?php foreach ($leaderboardUsers as $rank => $user): ?>
              <li class="leaderboard-item <?php echo $rank === 0 ? 'top' : ''; ?>"
                  data-id="<?php echo (int) $user['id']; ?>"
                  data-username="<?php echo htmlspecialchars(strtolower($user['username']), ENT_QUOTES, 'UTF-8'); ?>"
                  data-score="<?php echo (int) $user['score']; ?>">
                <strong class="text-info">#<?php echo $rank + 1; ?></strong>
                <img class="leaderboard-avatar" src="<?php echo htmlspecialchars($user['avatar'], ENT_QUOTES, 'UTF-8'); ?>" alt="آواتار <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                <div class="leaderboard-meta">
                  <div class="leaderboard-user"><?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></div>
                  <small class="text-secondary"><?php echo htmlspecialchars($user['flag'] . ' ' . $user['country'], ENT_QUOTES, 'UTF-8'); ?> · <?php echo number_format((int) $user['score']); ?> امتیاز</small>
                  <span class="status-dot <?php echo $user['online'] ? 'online' : 'offline'; ?>" title="<?php echo $user['online'] ? 'online' : 'offline'; ?>"></span>
                </div>
                <button class="btn btn-sm btn-outline-light follow-btn" data-id="<?php echo (int) $user['id']; ?>" aria-label="دنبال کردن <?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>">Follow</button>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </section>
    </aside>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
