<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function current_user(): ?array
{
    return $_SESSION['user'] ?? null;
}

function is_admin(): bool
{
    return isset($_SESSION['user']) && ($_SESSION['user']['role'] ?? '') === 'admin';
}

function require_admin(): void
{
    if (!is_admin()) {
        header('Location: login.php?error=unauthorized');
        exit;
    }
}
