<?php
require_once __DIR__ . '/auth.php';
$user = current_user();
?>

<header>
    <div class="logo">
        <a href="index.php">GameZone</a>
    </div>

    <nav>
        <ul>
            <li><a href="index.php">صفحه اصلی</a></li>
            <li><a href="main.php">بازی‌ها</a></li>
            <li><a href="about.php">درباره ما</a></li>
            <?php if ($user): ?>
                <?php if (is_admin()): ?>
                    <li><a href="admin.php">مدیریت</a></li>
                <?php endif; ?>
                <li><a href="logout.php">خروج</a></li>
            <?php else: ?>
                <li><a href="login.php">ورود</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
