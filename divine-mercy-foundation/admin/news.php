<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'News & Activities';
$pdo         = get_db();

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    if (!verify_csrf()) { set_flash('error','Invalid request.'); redirect('/admin/news.php'); }
    $id = (int)($_POST['id'] ?? 0);
    if ($id) {
        // Delete image file if exists
        $row = $pdo->prepare("SELECT featured_image FROM news WHERE id=?");
        $row->execute([$id]);
        $img = $row->fetchColumn();
        if ($img && file_exists(UPLOADS_DIR . $img)) unlink(UPLOADS_DIR . $img);
        $pdo->prepare("DELETE FROM news WHERE id=?")->execute([$id]);
        set_flash('success','Post deleted successfully.');
    }
    redirect('/admin/news.php');
}

$status_filter   = in_array($_GET['status'] ?? '', ['published','draft']) ? $_GET['status'] : '';
$category_filter = in_array($_GET['cat'] ?? '', ['news','activity','announcement']) ? $_GET['cat'] : '';

$where  = '1=1';
$params = [];
if ($status_filter)   { $where .= " AND status=?"; $params[] = $status_filter; }
if ($category_filter) { $where .= " AND category=?"; $params[] = $category_filter; }

$per_page   = 15;
$current_pg = max(1, (int)($_GET['page'] ?? 1));
$offset     = ($current_pg - 1) * $per_page;

$count_stmt = $pdo->prepare("SELECT COUNT(*) FROM news WHERE $where");
$count_stmt->execute($params);
$total      = (int)$count_stmt->fetchColumn();
$total_pages= (int)ceil($total / $per_page);

$params[] = $per_page;
$params[] = $offset;
$stmt = $pdo->prepare("SELECT * FROM news WHERE $where ORDER BY published_at DESC LIMIT ? OFFSET ?");
$stmt->execute($params);
$posts = $stmt->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>

<div class="admin-toolbar">
    <div class="admin-filter-tabs">
        <a href="/admin/news.php" class="<?= !$status_filter && !$category_filter ? 'active' : '' ?>">All (<?= $total ?>)</a>
        <a href="/admin/news.php?status=published" class="<?= $status_filter==='published' ? 'active' : '' ?>">Published</a>
        <a href="/admin/news.php?status=draft" class="<?= $status_filter==='draft' ? 'active' : '' ?>">Drafts</a>
        <a href="/admin/news.php?cat=activity" class="<?= $category_filter==='activity' ? 'active' : '' ?>">Activities</a>
        <a href="/admin/news.php?cat=news" class="<?= $category_filter==='news' ? 'active' : '' ?>">News</a>
        <a href="/admin/news.php?cat=announcement" class="<?= $category_filter==='announcement' ? 'active' : '' ?>">Announcements</a>
    </div>
    <a href="/admin/news-edit.php" class="btn btn-primary">+ New Post</a>
</div>

<div class="admin-card">
    <table class="admin-table admin-table--full">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
                <td class="td-title">
                    <a href="/admin/news-edit.php?id=<?= $post['id'] ?>" class="table-title-link"><?= h($post['title']) ?></a>
                    <?php if ($post['featured_image']): ?>
                    <span class="has-image">📷</span>
                    <?php endif; ?>
                </td>
                <td><span class="badge badge-<?= h($post['category']) ?>"><?= ucfirst(h($post['category'])) ?></span></td>
                <td><span class="badge badge-<?= h($post['status']) ?>"><?= ucfirst(h($post['status'])) ?></span></td>
                <td><?= format_date($post['published_at']) ?></td>
                <td class="td-actions">
                    <a href="/admin/news-edit.php?id=<?= $post['id'] ?>" class="table-action">Edit</a>
                    <?php if ($post['status'] === 'published'): ?>
                    <a href="/activity.php?slug=<?= h($post['slug']) ?>" target="_blank" class="table-action">View</a>
                    <?php endif; ?>
                    <form method="post" action="/admin/news.php" class="inline-form"
                          onsubmit="return confirm('Delete this post? This cannot be undone.');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $post['id'] ?>">
                        <button type="submit" class="table-action table-action--danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (!$posts): ?>
            <tr><td colspan="5" class="table-empty">No posts found. <a href="/admin/news-edit.php">Create your first post.</a></td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if ($total_pages > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <a href="?page=<?= $i ?><?= $status_filter ? '&status='.$status_filter : '' ?><?= $category_filter ? '&cat='.$category_filter : '' ?>"
           class="page-btn <?= $i === $current_pg ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
