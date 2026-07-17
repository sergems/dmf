<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Page Content';
$pdo = get_db();

$page_keys = [
    'about_mission'       => 'About — Mission Statement',
    'about_story'         => 'About — Our Story',
    'about_vision'        => 'About — Our Vision',
    'education_intro'     => 'Programs — Child Education',
    'child_protection_text' => 'Programs — Child Protection',
    'health_nutrition_text' => 'Programs — Health & Nutrition',
];

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $errors[] = 'Invalid request.';
    } else {
        $key = $_POST['page_key'] ?? '';
        if (!array_key_exists($key, $page_keys)) {
            $errors[] = 'Unknown page key.';
        } else {
            $title   = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');
            $stmt = $pdo->prepare("INSERT INTO page_content (page_key, title, content) VALUES (?,?,?)
                ON DUPLICATE KEY UPDATE title=VALUES(title), content=VALUES(content)");
            $stmt->execute([$key, $title, $content]);
            set_flash('success','Content updated: ' . $page_keys[$key]);
            redirect('/admin/pages.php');
        }
    }
}

// Load all page content
$all_content = [];
$rows = $pdo->query("SELECT * FROM page_content")->fetchAll();
foreach ($rows as $row) {
    $all_content[$row['page_key']] = $row;
}

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>

<?php if ($errors): ?><div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div><?php endif; ?>

<p class="admin-subtitle">Edit the text content displayed on the public website pages.</p>

<div class="pages-grid">
    <?php foreach ($page_keys as $key => $label): ?>
    <?php $c = $all_content[$key] ?? ['title'=>'','content'=>'']; ?>
    <div class="admin-card">
        <h3 class="page-section-title"><?= h($label) ?></h3>
        <form method="post" action="/admin/pages.php">
            <?= csrf_field() ?>
            <input type="hidden" name="page_key" value="<?= h($key) ?>">
            <div class="form-group">
                <label>Section Title</label>
                <input type="text" name="title" value="<?= h($c['title']) ?>" placeholder="Section heading">
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="5" placeholder="Section text..."><?= h($c['content']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
        </form>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
