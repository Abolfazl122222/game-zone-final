<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

require_admin();

$message = '';
<<<<<<< HEAD
$editingItem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'create';

    if ($action === 'delete') {
        $deleteId = (int)($_POST['id'] ?? 0);
        if ($deleteId) {
            $stmt = $pdo->prepare('DELETE FROM games WHERE id = :id');
            $stmt->execute(['id' => $deleteId]);
            $message = 'آیتم موردنظر حذف شد.';
        }
    } else {
        $editId = (int)($_POST['id'] ?? 0);
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
            try {
                if ($editId) {
                    $stmt = $pdo->prepare('
                        UPDATE games
                        SET slug = :slug,
                            title = :title,
                            cover = :cover,
                            short_description = :short_description,
                            genre = :genre,
                            rating = :rating,
                            story = :story,
                            features = :features,
                            gallery = :gallery,
                            video_link = :video_link,
                            content_type = :content_type,
                            min_requirements = :min_requirements,
                            rec_requirements = :rec_requirements
                        WHERE id = :id
                    ');
                    $stmt->execute([
                        'id' => $editId,
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
                    $message = 'آیتم موردنظر بروزرسانی شد.';
                } else {
                    $stmt = $pdo->prepare('
                        INSERT INTO games
                        (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements)
                        VALUES
                        (:slug, :title, :cover, :short_description, :genre, :rating, :story, :features, :gallery, :video_link, :content_type, :min_requirements, :rec_requirements)
                    ');
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
                }
            } catch (PDOException $e) {
                $message = 'خطا در ثبت آیتم. لطفاً اسلاگ تکراری نباشد.';
            }
        } else {
            $message = 'لطفاً همه فیلدهای ضروری را کامل کنید.';
        }
    }
}

if (isset($_GET['edit'])) {
    $editId = (int)$_GET['edit'];
    if ($editId) {
        $stmt = $pdo->prepare('SELECT * FROM games WHERE id = :id');
        $stmt->execute(['id' => $editId]);
        $editingItem = $stmt->fetch();
        if ($editingItem) {
            $editingItem['story'] = implode("\n", json_decode($editingItem['story'], true) ?: []);
            $editingItem['features'] = implode("\n", json_decode($editingItem['features'], true) ?: []);
            $editingItem['gallery'] = implode("\n", json_decode($editingItem['gallery'], true) ?: []);
        }
=======

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
>>>>>>> main
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
<<<<<<< HEAD
      <h2><?php echo $editingItem ? 'ویرایش آیتم' : 'افزودن آیتم جدید'; ?></h2>
      <form class="admin-form" method="POST">
        <input type="hidden" name="action" value="<?php echo $editingItem ? 'update' : 'create'; ?>">
        <?php if ($editingItem): ?>
          <input type="hidden" name="id" value="<?php echo (int)$editingItem['id']; ?>">
        <?php endif; ?>
        <div class="field-row">
          <label>نوع محتوا</label>
          <select name="content_type">
            <option value="game" <?php echo ($editingItem && $editingItem['content_type'] === 'game') ? 'selected' : ''; ?>>بازی</option>
            <option value="product" <?php echo ($editingItem && $editingItem['content_type'] === 'product') ? 'selected' : ''; ?>>محصول</option>
=======
      <h2>افزودن آیتم جدید</h2>
      <form class="admin-form" method="POST">
        <div class="field-row">
          <label>نوع محتوا</label>
          <select name="content_type">
            <option value="game">بازی</option>
            <option value="product">محصول</option>
>>>>>>> main
          </select>
        </div>
        <div class="field-row">
          <label>اسلاگ (انگلیسی)</label>
<<<<<<< HEAD
          <input type="text" name="slug" placeholder="مثلاً gta-vi" value="<?php echo htmlspecialchars($editingItem['slug'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="field-row">
          <label>عنوان</label>
          <input type="text" name="title" placeholder="نام بازی یا محصول" value="<?php echo htmlspecialchars($editingItem['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="field-row">
          <label>آدرس تصویر کاور</label>
          <input type="text" name="cover" placeholder="images/example.jpg" value="<?php echo htmlspecialchars($editingItem['cover'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="field-row">
          <label>توضیح کوتاه</label>
          <textarea name="short_description" rows="3" required><?php echo htmlspecialchars($editingItem['short_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="field-row">
          <label>ژانر / دسته‌بندی</label>
          <input type="text" name="genre" placeholder="اکشن | ماجراجویی" value="<?php echo htmlspecialchars($editingItem['genre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
        </div>
        <div class="field-row">
          <label>امتیاز</label>
          <input type="text" name="rating" placeholder="9.5/10" value="<?php echo htmlspecialchars($editingItem['rating'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="field-row">
          <label>داستان (هر خط یک پاراگراف)</label>
          <textarea name="story" rows="4"><?php echo htmlspecialchars($editingItem['story'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="field-row">
          <label>ویژگی‌ها (هر خط یک مورد)</label>
          <textarea name="features" rows="4"><?php echo htmlspecialchars($editingItem['features'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="field-row">
          <label>گالری (هر خط یک آدرس تصویر)</label>
          <textarea name="gallery" rows="3"><?php echo htmlspecialchars($editingItem['gallery'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="field-row">
          <label>لینک ویدیو</label>
          <input type="text" name="video_link" placeholder="https://..." value="<?php echo htmlspecialchars($editingItem['video_link'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div class="field-row">
          <label>سیستم پیشنهادی (هر خط یک مورد)</label>
          <textarea name="rec_requirements" rows="4"><?php echo htmlspecialchars($editingItem['rec_requirements'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <div class="field-row">
          <label>سیستم حداقل (هر خط یک مورد)</label>
          <textarea name="min_requirements" rows="4"><?php echo htmlspecialchars($editingItem['min_requirements'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </div>
        <button type="submit" class="primary-btn"><?php echo $editingItem ? 'ذخیره تغییرات' : 'ثبت آیتم'; ?></button>
        <?php if ($editingItem): ?>
          <a class="ghost-btn" href="admin.php">انصراف</a>
        <?php endif; ?>
=======
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
>>>>>>> main
      </form>
    </div>

    <div class="admin-card">
      <h2>آخرین آیتم‌ها</h2>
      <ul class="admin-list">
        <?php foreach ($items as $item): ?>
          <li>
<<<<<<< HEAD
            <div class="item-meta">
              <span><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></span>
              <span class="badge"><?php echo htmlspecialchars($item['content_type'], ENT_QUOTES, 'UTF-8'); ?></span>
              <span class="muted">/<?php echo htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <div class="item-actions">
              <a class="ghost-btn" href="admin.php?edit=<?php echo (int)$item['id']; ?>">ویرایش</a>
              <form method="POST" onsubmit="return confirm('آیا از حذف این آیتم مطمئن هستید؟');">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="id" value="<?php echo (int)$item['id']; ?>">
                <button type="submit" class="danger-btn">حذف</button>
              </form>
            </div>
=======
            <span><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></span>
            <span class="badge"><?php echo htmlspecialchars($item['content_type'], ENT_QUOTES, 'UTF-8'); ?></span>
            <span class="muted">/<?php echo htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8'); ?></span>
>>>>>>> main
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>
