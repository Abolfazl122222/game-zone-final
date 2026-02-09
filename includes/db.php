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
<<<<<<< HEAD

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(190) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            role VARCHAR(20) NOT NULL DEFAULT 'user',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS games (
            id INT AUTO_INCREMENT PRIMARY KEY,
            slug VARCHAR(50) NOT NULL UNIQUE,
            title VARCHAR(100) NOT NULL,
            cover VARCHAR(255) NOT NULL,
            short_description TEXT NOT NULL,
            genre VARCHAR(100) NOT NULL,
            rating VARCHAR(10) NOT NULL,
            story JSON NOT NULL,
            features JSON NULL,
            gallery JSON NULL,
            video_link VARCHAR(255) NULL,
            content_type VARCHAR(20) NOT NULL DEFAULT 'game',
            min_requirements TEXT NULL,
            rec_requirements TEXT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

    $columns = $pdo->query("
        SELECT COLUMN_NAME
        FROM INFORMATION_SCHEMA.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'games'
    ")->fetchAll(PDO::FETCH_COLUMN);

    if (!in_array('content_type', $columns, true)) {
        $pdo->exec("ALTER TABLE games ADD COLUMN content_type VARCHAR(20) NOT NULL DEFAULT 'game'");
    }
    if (!in_array('min_requirements', $columns, true)) {
        $pdo->exec("ALTER TABLE games ADD COLUMN min_requirements TEXT NULL");
    }
    if (!in_array('rec_requirements', $columns, true)) {
        $pdo->exec("ALTER TABLE games ADD COLUMN rec_requirements TEXT NULL");
    }
=======
>>>>>>> af7bfc541f5b40a762a0fa301dbcb9fc4e91b778
} catch (PDOException $e) {
    http_response_code(500);
    echo 'خطا در اتصال به پایگاه داده.';
    exit;
}
