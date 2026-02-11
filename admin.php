<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';
require_admin();

function lines_to_json(string $value): string {
    $items = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $value) ?: [])));
    return json_encode($items, JSON_UNESCAPED_UNICODE);
}

$editingId = isset($_GET['edit']) ? (int) $_GET['edit'] : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'delete') {
        $id = (int) ($_POST['id'] ?? 0);
        $stmt = $pdo->prepare('DELETE FROM games WHERE id = :id');
        $stmt->execute(['id' => $id]);
        set_flash('success', 'آیتم با موفقیت حذف شد.');
        redirect('admin.php');
    }

    $id = (int) ($_POST['id'] ?? 0);
    $slug = trim((string) ($_POST['slug'] ?? ''));
    $title = trim((string) ($_POST['title'] ?? ''));
    $cover = trim((string) ($_POST['cover'] ?? ''));
    $shortDescription = trim((string) ($_POST['short_description'] ?? ''));
    $genre = trim((string) ($_POST['genre'] ?? ''));
    $rating = trim((string) ($_POST['rating'] ?? ''));
    $story = (string) ($_POST['story'] ?? '');
    $features = (string) ($_POST['features'] ?? '');
    $gallery = (string) ($_POST['gallery'] ?? '');
    $videoLink = trim((string) ($_POST['video_link'] ?? ''));
    $contentType = ($_POST['content_type'] ?? 'game') === 'product' ? 'product' : 'game';
    $minRequirements = trim((string) ($_POST['min_requirements'] ?? ''));
    $recRequirements = trim((string) ($_POST['rec_requirements'] ?? ''));

    if ($slug === '' || $title === '' || $cover === '' || $shortDescription === '' || $genre === '') {
        set_flash('error', 'فیلدهای ضروری را کامل کنید.');
        redirect($id ? 'admin.php?edit=' . $id : 'admin.php');
    }

    $payload = [
        'slug' => strtolower($slug),
        'title' => $title,
        'cover' => $cover,
        'short_description' => $shortDescription,
        'genre' => $genre,
        'rating' => $rating !== '' ? $rating : '--',
        'story' => lines_to_json($story),
        'features' => lines_to_json($features),
        'gallery' => lines_to_json($gallery),
        'video_link' => $videoLink,
        'content_type' => $contentType,
        'min_requirements' => $minRequirements,
        'rec_requirements' => $recRequirements,
    ];

    try {
        if ($id > 0) {
            $payload['id'] = $id;
            $stmt = $pdo->prepare('UPDATE games SET slug = :slug, title = :title, cover = :cover, short_description = :short_description, genre = :genre, rating = :rating, story = :story, features = :features, gallery = :gallery, video_link = :video_link, content_type = :content_type, min_requirements = :min_requirements, rec_requirements = :rec_requirements WHERE id = :id');
            $stmt->execute($payload);
            set_flash('success', 'آیتم با موفقیت ویرایش شد.');
        } else {
            $stmt = $pdo->prepare('INSERT INTO games (slug, title, cover, short_description, genre, rating, story, features, gallery, video_link, content_type, min_requirements, rec_requirements) VALUES (:slug, :title, :cover, :short_description, :genre, :rating, :story, :features, :gallery, :video_link, :content_type, :min_requirements, :rec_requirements)');
            $stmt->execute($payload);
            set_flash('success', 'آیتم جدید با موفقیت ایجاد شد.');
        }
        redirect('admin.php');
    } catch (PDOException $e) {
        set_flash('error', 'خطا در ذخیره اطلاعات. احتمالاً اسلاگ تکراری است.');
        redirect($id ? 'admin.php?edit=' . $id : 'admin.php');
    }
}

$editingItem = null;
if ($editingId > 0) {
    $stmt = $pdo->prepare('SELECT * FROM games WHERE id = :id LIMIT 1');
    $stmt->execute(['id' => $editingId]);
    $editingItem = $stmt->fetch();
    if ($editingItem) {
        $editingItem['story'] = implode("\n", json_decode($editingItem['story'] ?? '[]', true) ?: []);
        $editingItem['features'] = implode("\n", json_decode($editingItem['features'] ?? '[]', true) ?: []);
        $editingItem['gallery'] = implode("\n", json_decode($editingItem['gallery'] ?? '[]', true) ?: []);
    }
}

$items = $pdo->query('SELECT id, title, slug, content_type, created_at FROM games ORDER BY created_at DESC')->fetchAll();
$counts = $pdo->query("SELECT content_type, COUNT(*) AS total FROM games GROUP BY content_type")->fetchAll();
$gameCount = 0;
$productCount = 0;
foreach ($counts as $countRow) {
    if ($countRow['content_type'] === 'game') {
        $gameCount = (int) $countRow['total'];
    }
    if ($countRow['content_type'] === 'product') {
        $productCount = (int) $countRow['total'];
    }
}

