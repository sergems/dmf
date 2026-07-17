<?php
require_once __DIR__ . '/includes/auth.php';
require_login();

$admin_title = 'Settings';
$pdo = get_db();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $errors[] = 'Invalid request.';
    } else {
        $fields = [
            'site_name','site_tagline','site_email','site_phone','site_address',
            'donate_url','facebook_url','instagram_url','twitter_url','youtube_url',
            'children_helped','countries_active','years_serving','donors',
            'hero_title','hero_subtitle','mission_text',
        ];
        foreach ($fields as $field) {
            $val = trim($_POST[$field] ?? '');
            $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?,?)
                ON DUPLICATE KEY UPDATE setting_value=VALUES(setting_value)");
            $stmt->execute([$field, $val]);
        }

        // Password change
        if (!empty($_POST['new_password'])) {
            $old = $_POST['current_password'] ?? '';
            $new = $_POST['new_password'] ?? '';
            $uid = (int)$_SESSION['admin_id'];
            $usr = $pdo->prepare("SELECT password_hash FROM admin_users WHERE id=?");
            $usr->execute([$uid]);
            $hash = $usr->fetchColumn();
            if (!password_verify($old, $hash)) {
                $errors[] = 'Current password is incorrect.';
            } elseif (strlen($new) < 8) {
                $errors[] = 'New password must be at least 8 characters.';
            } else {
                $pdo->prepare("UPDATE admin_users SET password_hash=? WHERE id=?")->execute([password_hash($new, PASSWORD_BCRYPT), $uid]);
            }
        }

        if (!$errors) {
            set_flash('success','Settings saved successfully.');
            redirect('/admin/settings.php');
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<?= render_flash() ?>
<?php if ($errors): ?><div class="alert alert-error"><?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?></div><?php endif; ?>

<form method="post" action="/admin/settings.php">
    <?= csrf_field() ?>
    <div class="settings-grid">

        <!-- General -->
        <div class="admin-card">
            <h3 class="settings-section-title">General</h3>
            <?php foreach (['site_name'=>'Site Name','site_tagline'=>'Tagline','site_email'=>'Contact Email','site_phone'=>'Phone','site_address'=>'Address','donate_url'=>'Donate Button URL'] as $k=>$label): ?>
            <div class="form-group">
                <label><?= h($label) ?></label>
                <input type="<?= $k==='site_email'?'email':'text' ?>" name="<?= h($k) ?>" value="<?= h(get_setting($k)) ?>">
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Stats -->
        <div class="admin-card">
            <h3 class="settings-section-title">Homepage Stats</h3>
            <?php foreach (['children_helped'=>'Children Helped','countries_active'=>'Countries Active','years_serving'=>'Years Serving','donors'=>'Donors'] as $k=>$label): ?>
            <div class="form-group">
                <label><?= h($label) ?></label>
                <input type="text" name="<?= h($k) ?>" value="<?= h(get_setting($k)) ?>" placeholder="e.g. 700+">
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Social -->
        <div class="admin-card">
            <h3 class="settings-section-title">Social Media Links</h3>
            <?php foreach (['facebook_url'=>'Facebook URL','instagram_url'=>'Instagram URL','twitter_url'=>'Twitter / X URL','youtube_url'=>'YouTube URL'] as $k=>$label): ?>
            <div class="form-group">
                <label><?= h($label) ?></label>
                <input type="url" name="<?= h($k) ?>" value="<?= h(get_setting($k)) ?>" placeholder="https://...">
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Hero -->
        <div class="admin-card">
            <h3 class="settings-section-title">Homepage Text</h3>
            <div class="form-group">
                <label>Hero Title</label>
                <input type="text" name="hero_title" value="<?= h(get_setting('hero_title')) ?>">
            </div>
            <div class="form-group">
                <label>Hero Subtitle</label>
                <textarea name="hero_subtitle" rows="3"><?= h(get_setting('hero_subtitle')) ?></textarea>
            </div>
            <div class="form-group">
                <label>Mission Text (Homepage)</label>
                <textarea name="mission_text" rows="4"><?= h(get_setting('mission_text')) ?></textarea>
            </div>
        </div>

        <!-- Password -->
        <div class="admin-card">
            <h3 class="settings-section-title">Change Password</h3>
            <div class="form-group">
                <label>Current Password</label>
                <input type="password" name="current_password" autocomplete="current-password">
            </div>
            <div class="form-group">
                <label>New Password <small>(min 8 chars — leave blank to keep current)</small></label>
                <input type="password" name="new_password" autocomplete="new-password">
            </div>
        </div>

    </div>
    <div style="margin-top:1.5rem;">
        <button type="submit" class="btn btn-primary btn-lg">Save All Settings</button>
    </div>
</form>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
