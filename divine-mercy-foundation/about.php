<?php
$page_title = 'About Us';
$meta_desc  = 'Learn about Divine Mercy Foundation — our mission, vision, and the story of how we serve vulnerable children across Africa.';
require_once 'includes/header.php';

$mission   = get_page_content('about_mission');
$story     = get_page_content('about_story');
$vision    = get_page_content('about_vision');
$donate_url = get_setting('donate_url', '#');
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> About Us</div>
        <h1>About Divine Mercy Foundation</h1>
        <p>A faith-based nonprofit dedicated to transforming lives through education, protection, and mercy.</p>
    </div>
</section>

<!-- MISSION -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Our Mission</span>
            <h2><?= h($mission['title']) ?></h2>
            <p><?= h($mission['content']) ?></p>
        </div>
        <div class="section-split-visual">
            <div class="about-visual-card about-visual-card--red">
                <div class="about-stat-big">700+</div>
                <div class="about-stat-label">Children reached since 2016</div>
            </div>
        </div>
    </div>
</section>

<!-- VISION -->
<section class="section section-light">
    <div class="container section-center">
        <span class="section-eyebrow">Our Vision</span>
        <h2><?= h($vision['title']) ?></h2>
        <p class="lead"><?= h($vision['content']) ?></p>
    </div>
</section>

<!-- STORY -->
<section class="section section-white">
    <div class="container section-split reverse">
        <div class="section-split-visual">
            <div class="story-visual">
                <img src="/assets/images/logo.png" alt="Divine Mercy Foundation" class="story-logo">
                <div class="story-countries">
                    <span>🇨🇲 Cameroon</span>
                    <span>🇿🇦 South Africa</span>
                    <span>🇰🇪 Kenya</span>
                    <span>🇹🇿 Tanzania</span>
                </div>
            </div>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Our Story</span>
            <h2><?= h($story['title']) ?></h2>
            <p><?= nl2br(h($story['content'])) ?></p>
            <a href="/programs.php" class="btn btn-primary">Our Programs</a>
        </div>
    </div>
</section>

<!-- VALUES -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header section-header--light">
            <span class="section-eyebrow section-eyebrow--light">Core Values</span>
            <h2>What Drives Us Every Day</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">✦</div>
                <h3>Faith</h3>
                <p>Rooted in faith, we believe every human life has inherent dignity and worth — especially the most vulnerable.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">✦</div>
                <h3>Compassion</h3>
                <p>We meet people where they are — without judgment — offering practical help and genuine care.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">✦</div>
                <h3>Education</h3>
                <p>We believe education is the most powerful investment we can make in a child's future and their community's prosperity.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">✦</div>
                <h3>Transparency</h3>
                <p>Every dollar donated is used responsibly. We are accountable to our donors and to the children we serve.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section-white section-center">
    <div class="container">
        <span class="section-eyebrow">Get Involved</span>
        <h2>Give Hope. Change a Life.</h2>
        <p class="lead">Every day, Divine Mercy Foundation provides love, care, education, and a brighter future for vulnerable children. But we can't do it alone — <strong>your kindness keeps their dreams alive.</strong></p>
        <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
