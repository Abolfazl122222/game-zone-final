<?php
$dbHost = 'localhost';
$dbName = 'game_zone';
$dbUser = 'root';
$dbPass = '';

try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo 'اتصال به پایگاه داده برقرار نشد.';
    exit;
}
