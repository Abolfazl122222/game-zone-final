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
('مدیر سایت', 'admin@gamezone.local', '$2y$10$8Vj8MTkqqzQhQ2U5GdeEI.SdM8e0B4I6QNT6lgfR2PrO7f2xEdxjW', 'admin');
-- رمز عبور پیش‌فرض: admin12345

INSERT INTO games (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements) VALUES
('rdr2', 'Red Dead Redemption 2', 'images/rdr2.jpg', 'داستانی سینمایی در غرب وحشی با جهان باز غنی.', 'اکشن | ماجراجویی | وسترن', '9.8/10',
 JSON_ARRAY('داستان آرتور مورگان و گروه Van der Linde در دوران افول غرب وحشی.', 'این بازی با روایت عمیق و گرافیک چشم‌نواز، یکی از بهترین آثار تاریخ است.'),
 JSON_ARRAY('جهان باز زنده و پویا', 'روایت داستانی درخشان', 'جزئیات فنی سطح بالا'),
 JSON_ARRAY('images/RDR2Screenshot.jpg','images/RDR2Screenshot2.jpg'),
 '#', 'game',
 'OS: Windows 10\nCPU: i5-2500K\nRAM: 8GB\nGPU: GTX 770\nStorage: 150GB',
 'OS: Windows 10\nCPU: i7-4770K\nRAM: 12GB\nGPU: GTX 1060\nStorage: 150GB'
),
('pad-pro', 'DualSense Pro', 'images/2.jpg', 'دسته حرفه‌ای با هپتیک قدرتمند و ارگونومی عالی.', 'لوازم جانبی | کنترلر', '--',
 JSON_ARRAY('مناسب برای گیمرهای حرفه‌ای روی PC و PS5.'),
 JSON_ARRAY('هپتیک پیشرفته', 'طراحی ارگونومیک', 'باتری بادوام'),
 JSON_ARRAY('images/2.jpg','images/4.jpg'),
 '#', 'product',
 'سازگار با PC و PS5',
 'اقلام داخل جعبه: دسته، کابل USB-C، دفترچه راهنما'
);
