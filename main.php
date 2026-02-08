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
    include 'includes/header.php';
    $games = $pdo->query('SELECT slug, title, cover, short_description FROM games ORDER BY id DESC')->fetchAll();
    ?>

    <section class="games">
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
    </section>

    <?php include 'includes/footer.php'; ?>

</body>

</html>
