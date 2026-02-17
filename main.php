<?php
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'کاتالوگ بازی‌ها | GameZone';
$search = trim((string) ($_GET['q'] ?? ''));
$type = ($_GET['type'] ?? 'all');
$type = in_array($type, ['all', 'game', 'product'], true) ? $type : 'all';

$sql = 'SELECT slug, title, cover, short_description, genre, rating, content_type FROM games';
$params = [];
$conditions = [];

if ($type !== 'all') {
    $conditions[] = 'content_type = :type';
    $params['type'] = $type;
}
if ($search !== '') {
    $conditions[] = '(title LIKE :q OR genre LIKE :q OR short_description LIKE :q)';
    $params['q'] = '%' . $search . '%';
}
if ($conditions) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}
$sql .= ' ORDER BY id DESC, title ASC';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$items = $stmt->fetchAll();

include __DIR__ . '/includes/header.php';
?>
<main class="container page-section">
  <section class="section-block">
    <div class="section-head">
      <div>
        <h1>کاتالوگ حرفه‌ای</h1>
        <p>جستجو و فیلتر بازی‌ها و محصولات</p>
      </div>
      <?php if (is_admin()): ?>
        <a href="admin.php" class="btn btn-outline">ورود به مدیریت</a>
      <?php endif; ?>
    </div>

    <form method="get" class="filter-box">
      <div class="field-grid">
        <div>
          <label>جستجو</label>
          <input name="q" placeholder="نام، ژانر یا توضیح..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <div>
          <label>نوع محتوا</label>
          <select name="type">
            <option value="all" <?php echo $type === 'all' ? 'selected' : ''; ?>>همه</option>
            <option value="game" <?php echo $type === 'game' ? 'selected' : ''; ?>>فقط بازی‌ها</option>
            <option value="product" <?php echo $type === 'product' ? 'selected' : ''; ?>>فقط محصولات</option>
          </select>
        </div>
        <div class="field-action">
          <button class="btn btn-primary" type="submit">اعمال فیلتر</button>
        </div>
      </div>
    </form>

    <?php if (!$items): ?>
      <div class="flash flash-info">موردی با این فیلتر پیدا نشد.</div>
    <?php endif; ?>

    <div class="cards-grid">
      <?php foreach ($items as $item): ?>
        <article class="content-card">
          <img src="<?php echo htmlspecialchars($item['cover'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>">
          <div class="card-body">
            <div class="meta-row">
              <h3><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
              <span class="tag"><?php echo htmlspecialchars($item['content_type'] === 'product' ? 'محصول' : 'بازی', ENT_QUOTES, 'UTF-8'); ?></span>
            </div>
            <p><?php echo htmlspecialchars($item['genre'], ENT_QUOTES, 'UTF-8'); ?> | ★ <?php echo htmlspecialchars($item['rating'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><?php echo htmlspecialchars($item['short_description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <a class="btn btn-primary" href="game.php?game=<?php echo urlencode($item['slug']); ?>">مشاهده جزئیات</a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </section>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
