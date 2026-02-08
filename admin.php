<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

require_admin();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $slug = strtolower(trim($_POST['slug'] ?? ''));
    $slug = preg_replace('/[^a-z0-9-]/', '-', $slug);
    $title = trim($_POST['title'] ?? '');
    $cover = trim($_POST['cover'] ?? '');
    $shortDescription = trim($_POST['short_description'] ?? '');
    $genre = trim($_POST['genre'] ?? '');
    $rating = trim($_POST['rating'] ?? '');
    $videoLink = trim($_POST['video_link'] ?? '');
    $contentType = trim($_POST['content_type'] ?? 'game');
    $minRequirements = trim($_POST['min_requirements'] ?? '');
    $recRequirements = trim($_POST['rec_requirements'] ?? '');

    $storyLines = array_filter(array_map('trim', explode("\n", $_POST['story'] ?? '')));
    $featureLines = array_filter(array_map('trim', explode("\n", $_POST['features'] ?? '')));
    $galleryLines = array_filter(array_map('trim', explode("\n", $_POST['gallery'] ?? '')));

    if ($slug && $title && $cover && $shortDescription && $genre) {
        $stmt = $pdo->prepare('
            INSERT INTO games
            (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements)
            VALUES
            (:slug, :title, :cover, :short_description, :genre, :rating, :story, :features, :gallery, :video_link, :content_type, :min_requirements, :rec_requirements)
        ');

        try {
            $stmt->execute([
                'slug' => $slug,
                'title' => $title,
                'cover' => $cover,
                'short_description' => $shortDescription,
                'genre' => $genre,
                'rating' => $rating ?: '--',
                'story' => json_encode($storyLines, JSON_UNESCAPED_UNICODE),
                'features' => json_encode($featureLines, JSON_UNESCAPED_UNICODE),
                'gallery' => json_encode($galleryLines, JSON_UNESCAPED_UNICODE),
                'video_link' => $videoLink,
                'content_type' => $contentType ?: 'game',
                'min_requirements' => $minRequirements,
                'rec_requirements' => $recRequirements,
            ]);
            $message = 'آیتم جدید با موفقیت اضافه شد.';
        } catch (PDOException $e) {
            $message = 'خطا در ثبت آیتم. لطفاً اسلاگ تکراری نباشد.';
        }
    } else {
        $message = 'لطفاً همه فیلدهای ضروری را کامل کنید.';
    }
}

$items = $pdo->query('SELECT id, title, slug, content_type, created_at FROM games ORDER BY created_at DESC')->fetchAll();
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>پنل مدیریت | GameZone</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/footer.css">
</head>
<body>

<?php include 'includes/header.php'; ?>

<main class="admin-container">
  <section class="admin-hero">
    <h1>پنل مدیریت GameZone</h1>
    <p>از اینجا می‌تونی بازی‌ها، محصولات و محتواهای جدید رو سریع اضافه کنی.</p>
  </section>

  <?php if ($message): ?>
    <div class="admin-alert"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
  <?php endif; ?>

  <section class="admin-grid">
    <div class="admin-card">
      <h2>افزودن آیتم جدید</h2>
      <form class="admin-form" method="POST">
        <div class="field-row">
          <label>نوع محتوا</label>
          <select name="content_type">
            <option value="game">بازی</option>
            <option value="product">محصول</option>
          </select>
        </div>
        <div class="field-row">
          <label>اسلاگ (انگلیسی)</label>
          <input type="text" name="slug" placeholder="مثلاً gta-vi" required>
        </div>
        <div class="field-row">
          <label>عنوان</label>
          <input type="text" name="title" placeholder="نام بازی یا محصول" required>
        </div>
        <div class="field-row">
          <label>آدرس تصویر کاور</label>
          <input type="text" name="cover" placeholder="images/example.jpg" required>
        </div>
        <div class="field-row">
          <label>توضیح کوتاه</label>
          <textarea name="short_description" rows="3" required></textarea>
        </div>
        <div class="field-row">
          <label>ژانر / دسته‌بندی</label>
          <input type="text" name="genre" placeholder="اکشن | ماجراجویی" required>
        </div>
        <div class="field-row">
          <label>امتیاز</label>
          <input type="text" name="rating" placeholder="9.5/10">
        </div>
        <div class="field-row">
          <label>داستان (هر خط یک پاراگراف)</label>
          <textarea name="story" rows="4"></textarea>
        </div>
        <div class="field-row">
          <label>ویژگی‌ها (هر خط یک مورد)</label>
          <textarea name="features" rows="4"></textarea>
        </div>
        <div class="field-row">
          <label>گالری (هر خط یک آدرس تصویر)</label>
          <textarea name="gallery" rows="3"></textarea>
        </div>
        <div class="field-row">
          <label>لینک ویدیو</label>
          <input type="text" name="video_link" placeholder="https://...">
        </div>
        <div class="field-row">
          <label>سیستم پیشنهادی (هر خط یک مورد)</label>
          <textarea name="rec_requirements" rows="4"></textarea>
        </div>
        <div class="field-row">
          <label>سیستم حداقل (هر خط یک مورد)</label>
          <textarea name="min_requirements" rows="4"></textarea>
        </div>
        <button type="submit" class="primary-btn">ثبت آیتم</button>
      </form>
    </div>

    <div class="admin-card">
      <h2>آخرین آیتم‌ها</h2>
      <ul class="admin-list">
        <?php foreach ($items as $item): ?>
          <li>
            <span><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></span>
            <span class="badge"><?php echo htmlspecialchars($item['content_type'], ENT_QUOTES, 'UTF-8'); ?></span>
            <span class="muted">/<?php echo htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
