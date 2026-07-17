<?php
require_once __DIR__ . '/includes/auth.php';

if (is_logged_in()) {
    redirect('/admin/index.php');
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $error = 'Invalid request. Please try again.';
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        if (login_user($username, $password)) {
            $dest = $_SESSION['redirect_after_login'] ?? '/admin/index.php';
            unset($_SESSION['redirect_after_login']);
            redirect($dest);
        } else {
            $error = 'Invalid username or password. Please try again.';
            // Simple rate limiting: sleep to discourage brute force
            sleep(1);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Divine Mercy Foundation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/admin/assets/admin.css">
    <link rel="icon" type="image/png" href="/assets/images/logo.png">
</head>
<body class="admin-login-page">

<div class="login-wrap">
    <div class="login-brand">
        <img src="/assets/images/logo.png" alt="Divine Mercy Foundation Logo">
        <div>
            <strong>Divine Mercy Foundation</strong>
            <span>Admin Panel</span>
        </div>
    </div>

    <h1 class="login-title">Sign In</h1>
    <p class="login-subtitle">Enter your credentials to access the admin panel.</p>

    <?php if ($error): ?>
    <div class="alert alert-error"><?= h($error) ?></div>
    <?php endif; ?>

    <form method="post" action="/admin/login.php" class="login-form">
        <?= csrf_field() ?>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username"
                   value="<?= h($_POST['username'] ?? '') ?>"
                   required autocomplete="username" autofocus
                   placeholder="Enter username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password"
                   required autocomplete="current-password"
                   placeholder="Enter password">
        </div>
        <button type="submit" class="btn btn-primary btn-full">Sign In</button>
    </form>

    <p class="login-back"><a href="/index.php">← Back to Website</a></p>
</div>

<script src="/admin/assets/admin.js"></script>
</body>
</html>
