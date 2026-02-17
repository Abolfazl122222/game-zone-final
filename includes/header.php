<?php
require_once __DIR__ . '/auth.php';
$user = current_user();
$currentPage = basename($_SERVER['PHP_SELF'] ?? 'index.php');

function nav_active(string $page, string $currentPage): string
{
    return $page === $currentPage ? 'active' : '';
}
?>
<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($pageTitle ?? 'GameZone', ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="css/app.css">
</head>
<<<<<<< HEAD
<body class="bg-dark text-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary-subtle sticky-top">
    <div class="container py-1">
        <a class="navbar-brand fw-bold text-info d-flex align-items-center gap-2" href="index.php">
            <i class="bi bi-controller"></i>
            <span>GameZone Pro</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="تغییر منو">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link <?php echo nav_active('index.php', $currentPage); ?>" href="index.php">خانه</a></li>
                <li class="nav-item"><a class="nav-link <?php echo nav_active('main.php', $currentPage); ?>" href="main.php">بازی‌ها</a></li>
                <li class="nav-item"><a class="nav-link <?php echo nav_active('about.php', $currentPage); ?>" href="about.php">درباره ما</a></li>
                <?php if (is_admin()): ?>
                    <li class="nav-item"><a class="nav-link <?php echo nav_active('admin.php', $currentPage); ?>" href="admin.php">پنل مدیریت</a></li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center gap-2 me-lg-3">
                <button type="button" class="btn btn-icon" aria-label="جستجو">
                    <i class="bi bi-search"></i>
                </button>
                <button type="button" class="btn btn-icon" aria-label="پروفایل کاربر">
                    <i class="bi bi-person-circle"></i>
                </button>
                <?php if ($user): ?>
                    <span class="small text-secondary">سلام، <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <a class="btn btn-outline-light btn-sm" href="logout.php">خروج</a>
                <?php else: ?>
                    <a class="btn btn-outline-info btn-sm" href="login.php">ورود</a>
                    <a class="btn btn-info btn-sm" href="register.php">ثبت‌نام</a>
                <?php endif; ?>
            </div>
=======
<body>
<header class="site-header">
    <div class="container nav-wrap">
        <a class="brand" href="index.php">GameZone Pro</a>

        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="mainNavbar">منو</button>

        <nav id="mainNavbar" class="main-nav" aria-label="منوی اصلی">
            <a class="nav-link <?php echo nav_active('index.php', $currentPage); ?>" href="index.php">خانه</a>
            <a class="nav-link <?php echo nav_active('main.php', $currentPage); ?>" href="main.php">بازی‌ها</a>
            <a class="nav-link <?php echo nav_active('about.php', $currentPage); ?>" href="about.php">درباره ما</a>
            <?php if (is_admin()): ?>
                <a class="nav-link <?php echo nav_active('admin.php', $currentPage); ?>" href="admin.php">پنل مدیریت</a>
            <?php endif; ?>
        </nav>

        <div class="auth-actions">
            <?php if ($user): ?>
                <span class="welcome-text">سلام، <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                <a class="btn btn-outline" href="logout.php">خروج</a>
            <?php else: ?>
                <a class="btn btn-outline" href="login.php">ورود</a>
                <a class="btn btn-primary" href="register.php">ثبت‌نام</a>
            <?php endif; ?>
>>>>>>> 2ec6af015b26b54d907e6e797f5a1b5f06a3a333
        </div>
    </div>
</header>

<?php $flash = pull_flash(); ?>
<?php if ($flash): ?>
    <div class="container flash-wrap">
        <div class="flash <?php echo $flash['type'] === 'success' ? 'flash-success' : ($flash['type'] === 'error' ? 'flash-error' : 'flash-info'); ?>">
            <?php echo htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    </div>
<?php endif; ?>
