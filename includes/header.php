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
    <link rel="stylesheet" href="bootstrap.rtl.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>
<body class="bg-dark text-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-black border-bottom border-secondary-subtle sticky-top">
    <div class="container py-1">
        <a class="navbar-brand fw-bold text-info" href="index.php">GameZone Pro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="تغییر منو">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="index.php">خانه</a></li>
                <li class="nav-item"><a class="nav-link" href="main.php">بازی‌ها</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">درباره ما</a></li>
                <?php if (is_admin()): ?>
                    <li class="nav-item"><a class="nav-link" href="admin.php">پنل مدیریت</a></li>
                <?php endif; ?>
            </ul>
            <div class="d-flex align-items-center gap-2 me-lg-3">
                <?php if ($user): ?>
                    <span class="small text-secondary">سلام، <?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                    <a class="btn btn-outline-light btn-sm" href="logout.php">خروج</a>
                <?php else: ?>
                    <a class="btn btn-outline-info btn-sm" href="login.php">ورود</a>
                    <a class="btn btn-info btn-sm" href="register.php">ثبت‌نام</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php $flash = pull_flash(); ?>
<?php if ($flash): ?>
    <div class="container mt-3">
        <div class="alert alert-<?php echo $flash['type'] === 'success' ? 'success' : ($flash['type'] === 'error' ? 'danger' : 'info'); ?> mb-0">
            <?php echo htmlspecialchars($flash['message'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    </div>
<?php endif; ?>
