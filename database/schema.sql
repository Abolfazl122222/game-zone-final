CREATE DATABASE IF NOT EXISTS game_zone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE game_zone;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role VARCHAR(20) NOT NULL DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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
);

INSERT INTO users (name, email, password_hash, role)
<<<<<<< HEAD
VALUES ('مدیر سایت','admin@gamezone.local','admin','admin');
=======
VALUES ('مدیر سایت','admin@gamezone.local','$2y$12$5B1CyBQrRk5twEv.EEAmRurV9dbxj//ssv97JDbOPlHkNTpIY5gNq','admin');
>>>>>>> af7bfc541f5b40a762a0fa301dbcb9fc4e91b778

INSERT INTO games (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements)
VALUES
('rdr2','Red Dead Redemption 2','images/rdr2.jpg','داستان Red Dead Redemption 2 در سال ۱۸۹۹ و در غرب وحشی جریان دارد. RDR2 در واقع پیش درآمدی بر داستان بازی اول است و زندگی آرتور مورگان را شرح می‌دهد.','اکشن | ماجراجویی | وسترن','9.8/10',
 JSON_ARRAY(
  'RDR2 روایت زندگی آرتور مورگان، عضو اصلی گروه Van der Linde است. داستان بازی درباره بقا، وفاداری و سقوط یک گروه خلافکار در آمریکا قرن 19 است.',
  '<strong>Red Dead Redemption 2</strong> یکی از بزرگ‌ترین و غنی‌ترین جهان‌های باز تاریخ بازی‌سازی را ارائه می‌دهد. روایت احساسی و بالغ آن، شخصیت‌پردازی بی‌نقص آرتور و موسیقی حماسی باعث شده این عنوان یکی از بهترین بازی‌های تاریخ باشد.',
  'جزئیات خیره‌کننده محیط، انیمیشن‌های فوق‌العاده و سیستم رفتار NPCها، RDR2 را به یک تجربه کاملاً زنده تبدیل کرده است.'
 ),
 JSON_ARRAY(
  'داستان عمیق با شخصیت‌پردازی بی‌نظیر',
  'یکی از واقعی‌ترین جهان‌های باز تاریخ',
  'گرافیک و نورپردازی سینمایی',
  'سیستم شکار، کمپ و تعامل با محیط',
  'تنوع مأموریت‌های فرعی و اصلی',
  'موسیقی فوق‌العاده حماسی و احساسی'
 ),
 JSON_ARRAY('images/RDR2Screenshot.jpg','images/RDR2Screenshot2.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel Core i5-2500K / AMD FX-6300\nRAM: 8GB\nGPU: Nvidia GeForce GTX 770 2GB / AMD Radeon R9 280 3GB\nStorage: 150GB',
 'OS: Windows 10 64-bit\nCPU: Intel Core i7-4770K / AMD Ryzen 5 1500X\nRAM: 12GB\nGPU: Nvidia GeForce GTX 1060 6GB / AMD Radeon RX 480 4GB\nStorage: 150GB'),
('gtavi','GTA VI','images/gta.jpg','یک بازی جهان‌باز با داستانی جذاب و گرافیکی فوق‌العاده که در شهر Los Santos جریان دارد.','اکشن | جهان باز','9.5/10',
 JSON_ARRAY('GTA VI جدیدترین نسخه از سری محبوب Grand Theft Auto است که در شهری با گرافیک نسل جدید جریان دارد. این بازی یک تجربه جهان‌باز کامل با مأموریت‌های داستانی، رانندگی، تیراندازی و آزادی عمل گسترده ارائه می‌دهد.'),
 JSON_ARRAY(),
 JSON_ARRAY('images/screengta2.jpg','images/screengta.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel Core i5-8400 / AMD Ryzen 5 2600\nRAM: 8GB\nGPU: GTX 1060 / RX 580\nStorage: 120GB',
 'OS: Windows 11 64-bit\nCPU: Intel Core i7-10700 / AMD Ryzen 7 3700X\nRAM: 16GB\nGPU: RTX 2070 / RX 5700 XT\nStorage: 120GB'),
('gow','God of War','images/godofwar.jpg','کریتوس و پسرش در سفری اسطوره‌ای میان دنیای خدایان نورس؛ اکشن، احساس و داستان عمیق.','اکشن | اسطوره‌ای','9.7/10',
 JSON_ARRAY(
  'نسخه جدید God of War ادامه‌ای بر داستان کریتوس است که این بار همراه پسرش آترئوس وارد سفری عمیق و احساسی در دنیای خدایان نورس می‌شود. بازی ترکیبی از مبارزات نفس‌گیر، روایت سینمایی و گرافیک باورنکردنی است که تجربه‌ای متفاوت برای بازیکنان رقم می‌زند.',
  'بازی <strong>God of War</strong> یکی از شاهکارهای استودیو <em>Santa Monica</em> است که با ترکیبی از اکشن نفس‌گیر، داستانی احساسی و گرافیکی خیره‌کننده، تجربه‌ای فراموش‌نشدنی را رقم می‌زند. این نسخه، بازسازی کامل سری کلاسیک است و داستان <strong>کریتوس</strong> را پس از وقایع نسخه‌های یونانی دنبال می‌کند؛ جایی که او به سرزمین اساطیر نورس مهاجرت کرده و با پسرش <strong>آتروس</strong> زندگی می‌کند.',
  'رابطه پدر و پسر، محور اصلی داستان است و در کنار نبردهای نفس‌گیر با خدایان اسکاندیناوی، حس عمیق انسانی و درامی قوی را به بازیکن منتقل می‌کند. از نظر فنی، بازی یکی از زیباترین عناوین نسل خود به حساب می‌آید و با موسیقی حماسی <em>Bear McCreary</em>، فضایی اسطوره‌ای و پرشکوه می‌سازد.'
 ),
 JSON_ARRAY(
  'نبردهای سینمایی با دوربین یک‌تکه بدون کات',
  'روایت احساسی از رابطه پدر و پسر در دنیای اساطیری',
  'دشمنان و باس‌فایت‌های متنوع از خدایان نورس',
  'گرافیک فوق‌العاده و طراحی هنری چشم‌نواز',
  'سیستم ارتقای سلاح‌ها و مهارت‌های عمیق',
  'موسیقی متن حماسی و فضاساز'
 ),
 JSON_ARRAY('images/gowscreen3.jpg','images/gow3.jpeg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-2500K / AMD Ryzen 3 1200\nRAM: 8GB\nGPU: GTX 960 / R9 290X\nStorage: 70GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-4770K / AMD Ryzen 7 2700X\nRAM: 16GB\nGPU: GTX 1060 6GB / RX 570\nStorage: 70GB'),
('fc25','FC 25','images/fifa25.jpg','جدیدترین نسخه از بازی فوتبال محبوب با گیم‌پلی بهبود یافته و گرافیکی واقعی‌تر از همیشه.','ورزشی','9.1/10',
 JSON_ARRAY(
  'بازی <strong>EA Sports FC 25</strong> جدیدترین نسخه از سری فوتبال محبوب EA است که پس از جدایی از برند فیفا، هویت مستقل خود را تثبیت کرده است. این عنوان با موتور قدرتمند <em>Frostbite</em> و تکنولوژی انیمیشن جدید <strong>HyperMotion V</strong> تجربه‌ای واقع‌گرایانه‌تر از همیشه ارائه می‌دهد.',
  'گیم‌پلی بازی دچار تحول‌های عمیقی شده؛ کنترل توپ روان‌تر، برخوردهای فیزیکی طبیعی‌تر و هوش مصنوعی پیشرفته‌تر از نسل قبل باعث شده که حس واقعی فوتبال را در زمین لمس کنید. حالت‌های محبوبی مانند <strong>Ultimate Team</strong>، <strong>Career Mode</strong> و <strong>VOLTA Football</strong> نیز با امکانات جدید و رابط کاربری مدرن‌تر بازگشته‌اند.'
 ),
 JSON_ARRAY(
  'گرافیک فوق‌العاده واقع‌گرایانه با نورپردازی نسل جدید',
  'سیستم انیمیشن جدید با بیش از ۶۰۰۰ حرکت واقعی بازیکنان',
  'هوش مصنوعی بهبود یافته در تصمیم‌گیری بازیکنان',
  'اضافه شدن حالت تمرینات تیمی و تاکتیکی در Career Mode',
  'حضور لیگ‌ها و تیم‌های جدید از سراسر دنیا',
  'گیم‌پلی سریع‌تر و طبیعی‌تر در تمام پلتفرم‌ها'
 ),
 JSON_ARRAY('images/fc25screen1.jpg','images/eafc25_09_2.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-6600K / AMD Ryzen 5 1600\nRAM: 8GB\nGPU: GTX 1050 Ti / RX 570\nStorage: 50GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-6700 / AMD Ryzen 7 2700X\nRAM: 16GB\nGPU: GTX 1660 / RX 5600 XT\nStorage: 50GB'),
('last2','The Last of Us Part II','images/the lastofus.jpg','داستان بازی The Last of Us در سال ۲۰۳۳ و بیست سال بعد از یک شیوع قارچی که نزدیک به ۶۰ درصد جمعیت دنیا را آلوده کرد، جریان دارد.','اکشن | بقا | داستان‌محور','9.6/10',
 JSON_ARRAY(
  'The Last of Us Part II دنباله‌ای بر داستان الی و جوئل است و چند سال پس از وقایع نسخه اول اتفاق می‌افتد. روایت پیچیده، تلخ و احساسی بازی، بازیکنان را در سفری پر از انتقام، تضادهای اخلاقی و تصمیم‌های دشوار قرار می‌دهد.',
  'بازی <strong>The Last of Us Part II</strong> یکی از بحث‌برانگیزترین و در عین حال تحسین‌شده‌ترین عناوین استودیو <em>Naughty Dog</em> است. تمرکز اصلی داستان بر شخصیت <strong>الی</strong> است که حالا بزرگ‌تر شده و با چالش‌های تازه‌ای روبه‌رو می‌شود. بازی به‌طور عمیق به موضوعات انسانی، خشونت، احساسات و پیامدهای انتخاب‌ها می‌پردازد.',
  'گرافیک شگفت‌انگیز، انیمیشن‌های واقع‌گرایانه و محیط‌های فوق‌العاده جزئی‌پردازی‌شده باعث شده این بازی یکی از چشم‌گیرترین عناوین نسل پلی‌استیشن باشد. موسیقی احساسی <em>Gustavo Santaolalla</em> هم همانند نسخه اول نقش مهمی در انتقال حس داستان دارد.'
 ),
 JSON_ARRAY(
  'روایت احساسی، بالغ و چندلایه با تمرکز روی الی',
  'گرافیک فوق‌العاده واقع‌گرایانه و انیمیشن‌های طبیعی',
  'گیم‌پلی بقا محور با مخفی‌کاری و مبارزات تن‌به‌تن',
  'دشمنان انسانی با رفتارهای هوشمندانه‌تر نسبت به نسخه قبل',
  'تنوع مناطق و محیط‌های با جزئیات بالا',
  'موسیقی متفاوت و احساسی ساخته گوستاوو سانتائولایا'
 ),
 JSON_ARRAY('images/last2of.jpg','images/ellie.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-8400 / AMD Ryzen 5 2600\nRAM: 8GB\nGPU: GTX 1060 / RX 580\nStorage: 100GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-9700K / AMD Ryzen 7 3700X\nRAM: 16GB\nGPU: RTX 2060 / RX 5700\nStorage: 100GB'),
('ghost','Ghost Of Tsushima','images/1.jpg','داستان بازی Ghost of Tsushima در سال 1274 جریان دارد که مغول‌ها به رهبری کوتان خان، نوه چنگیز خان، به سوشیمای ژاپن حمله کرده‌اند.','اکشن | ماجراجویی | تاریخی','9.2/10',
 JSON_ARRAY(
  'Ghost of Tsushima روایت حماسی جین ساکای است؛ سامورایی‌ای که برای نجات جزیره‌اش باید میان وفاداری به سنت‌ها و استفاده از روش‌های جدید مبارزه تصمیم بگیرد.',
  'بازی با دنیای باز چشم‌نواز، دوئل‌های سینمایی و اتمسفر ژاپن فئودال، تجربه‌ای اصیل و پر از زیبایی‌های بصری ارائه می‌دهد.'
 ),
 JSON_ARRAY(
  'جهان باز با محیط‌های متنوع و دیدنی',
  'سیستم مبارزات سامورایی و مخفی‌کاری',
  'روایت احساسی با انتخاب‌های اخلاقی',
  'موسیقی و جلوه‌های بصری الهام‌گرفته از ژاپن کلاسیک'
 ),
 JSON_ARRAY('images/2.jpg','images/4.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-4670 / AMD Ryzen 3 1200\nRAM: 8GB\nGPU: GTX 970 / RX 470\nStorage: 75GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-6700 / AMD Ryzen 5 3600\nRAM: 16GB\nGPU: GTX 1070 / RX 5600 XT\nStorage: 75GB'),
('revill','Resident Evil Village','images/resident-evil-village.jpg','در فوریه 2021 ایتان وینترز و همسشر میا، توسط کریس ردفیلد به منطقه‌ای در شرق اروپا منتقل شده و زندگی خود را ادامه می‌دهند.','ترسناک | بقا | اکشن','9.0/10',
 JSON_ARRAY(
  'داستان بازی بعد از وقایع Resident Evil 7 ادامه پیدا می‌کند. ایتان وینترز که به همراه همسرش میا به منطقه‌ای آرام نقل مکان کرده‌اند، ناگهان با حمله وحشیانه مرموزی روبه‌رو می‌شوند. ایتان برای نجات دخترش «رُز» وارد دهکده‌ای تاریک و مرموز می‌شود.',
  '<strong>Resident Evil Village</strong> ترکیبی فوق‌العاده از ترس روانی، اکشن قدرتمند و فضاسازی بی‌نقص است. معماری گوتیک، شخصیت‌های جذاب مانند لیدی دیمیتریسکو و دشمنان متنوع باعث شده این نسخه یکی از بهترین‌های سری Resident Evil باشد.',
  'تنوع محیط‌ها—از قلعه‌ها گرفته تا جنگل‌های برفی و کارخانه‌های متروکه—ریتم بازی را بسیار پویا می‌کند.'
 ),
 JSON_ARRAY(
  'ترکیب عالی ترس، ماجراجویی و اکشن',
  'حضور شخصیت محبوب Lady Dimitrescu',
  'محیط‌های متنوع و بسیار زیبا',
  'داستان جذاب و پر پیچ‌وخم',
  'مبارزات تنش‌زا و Boss Fightهای چالش‌برانگیز',
  'صداگذاری و موسیقی فوق‌العاده'
 ),
 JSON_ARRAY('images/resident-evil-villagess.jpg','images/resident-evil-8-desktop-hd-wallpapers.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-7500 / AMD Ryzen 3 1200\nRAM: 8GB\nGPU: GTX 1050 Ti / RX 560\nStorage: 28GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-8700 / AMD Ryzen 5 3600\nRAM: 16GB\nGPU: GTX 1070 / RX 5700\nStorage: 28GB'),
('acsha','Assassin''s Creed Shadows','images/images.jpg','داستان بازی Assassin''s Creed Shadows در ژاپن فئودال قرار دارد ، به طور خاص از سال 1579 در دوره آزوچی مومویاما شروع می شود.','اکشن | مخفی‌کاری | تاریخی','9.1/10',
 JSON_ARRAY(
  'Assassins Creed Shadows در ژاپن فئودال جریان دارد و بازیکن می‌تواند با دو شخصیت مختلف، یک سامورایی و یک نینجا، داستان را دنبال کند.',
  'این نسخه یکی از موردانتظارترین بازی‌های سری AC است و برای اولین بار حال‌وهوای ژاپن و فرهنگ سامورایی‌ها را وارد این مجموعه کرده است. گرافیک نسل جدید و مبارزات سنگین‌تر و سریع‌تر نسبت به نسخه‌های قبلی، تجربه‌ای جذاب ایجاد کرده است.'
 ),
 JSON_ARRAY(
  'بازی با دو شخصیت سامورایی و نینجا',
  'محیط‌های دیدنی ژاپن فئودال',
  'مبارزات واقع‌گرایانه شمشیری',
  'سیستم مخفی‌کاری پیشرفته‌تر',
  'داستان تاریخی با جزئیات',
  'گرافیک بسیار قوی'
 ),
 JSON_ARRAY('images/shadow.jpg','images/acsha1.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-6600K / AMD Ryzen 5 1400\nRAM: 8GB\nGPU: GTX 970 / RX 470\nStorage: 90GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-8700K / AMD Ryzen 7 2700X\nRAM: 16GB\nGPU: GTX 1070 / RX 5700\nStorage: 90GB'),
('cyber','Cyberpunk 2077','images/cyber.jpg','داستان بازی Cyberpunk 2077 در آینده و در شهری پر از جنایت به نام نایت سیتی جریان دارد که شرکت‌های بزرگ فراتر از قانون آن را کنترل می‌کنند.','نقش‌آفرینی | آینده‌نگر','8.9/10',
 JSON_ARRAY(
  'بازی در شهر آینده‌گرای Night City جریان دارد؛ شهری پر از فساد، قدرت، تکنولوژی و باندهای خلافکار. شما در نقش V هستید که در تلاش برای بقا و رسیدن به جایگاه خود در این شهر بی‌رحم است.',
  '<strong>Cyberpunk 2077</strong> با فضای نئونی و دیستوپیایی خود یکی از منحصر‌به‌فردترین جهان‌های بازی‌سازی را خلق کرده است. حضور شخصیت جانی سیلورهند با بازی \"کیانو ریوز\"، عمق بیشتری به روایت می‌دهد.',
  'با وجود مشکلات اولیه، نسخه‌های به‌روزرسانی‌شده الآن تجربه‌ای بسیار روان‌تر و فوق‌العاده‌تر ارائه می‌دهند.'
 ),
 JSON_ARRAY(
  'جهان نئونی و چشم‌نواز Night City',
  'داستان نقش‌آفرینی با انتخاب‌های تأثیرگذار',
  'ماموریت‌های جانبی عمیق و شخصیت‌محور',
  'مبارزات اسلحه‌ای و هکینگ جذاب',
  'بازیگری فوق‌العاده کیانو ریوز',
  'گرافیک نسل جدید با Ray Tracing'
 ),
 JSON_ARRAY('images/cyberpunk-2077.jpg','images/cyberpunk-2077s.jpg'),
 '#','game',
 'OS: Windows 10 64-bit\nCPU: Intel i5-3570K / AMD FX-8310\nRAM: 8GB\nGPU: GTX 780 / RX 470\nStorage: 70GB',
 'OS: Windows 10 64-bit\nCPU: Intel i7-4790 / AMD Ryzen 3 3200G\nRAM: 16GB\nGPU: GTX 1060 / RX 590\nStorage: 70GB'),
('pad-pro','DualSense Pro','images/2.jpg','دسته حرفه‌ای مخصوص گیمرها با طراحی ارگونومیک و لرزش پیشرفته.','لوازم جانبی | کنترلر','--',
 JSON_ARRAY('DualSense Pro یک دسته قدرتمند برای تجربه بهتر بازی‌هاست.'),
 JSON_ARRAY('هپتیک پیشرفته','دکمه‌های قابل تنظیم','باتری قدرتمند'),
 JSON_ARRAY('images/2.jpg','images/4.jpg'),
 '#','product',
 'سازگار با PC و PS5\nاتصال USB-C / بلوتوث','اقلام داخل جعبه: دسته، کابل USB-C، دفترچه راهنما');
