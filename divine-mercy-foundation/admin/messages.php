<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Contact Messages';
$pdo = get_db();

// View single message and mark as read
$view_id = (int)($_GET['id'] ?? 0);
$view_msg = null;
if ($view_id) {
    $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id=?");
    $stmt->execute([$view_id]);
    $view_msg = $stmt->fetch();
    if ($view_msg && !$view_msg['is_read']) {
        $pdo->prepare("UPDATE contact_messages SET is_read=1 WHERE id=?")->execute([$view_id]);
        $view_msg['is_read'] = 1;
    }
}

// Delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['action'] ?? '') === 'delete') {
    if (verify_csrf()) {
        $pdo->prepare("DELETE FROM contact_messages WHERE id=?")->execute([(int)$_POST['id']]);
        set_flash('success','Message deleted.');
    }
    redirect('/admin/messages.php');
}

$messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>

<?php if ($view_msg): ?>
<div class="admin-card message-view">
    <div class="message-view-header">
        <h2><?= h($view_msg['subject'] ?: '(No Subject)') ?></h2>
        <a href="/admin/messages.php" class="btn btn-secondary btn-sm">← Back to All</a>
    </div>
    <div class="message-meta">
        <span><strong>From:</strong> <?= h($view_msg['name']) ?></span>
        <span><strong>Email:</strong> <a href="mailto:<?= h($view_msg['email']) ?>"><?= h($view_msg['email']) ?></a></span>
        <span><strong>Date:</strong> <?= format_date($view_msg['created_at']) ?></span>
    </div>
    <div class="message-body">
        <p><?= nl2br(h($view_msg['message'])) ?></p>
    </div>
    <div class="message-actions">
        <a href="mailto:<?= h($view_msg['email']) ?>?subject=Re: <?= h($view_msg['subject']) ?>" class="btn btn-primary">Reply via Email</a>
        <form method="post" action="/admin/messages.php" class="inline-form"
              onsubmit="return confirm('Delete this message?');">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?= $view_msg['id'] ?>">
            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
        </form>
    </div>
</div>
<?php endif; ?>

<div class="admin-card">
    <table class="admin-table admin-table--full">
        <thead>
            <tr><th></th><th>Name</th><th>Email</th><th>Subject</th><th>Date</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php foreach ($messages as $msg): ?>
            <tr class="<?= !$msg['is_read'] ? 'row-unread' : '' ?>">
                <td><?= !$msg['is_read'] ? '<span class="unread-dot" title="Unread">●</span>' : '' ?></td>
                <td><?= h($msg['name']) ?></td>
                <td><a href="mailto:<?= h($msg['email']) ?>"><?= h($msg['email']) ?></a></td>
                <td><?= h($msg['subject'] ?: '(no subject)') ?></td>
                <td><?= format_date($msg['created_at']) ?></td>
                <td class="td-actions">
                    <a href="/admin/messages.php?id=<?= $msg['id'] ?>" class="table-action">View</a>
                    <form method="post" class="inline-form" onsubmit="return confirm('Delete?');">
                        <?= csrf_field() ?>
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $msg['id'] ?>">
                        <button type="submit" class="table-action table-action--danger">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php if (!$messages): ?>
            <tr><td colspan="6" class="table-empty">No messages yet.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