$pageTitle = 'پنل مدیریت | GameZone';
include __DIR__ . '/includes/header.php';
?>
<main class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h1 class="h3 mb-1">پنل مدیریت حرفه‌ای</h1>
      <p class="text-secondary mb-0">مدیریت کامل آیتم‌ها، بازی‌ها و محصولات</p>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><div class="small text-secondary">تعداد بازی‌ها</div><div class="h4 mb-0"><?php echo $gameCount; ?></div></div></div>
    <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><div class="small text-secondary">تعداد محصولات</div><div class="h4 mb-0"><?php echo $productCount; ?></div></div></div>
    <div class="col-md-4"><div class="p-3 rounded-3 stat-card"><div class="small text-secondary">کل آیتم‌ها</div><div class="h4 mb-0"><?php echo count($items); ?></div></div></div>
  </div>

  <div class="row g-4">
    <div class="col-lg-5">
      <div class="card bg-black text-light panel-card">
        <div class="card-body">
          <h2 class="h5 mb-3"><?php echo $editingItem ? 'ویرایش آیتم' : 'ایجاد آیتم جدید'; ?></h2>
          <form method="post" class="vstack gap-2">
            <input type="hidden" name="id" value="<?php echo (int) ($editingItem['id'] ?? 0); ?>">
            <div><label class="form-label">نوع</label><select name="content_type" class="form-select"><option value="game" <?php echo (($editingItem['content_type'] ?? 'game') === 'game') ? 'selected' : ''; ?>>بازی</option><option value="product" <?php echo (($editingItem['content_type'] ?? '') === 'product') ? 'selected' : ''; ?>>محصول</option></select></div>
            <div><label class="form-label">اسلاگ</label><input class="form-control" name="slug" required value="<?php echo htmlspecialchars($editingItem['slug'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">عنوان</label><input class="form-control" name="title" required value="<?php echo htmlspecialchars($editingItem['title'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">تصویر کاور</label><input class="form-control" name="cover" required value="<?php echo htmlspecialchars($editingItem['cover'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">توضیح کوتاه</label><textarea class="form-control" name="short_description" required><?php echo htmlspecialchars($editingItem['short_description'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <div><label class="form-label">ژانر</label><input class="form-control" name="genre" required value="<?php echo htmlspecialchars($editingItem['genre'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">امتیاز</label><input class="form-control" name="rating" value="<?php echo htmlspecialchars($editingItem['rating'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">داستان (هر خط یک مورد)</label><textarea class="form-control" name="story" rows="3"><?php echo htmlspecialchars($editingItem['story'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <div><label class="form-label">ویژگی‌ها</label><textarea class="form-control" name="features" rows="3"><?php echo htmlspecialchars($editingItem['features'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <div><label class="form-label">گالری</label><textarea class="form-control" name="gallery" rows="3"><?php echo htmlspecialchars($editingItem['gallery'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <div><label class="form-label">ویدیو</label><input class="form-control" name="video_link" value="<?php echo htmlspecialchars($editingItem['video_link'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"></div>
            <div><label class="form-label">حداقل سیستم</label><textarea class="form-control" name="min_requirements" rows="3"><?php echo htmlspecialchars($editingItem['min_requirements'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <div><label class="form-label">سیستم پیشنهادی</label><textarea class="form-control" name="rec_requirements" rows="3"><?php echo htmlspecialchars($editingItem['rec_requirements'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></div>
            <button class="btn btn-info mt-2" type="submit"><?php echo $editingItem ? 'ذخیره ویرایش' : 'ایجاد آیتم'; ?></button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-7">
      <div class="card bg-black text-light panel-card">
        <div class="card-body">
          <h2 class="h5 mb-3">لیست آیتم‌ها</h2>
          <div class="table-responsive">
            <table class="table table-dark table-striped align-middle">
              <thead><tr><th>#</th><th>عنوان</th><th>اسلاگ</th><th>نوع</th><th>عملیات</th></tr></thead>
              <tbody>
                <?php foreach ($items as $row): ?>
                  <tr>
                    <td><?php echo (int) $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['slug'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($row['content_type'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td>
                      <a class="btn btn-sm btn-outline-info" href="admin.php?edit=<?php echo (int) $row['id']; ?>">ویرایش</a>
                      <form method="post" class="d-inline" onsubmit="return confirm('از حذف این آیتم مطمئن هستید؟')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?php echo (int) $row['id']; ?>">
                        <button class="btn btn-sm btn-outline-danger" type="submit">حذف</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
