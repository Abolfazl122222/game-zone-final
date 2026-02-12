<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('register.php');
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = strtolower(trim((string) ($_POST['email'] ?? '')));
$password = (string) ($_POST['password'] ?? '');
<<<<<<< HEAD
$confirmPassword = (string) ($_POST['confirm_password'] ?? '');
$baseQuery = 'name=' . urlencode($name) . '&email=' . urlencode($email);

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    redirect('register.php?error=validation&' . $baseQuery);
}

if ($password !== $confirmPassword) {
    redirect('register.php?error=password_mismatch&' . $baseQuery);
=======

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8) {
    redirect('register.php?error=validation');
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
}

$existsStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email LIMIT 1');
$existsStmt->execute(['email' => $email]);
if ($existsStmt->fetch()) {
<<<<<<< HEAD
    redirect('register.php?error=exists&' . $baseQuery);
=======
    redirect('register.php?error=exists');
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
}

$insertStmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)');
$insertStmt->execute([
    'name' => $name,
    'email' => $email,
    'password_hash' => password_hash($password, PASSWORD_DEFAULT),
    'role' => 'user',
]);

<<<<<<< HEAD
set_flash('success', 'ثبت‌نام با موفقیت انجام شد. اکنون وارد حساب خود شوید.');
=======
set_flash('success', 'ثبت‌نام با موفقیت انجام شد. حالا وارد شوید.');
>>>>>>> f23af7109e33f030aba7b4998e70200ad56181e8
redirect('login.php');
