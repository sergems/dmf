<?php
$page_title = 'Our Mission';
$meta_desc  = 'The mission of Divine Mercy Foundation — a 501(c)(3) faith-based nonprofit serving the poor, orphans, and vulnerable in Cameroon and beyond.';
require_once 'includes/header.php';
$mission_text = get_page_content('mission_main_text');
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/about.php">About Us</a> <span>/</span> Our Mission</div>
        <h1>Our Mission</h1>
        <p>Rooted in faith, driven by mercy — bringing hope and dignity to the most vulnerable.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:820px;">

        <p><?= nl2br(h($mission_text['content'])) ?></p>

    </div>
</section>
<?php require_once 'includes/footer.php'; ?>
