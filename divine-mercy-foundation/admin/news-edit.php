<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$pdo = get_db();
$id  = (int)($_GET['id'] ?? 0);
$post = null;

if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id=?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
    if (!$post) { set_flash('error','Post not found.'); redirect('/admin/news.php'); }
}

$admin_title = $id ? 'Edit Post' : 'New Post';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) { $errors[] = 'Invalid request.'; }
    else {
        $title    = trim($_POST['title'] ?? '');
        $excerpt  = trim($_POST['excerpt'] ?? '');
        $content  = $_POST['content'] ?? '';  // Allow HTML
        $category = in_array($_POST['category'] ?? '', ['news','activity','announcement']) ? $_POST['category'] : 'news';
        $status   = in_array($_POST['status'] ?? '', ['published','draft']) ? $_POST['status'] : 'published';
        $pub_date = $_POST['published_at'] ?? date('Y-m-d H:i:s');

        if (!$title)   $errors[] = 'Title is required.';
        if (!$content) $errors[] = 'Content is required.';

        // Generate slug
        $slug = slugify($title);

        // Check slug uniqueness
        if (!$errors) {
            $chk = $pdo->prepare("SELECT id FROM news WHERE slug=? AND id != ?");
            $chk->execute([$slug, $id]);
            if ($chk->fetch()) {
                $slug = $slug . '-' . time();
            }
        }

        // Handle image upload
        $new_image = null;
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === UPLOAD_ERR_OK) {
            $new_image = handle_image_upload('featured_image');
            if (!$new_image) $errors[] = 'Image upload failed. Allowed types: jpg, jpeg, png, gif, webp. Max 5MB.';
        }

        if (!$errors) {
            if ($id) {
                // Remove old image if replacing
                if ($new_image && $post['featured_image'] && file_exists(UPLOADS_DIR . $post['featured_image'])) {
                    unlink(UPLOADS_DIR . $post['featured_image']);
                }
                $img = $new_image ?? $post['featured_image'];
                $stmt = $pdo->prepare("UPDATE news SET title=?,slug=?,excerpt=?,content=?,category=?,status=?,featured_image=?,published_at=? WHERE id=?");
                $stmt->execute([$title,$slug,$excerpt,$content,$category,$status,$img,$pub_date,$id]);
                set_flash('success','Post updated successfully.');
            } else {
                $img = $new_image;
                $stmt = $pdo->prepare("INSERT INTO news (title,slug,excerpt,content,category,status,featured_image,published_at) VALUES (?,?,?,?,?,?,?,?)");
                $stmt->execute([$title,$slug,$excerpt,$content,$category,$status,$img,$pub_date]);
                set_flash('success','Post created successfully.');
            }
            redirect('/admin/news.php');
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>

<?php if ($errors): ?>
<div class="alert alert-error">
    <?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?>
</div>
<?php endif; ?>

<div class="admin-card">
<form method="post" enctype="multipart/form-data" action="/admin/news-edit.php<?= $id ? '?id='.$id : '' ?>">
    <?= csrf_field() ?>

    <div class="edit-layout">
        <!-- Main content area -->
        <div class="edit-main">
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" id="title" name="title"
                       value="<?= h($post['title'] ?? $_POST['title'] ?? '') ?>"
                       required placeholder="Post title" class="input-large">
            </div>

            <div class="form-group">
                <label for="excerpt">Excerpt <small>(Short summary shown on listings)</small></label>
                <textarea id="excerpt" name="excerpt" rows="2"
                          placeholder="Brief description..."><?= h($post['excerpt'] ?? $_POST['excerpt'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content <span class="required">*</span></label>
                <div class="editor-toolbar">
                    <button type="button" data-cmd="bold" title="Bold"><strong>B</strong></button>
                    <button type="button" data-cmd="italic" title="Italic"><em>I</em></button>
                    <button type="button" data-cmd="insertUnorderedList" title="Bullet list">• List</button>
                    <button type="button" data-cmd="insertOrderedList" title="Numbered list">1. List</button>
                    <button type="button" data-cmd="createLink" title="Insert link">Link</button>
                    <button type="button" data-cmd="h2" title="Heading">H2</button>
                    <button type="button" data-cmd="h3" title="Subheading">H3</button>
                </div>
                <div id="editor" class="rich-editor" contenteditable="true"><?= $post['content'] ?? '' ?></div>
                <textarea id="content" name="content" class="hidden-textarea"><?= h($post['content'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Sidebar settings -->
        <div class="edit-sidebar">
            <div class="edit-sidebar-box">
                <h3>Publish</h3>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status">
                        <option value="published" <?= (($post['status'] ?? 'published') === 'published') ? 'selected' : '' ?>>Published</option>
                        <option value="draft" <?= (($post['status'] ?? '') === 'draft') ? 'selected' : '' ?>>Draft</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="published_at">Publish Date</label>
                    <input type="datetime-local" id="published_at" name="published_at"
                           value="<?= h(date('Y-m-d\TH:i', strtotime($post['published_at'] ?? 'now'))) ?>">
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary btn-full">
                        <?= $id ? 'Update Post' : 'Publish Post' ?>
                    </button>
                    <a href="/admin/news.php" class="btn btn-secondary btn-full" style="margin-top:.5rem">Cancel</a>
                </div>
            </div>

            <div class="edit-sidebar-box">
                <h3>Category</h3>
                <div class="form-group">
                    <select id="category" name="category">
                        <option value="news" <?= (($post['category'] ?? 'news') === 'news') ? 'selected' : '' ?>>News</option>
                        <option value="activity" <?= (($post['category'] ?? '') === 'activity') ? 'selected' : '' ?>>Activity</option>
                        <option value="announcement" <?= (($post['category'] ?? '') === 'announcement') ? 'selected' : '' ?>>Announcement</option>
                    </select>
                </div>
            </div>

            <div class="edit-sidebar-box">
                <h3>Featured Image</h3>
                <?php if (!empty($post['featured_image'])): ?>
                <div class="current-image">
                    <img src="/uploads/<?= h($post['featured_image']) ?>" alt="Current image">
                    <p class="img-note">Upload a new image to replace it.</p>
                </div>
                <?php endif; ?>
                <div class="form-group">
                    <input type="file" id="featured_image" name="featured_image"
                           accept="image/jpeg,image/png,image/gif,image/webp">
                    <small>Max 5MB. JPG, PNG, GIF, WEBP.</small>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
