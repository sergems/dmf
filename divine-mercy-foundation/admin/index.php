<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Dashboard';

$pdo        = get_db();
$news_count = (int)$pdo->query("SELECT COUNT(*) FROM news WHERE status='published'")->fetchColumn();
$draft_count= (int)$pdo->query("SELECT COUNT(*) FROM news WHERE status='draft'")->fetchColumn();
$msg_count  = (int)$pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read=0")->fetchColumn();
$total_msg  = (int)$pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$recent_news= $pdo->query("SELECT id, title, category, status, published_at FROM news ORDER BY published_at DESC LIMIT 5")->fetchAll();
$recent_msgs= $pdo->query("SELECT id, name, email, subject, created_at, is_read FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<!-- Stats -->
<div class="dash-stats">
    <div class="dash-stat dash-stat--red">
        <div class="dash-stat-value"><?= $news_count ?></div>
        <div class="dash-stat-label">Published Posts</div>
        <a href="/admin/news.php" class="dash-stat-link">Manage →</a>
    </div>
    <div class="dash-stat">
        <div class="dash-stat-value"><?= $draft_count ?></div>
        <div class="dash-stat-label">Draft Posts</div>
        <a href="/admin/news.php?status=draft" class="dash-stat-link">View Drafts →</a>
    </div>
    <div class="dash-stat <?= $msg_count > 0 ? 'dash-stat--alert' : '' ?>">
        <div class="dash-stat-value"><?= $msg_count ?></div>
        <div class="dash-stat-label">Unread Messages</div>
        <a href="/admin/messages.php" class="dash-stat-link">View →</a>
    </div>
    <div class="dash-stat">
        <div class="dash-stat-value"><?= $total_msg ?></div>
        <div class="dash-stat-label">Total Messages</div>
        <a href="/admin/messages.php" class="dash-stat-link">View All →</a>
    </div>
</div>

<!-- Quick actions -->
<div class="dash-actions">
    <a href="/admin/news-edit.php" class="btn btn-primary">+ New Post</a>
    <a href="/admin/pages.php" class="btn btn-secondary">Edit Page Content</a>
    <a href="/admin/settings.php" class="btn btn-secondary">Settings</a>
</div>

<!-- Recent posts & messages -->
<div class="dash-grid">
    <div class="dash-card">
        <div class="dash-card-header">
            <h2>Recent Posts</h2>
            <a href="/admin/news.php">View all</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr><th>Title</th><th>Category</th><th>Status</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($recent_news as $post): ?>
                <tr>
                    <td><?= h($post['title']) ?></td>
                    <td><span class="badge badge-<?= h($post['category']) ?>"><?= ucfirst(h($post['category'])) ?></span></td>
                    <td><span class="badge badge-<?= h($post['status']) ?>"><?= ucfirst(h($post['status'])) ?></span></td>
                    <td><?= format_date($post['published_at']) ?></td>
                    <td><a href="/admin/news-edit.php?id=<?= $post['id'] ?>" class="table-action">Edit</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (!$recent_news): ?>
                <tr><td colspan="5" class="table-empty">No posts yet. <a href="/admin/news-edit.php">Create one.</a></td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="dash-card">
        <div class="dash-card-header">
            <h2>Recent Messages</h2>
            <a href="/admin/messages.php">View all</a>
        </div>
        <table class="admin-table">
            <thead>
                <tr><th>Name</th><th>Subject</th><th>Date</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($recent_msgs as $msg): ?>
                <tr class="<?= !$msg['is_read'] ? 'row-unread' : '' ?>">
                    <td><?= h($msg['name']) ?></td>
                    <td><?= h($msg['subject'] ?: '(no subject)') ?></td>
                    <td><?= format_date($msg['created_at']) ?></td>
                    <td><a href="/admin/messages.php?id=<?= $msg['id'] ?>" class="table-action">View</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if (!$recent_msgs): ?>
                <tr><td colspan="4" class="table-empty">No messages yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
