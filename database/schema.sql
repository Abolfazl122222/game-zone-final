CREATE DATABASE IF NOT EXISTS game_zone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE game_zone;

DROP TABLE IF EXISTS games;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','user') NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE games (
  id INT AUTO_INCREMENT PRIMARY KEY,
  slug VARCHAR(80) NOT NULL UNIQUE,
  title VARCHAR(120) NOT NULL,
  cover VARCHAR(255) NOT NULL,
  short_description TEXT NOT NULL,
  genre VARCHAR(120) NOT NULL,
  rating VARCHAR(20) NOT NULL DEFAULT '--',
  story JSON NOT NULL,
  features JSON NULL,
  gallery JSON NULL,
  video_link VARCHAR(255) NULL,
  content_type ENUM('game','product') NOT NULL DEFAULT 'game',
  min_requirements TEXT NULL,
  rec_requirements TEXT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password_hash, role) VALUES
('مدیر سایت', 'admin@gamezone.local', '$2y$12$ARZHWNHjGiWVrbMKWki1jeM3m.U6kHDI2wmaYEqSUaKvbAEJ8Hpz.', 'admin');
-- رمز عبور پیش‌فرض: admin12345

INSERT INTO games (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements) VALUES
('rdr2', 'Red Dead Redemption 2', 'images/rdr2.jpg', 'داستانی سینمایی در غرب وحشی با جهان باز غنی.', 'اکشن | ماجراجویی | وسترن', '9.8/10',
 JSON_ARRAY('داستان آرتور مورگان و گروه Van der Linde در دوران افول غرب وحشی.', 'روایت عمیق، دنیای پویا و جزئیات فنی چشمگیر.'),
 JSON_ARRAY('جهان باز زنده', 'مأموریت‌های متنوع', 'گرافیک سطح بالا'),
 JSON_ARRAY('images/RDR2Screenshot.jpg', 'images/RDR2Screenshot2.jpg'),
 '#', 'game',
 'OS: Windows 10\nCPU: i5-2500K\nRAM: 8GB\nGPU: GTX 770\nStorage: 150GB',
 'OS: Windows 10\nCPU: i7-4770K\nRAM: 12GB\nGPU: GTX 1060\nStorage: 150GB'
),
('alan-wake-2', 'Alan Wake 2', 'images/alan.jpg', 'ترس روانشناختی با کارگردانی سینمایی و داستان چندلایه.', 'ترسناک | داستانی', '9.1/10',
 JSON_ARRAY('ترکیب روایت سینمایی و مکانیک‌های بقای مدرن.', 'داستان دو شخصیت با زاویه دید متفاوت.'),
 JSON_ARRAY('نورپردازی پیشرفته', 'روایت اپیزودیک', 'طراحی صدا حرفه‌ای'),
 JSON_ARRAY('images/alan2.jpg', 'images/alan-wake-2-cover-uhd-4k-wallpaper.jpg'),
 '#', 'game',
 'OS: Windows 10 64-bit\nCPU: Ryzen 5 2600\nRAM: 16GB\nGPU: RTX 2060\nStorage: 90GB',
 'OS: Windows 11 64-bit\nCPU: Ryzen 7 3700X\nRAM: 16GB\nGPU: RTX 3070\nStorage: 90GB SSD'
),
('cyberpunk-2077', 'Cyberpunk 2077', 'images/cyberpunk-2077.jpg', 'جهان آینده‌نگر با مأموریت‌های گسترده و آزادی عمل بالا.', 'اکشن | نقش‌آفرینی', '8.8/10',
 JSON_ARRAY('ماجراجویی V در شهر Night City.', 'تمرکز روی انتخاب‌های بازیکن و ساخت بیلد شخصی.'),
 JSON_ARRAY('شهر باز عظیم', 'مأموریت‌های جانبی زیاد', 'درخت مهارت متنوع'),
 JSON_ARRAY('images/cyberpunk-2077s.jpg', 'images/cyber.jpg'),
 '#', 'game',
 'OS: Windows 10\nCPU: i7-6700\nRAM: 12GB\nGPU: GTX 1060\nStorage: 70GB SSD',
 'OS: Windows 10/11\nCPU: i7-12700\nRAM: 16GB\nGPU: RTX 3060\nStorage: 70GB SSD'
),
('fc-25', 'EA Sports FC 25', 'images/fifa25.jpg', 'شبیه‌ساز فوتبال نسل جدید با لایسنس کامل تیم‌ها.', 'ورزشی | شبیه‌سازی', '8.4/10',
 JSON_ARRAY('گیم‌پلی تاکتیکی سریع همراه با حالت‌های آنلاین و آفلاین.', 'پشتیبانی از لیگ‌ها و رقابت‌های متنوع.'),
 JSON_ARRAY('Ultimate Team', 'Career Mode', 'گرافیک بهینه'),
 JSON_ARRAY('images/eafc25_09_2.jpg', 'images/fc25screen1.jpg'),
 '#', 'game',
 'OS: Windows 10\nCPU: i5-6600K\nRAM: 8GB\nGPU: GTX 1050 Ti\nStorage: 100GB',
 'OS: Windows 11\nCPU: i7-8700\nRAM: 12GB\nGPU: RTX 2060\nStorage: 100GB SSD'
),
('pad-pro', 'DualSense Pro', 'images/2.jpg', 'دسته حرفه‌ای با هپتیک قدرتمند و ارگونومی عالی.', 'لوازم جانبی | کنترلر', '--',
 JSON_ARRAY('مناسب برای گیمرهای حرفه‌ای روی PC و PS5.'),
 JSON_ARRAY('هپتیک پیشرفته', 'طراحی ارگونومیک', 'باتری بادوام'),
 JSON_ARRAY('images/2.jpg', 'images/4.jpg'),
 '#', 'product',
 'سازگار با PC و PS5',
 'اقلام داخل جعبه: دسته، کابل USB-C، دفترچه راهنما'
),
('headset-x7', 'Headset X7', 'images/1.jpg', 'هدست بی‌سیم با صدای فراگیر 7.1 و میکروفون حذف نویز.', 'لوازم جانبی | هدست', '--',
 JSON_ARRAY('تجربه صدای دقیق برای بازی‌های رقابتی.'),
 JSON_ARRAY('اتصال بی‌سیم کم‌تاخیر', 'باتری 30 ساعته', 'پدهای نرم و سبک'),
 JSON_ARRAY('images/1.jpg', 'images/moon.jpg'),
 '#', 'product',
 'اتصال USB و Bluetooth',
 'همراه دانگل USB، کابل شارژ و دفترچه راهنما'
);
