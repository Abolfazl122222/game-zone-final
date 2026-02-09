<!DOCTYPE html>
<html lang="fa">

<head>
    <title>بازی‌ها | GameZone</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
</head>

<body>

    <?php
    require_once __DIR__ . '/includes/db.php';
    require_once __DIR__ . '/includes/auth.php';
    include 'includes/header.php';
    $items = $pdo->query('SELECT slug, title, cover, short_description, content_type FROM games ORDER BY id DESC')->fetchAll();
    $games = array_values(array_filter($items, fn($item) => $item['content_type'] === 'game'));
    $products = array_values(array_filter($items, fn($item) => $item['content_type'] === 'product'));
    ?>

    <section class="catalog-section">
        <div class="section-header">
            <div>
                <h2>بازی‌های منتخب</h2>
                <p>بهترین عنوان‌ها با نقد تخصصی و اطلاعات کامل.</p>
            </div>
            <?php if (is_admin()): ?>
                <a class="more-btn" href="admin.php">افزودن بازی جدید</a>
            <?php endif; ?>
        </div>
        <div class="games">
            <?php if (!$games): ?>
                <p class="empty-state">فعلاً بازی‌ای ثبت نشده است.</p>
            <?php endif; ?>
            <?php foreach ($games as $game): ?>
                <div class="game-card">
                    <img src="<?php echo htmlspecialchars($game['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="game-info">
                        <h2><?php echo htmlspecialchars($game['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p dir="rtl"><?php echo htmlspecialchars($game['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a class="more-btn" href="game.php?game=<?php echo urlencode($game['slug']); ?>">اطلاعات بیشتر</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="catalog-section">
        <div class="section-header">
            <div>
                <h2>محصولات پیشنهادی</h2>
                <p>اکسسوری و تجهیزات گیمینگ برای تجربه حرفه‌ای.</p>
            </div>
        </div>
        <div class="games">
            <?php if (!$products): ?>
                <p class="empty-state">محصولی برای نمایش وجود ندارد.</p>
            <?php endif; ?>
            <?php foreach ($products as $product): ?>
                <div class="game-card">
                    <img src="<?php echo htmlspecialchars($product['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?>">
                    <div class="game-info">
                        <h2><?php echo htmlspecialchars($product['title'], ENT_QUOTES, 'UTF-8'); ?></h2>
                        <p dir="rtl"><?php echo htmlspecialchars($product['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <a class="more-btn" href="game.php?game=<?php echo urlencode($product['slug']); ?>">مشاهده جزئیات</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>
