<?php
require_once dirname(__DIR__) . '/includes/db.php';

$site_name    = get_setting('site_name', 'Divine Mercy Foundation');
$donate_url   = get_setting('donate_url', '#');
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Determine active nav
function is_active(string $page): string {
    global $current_page;
    return $current_page === $page ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= h($page_title ?: $site_name) ?><?= $page_title ? ' — ' . h($site_name) : '' ?></title>
    <meta name="description" content="<?= h($meta_desc ?? 'Divine Mercy Foundation — Bringing Hope, Sharing Love, Changing Lives across Cameroon, South Africa, Kenya and Tanzania.') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="icon" type="image/png" href="/assets/images/logo.png">
</head>
<body>

<!-- Top bar -->
<div class="topbar">
    <div class="container topbar-inner">
        <div class="topbar-contact">
            <span>📧 <?= h(get_setting('site_email', 'divinemercyfoundation@gmail.com')) ?></span>
        </div>
        <div class="topbar-donate">
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="topbar-donate-link">❤ Donate Now</a>
        </div>
    </div>
</div>

<!-- Header / Nav -->
<header class="site-header" id="site-header">
    <div class="container header-inner">
        <a href="/index.php" class="site-logo">
            <img src="/assets/images/logo.png" alt="<?= h($site_name) ?> Logo" class="logo-img">
            <div class="logo-text">
                <span class="logo-name">Divine Mercy</span>
                <span class="logo-sub">Foundation</span>
            </div>
        </a>

        <button class="nav-toggle" id="nav-toggle" aria-label="Toggle navigation" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <nav class="site-nav" id="site-nav">
            <ul>
                <li><a href="/index.php" class="<?= is_active('index') ?>">Home</a></li>
                <li><a href="/about.php" class="<?= is_active('about') ?>">About Us</a></li>
                <li><a href="/programs.php" class="<?= is_active('programs') ?>">Programs</a></li>
                <?php
                $orphanage_pages = ['orphanage','orphanage-about','orphanage-children','orphanage-support','orphanage-gallery'];
                $orphanage_active = in_array($current_page, $orphanage_pages) ? 'active' : '';
                ?>
                <li class="has-dropdown <?= $orphanage_active ? 'active' : '' ?>">
                    <a href="/orphanage.php" class="<?= $orphanage_active ?>">Orphanage <span class="dropdown-arrow">▾</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/orphanage.php" class="<?= is_active('orphanage') ?>">Overview</a></li>
                        <li><a href="/orphanage-about.php" class="<?= is_active('orphanage-about') ?>">About the Orphanage</a></li>
                        <li><a href="/orphanage-children.php" class="<?= is_active('orphanage-children') ?>">Children at the Orphanage</a></li>
                        <li><a href="/orphanage-support.php" class="<?= is_active('orphanage-support') ?>">Support the Orphanage</a></li>
                        <li><a href="/orphanage-gallery.php" class="<?= is_active('orphanage-gallery') ?>">Gallery</a></li>
                    </ul>
                </li>
                <li><a href="/activities.php" class="<?= is_active('activities') ?>">Activities</a></li>
                <li><a href="/contact.php" class="<?= is_active('contact') ?>">Contact</a></li>
                <li><a href="<?= h($donate_url) ?>" class="nav-donate-btn" target="_blank" rel="noopener">Donate</a></li>
            </ul>
        </nav>
    </div>
</header>
