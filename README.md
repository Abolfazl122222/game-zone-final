# game-zone-final

## راه‌اندازی سریع با WAMP

1. پروژه را داخل مسیر زیر قرار دهید:
   ```
   C:\wamp64\www\game-zone-final
   ```
2. در phpMyAdmin فایل زیر را Import کنید:
   ```
   database/schema.sql
   ```
3. در صورت نیاز اطلاعات اتصال دیتابیس را در فایل زیر تغییر دهید:
   ```
   includes/db.php
   ```
4. آدرس‌های اصلی:
   - لیست بازی‌ها: `http://localhost/game-zone-final/main.php`
   - پنل مدیریت: `http://localhost/game-zone-final/admin.php`
   - صفحه ورود: `http://localhost/game-zone-final/login.php`

اطلاعات ورود پیش‌فرض مدیر:
`admin@gamezone.local / admin123`
