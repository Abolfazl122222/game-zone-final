<?php
$dbHost = 'localhost';
$dbName = 'game_zone';
$dbUser = 'root';
$dbPass = '';

/**
 * در صورت در دسترس نبودن MySQL، یک دیتابیس SQLite محلی می‌سازیم
 * تا صفحات سایت (و استایل‌ها) بدون خطای 500 بارگذاری شوند.
 */
function bootstrap_sqlite(PDO $pdo): void
{
    $pdo->exec('CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password_hash TEXT NOT NULL,
        role TEXT NOT NULL DEFAULT "user",
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )');

    $pdo->exec('CREATE TABLE IF NOT EXISTS games (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        slug TEXT NOT NULL UNIQUE,
        title TEXT NOT NULL,
        cover TEXT NOT NULL,
        short_description TEXT NOT NULL,
        genre TEXT NOT NULL,
        rating TEXT NOT NULL DEFAULT "--",
        story TEXT NOT NULL,
        features TEXT,
        gallery TEXT,
        video_link TEXT,
        content_type TEXT NOT NULL DEFAULT "game",
        min_requirements TEXT,
        rec_requirements TEXT,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    )');

    $userCount = (int) $pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
    if ($userCount === 0) {
        $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)');
        $stmt->execute([
            'name' => 'مدیر سایت',
            'email' => 'admin@gamezone.local',
            // admin12345
            'password_hash' => password_hash('admin12345', PASSWORD_DEFAULT),
            'role' => 'admin',
        ]);
    }

    $gamesCount = (int) $pdo->query('SELECT COUNT(*) FROM games')->fetchColumn();
    if ($gamesCount === 0) {
        $seedItems = [
            ['rdr2', 'Red Dead Redemption 2', 'images/rdr2.jpg', 'داستانی سینمایی در غرب وحشی با جهان باز غنی.', 'اکشن | ماجراجویی | وسترن', '9.8/10', 'game'],
            ['alan-wake-2', 'Alan Wake 2', 'images/alan.jpg', 'ترس روانشناختی با کارگردانی سینمایی و داستان چندلایه.', 'ترسناک | داستانی', '9.1/10', 'game'],
            ['cyberpunk-2077', 'Cyberpunk 2077', 'images/cyberpunk-2077.jpg', 'جهان آینده‌نگر با مأموریت‌های گسترده و آزادی عمل بالا.', 'اکشن | نقش‌آفرینی', '8.8/10', 'game'],
            ['fc-25', 'EA Sports FC 25', 'images/fifa25.jpg', 'شبیه‌ساز فوتبال نسل جدید با لایسنس کامل تیم‌ها.', 'ورزشی | شبیه‌سازی', '8.4/10', 'game'],
            ['pad-pro', 'DualSense Pro', 'images/2.jpg', 'دسته حرفه‌ای با هپتیک قدرتمند و ارگونومی عالی.', 'لوازم جانبی | کنترلر', '--', 'product'],
            ['headset-x7', 'Headset X7', 'images/1.jpg', 'هدست بی‌سیم با صدای فراگیر 7.1 و میکروفون حذف نویز.', 'لوازم جانبی | هدست', '--', 'product'],
            ['keyboard-k9', 'Keyboard K9', 'images/4.jpg', 'کیبورد مکانیکال RGB با سوئیچ سریع برای بازی رقابتی.', 'لوازم جانبی | کیبورد', '--', 'product'],
        ];

        $stmt = $pdo->prepare('INSERT INTO games (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements)
            VALUES (:slug, :title, :cover, :short_description, :genre, :rating, :story, :features, :gallery, :video_link, :content_type, :min_requirements, :rec_requirements)');

        foreach ($seedItems as $item) {
            $stmt->execute([
                'slug' => $item[0],
                'title' => $item[1],
                'cover' => $item[2],
                'short_description' => $item[3],
                'genre' => $item[4],
                'rating' => $item[5],
                'story' => json_encode([$item[3]], JSON_UNESCAPED_UNICODE),
                'features' => json_encode(['طراحی مدرن'], JSON_UNESCAPED_UNICODE),
                'gallery' => json_encode([$item[2]], JSON_UNESCAPED_UNICODE),
                'video_link' => '#',
                'content_type' => $item[6],
                'min_requirements' => '-',
                'rec_requirements' => '-',
            ]);
        }
    }
}

try {
    $dsn = "mysql:host={$dbHost};dbname={$dbName};charset=utf8mb4";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // fallback: SQLite local db (برای جلوگیری از سفید شدن سایت در محیط بدون MySQL)
    $sqlitePath = __DIR__ . '/../database/game_zone.sqlite';
    $pdo = new PDO('sqlite:' . $sqlitePath, null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    bootstrap_sqlite($pdo);
}
