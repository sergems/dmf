<?php
$page_title = '';
$meta_desc  = 'Divine Mercy Foundation — Bringing Hope. Sharing Love. Changing Lives. Supporting vulnerable children in Cameroon, South Africa, Kenya and Tanzania.';
require_once 'includes/header.php';

$hero_title   = get_setting('hero_title', 'Bringing Hope. Sharing Love. Changing Lives.');
$hero_sub     = get_setting('hero_subtitle', 'Divine Mercy Foundation spreads joy, care, and opportunity to children and families across Cameroon, South Africa, Kenya, and Tanzania.');
$donate_url   = get_setting('donate_url', '#');
$latest_news  = get_news_list(3);

$stats = [
    ['value' => get_setting('children_helped','700+'), 'label' => 'Children Helped'],
    ['value' => get_setting('countries_active','4'),   'label' => 'Countries'],
    ['value' => get_setting('years_serving','9+'),     'label' => 'Years Serving'],
    ['value' => get_setting('donors','500+'),          'label' => 'Donors Worldwide'],
];
?>

<!-- HERO -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-bg-pattern"></div>
    <div class="container hero-content">
        <div class="hero-badge">Faith · Hope · Mercy</div>
        <h1 class="hero-title"><?= h($hero_title) ?></h1>
        <p class="hero-subtitle"><?= h($hero_sub) ?></p>
        <div class="hero-actions">
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
                Donate Now
            </a>
            <a href="/about.php" class="btn btn-outline btn-lg">Learn More</a>
        </div>
    </div>
    <div class="hero-scroll-indicator">
        <span></span>
    </div>
</section>

<!-- STATS STRIP -->
<section class="stats-strip">
    <div class="container stats-grid">
        <?php foreach ($stats as $stat): ?>
        <div class="stat-item">
            <span class="stat-value"><?= h($stat['value']) ?></span>
            <span class="stat-label"><?= h($stat['label']) ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- MISSION INTRO -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-visual">
            <div class="mission-card">
                <div class="mission-card-icon">
                    <img src="/assets/images/logo.png" alt="Divine Mercy Foundation">
                </div>
                <blockquote>
                    "Give hope. Change a life. Every child deserves a chance."
                </blockquote>
            </div>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Who We Are</span>
            <h2>A Faith-Based Ministry Serving Those Most in Need</h2>
            <p><?= h(get_setting('mission_text', '')) ?></p>
            <p>We are registered as a 501(c)(3) nonprofit in the United States. All gifts and contributions are tax deductible to the extent allowed by law.</p>
            <a href="/about.php" class="btn btn-primary">Our Story</a>
        </div>
    </div>
</section>

<!-- PROGRAMS -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">What We Do</span>
            <h2>Our Programs</h2>
            <p>Three pillars of care guiding every child toward a brighter future.</p>
        </div>
        <div class="programs-grid">
            <a href="/programs.php#education" class="program-card">
                <div class="program-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                </div>
                <h3>Child Education</h3>
                <p>We sponsor school fees, books, uniforms, and supplies for orphans and disadvantaged children at every level of education — from day care to university.</p>
                <span class="program-link">Learn more →</span>
            </a>
            <a href="/programs.php#protection" class="program-card">
                <div class="program-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <h3>Child Protection</h3>
                <p>We safeguard vulnerable children from abuse, neglect, and exploitation, providing safe environments and emotional support to those who need it most.</p>
                <span class="program-link">Learn more →</span>
            </a>
            <a href="/programs.php#health" class="program-card">
                <div class="program-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <h3>Health &amp; Nutrition</h3>
                <p>We provide balanced daily meals for orphaned children and work toward drilling clean water wells in rural communities across Cameroon.</p>
                <span class="program-link">Learn more →</span>
            </a>
        </div>
        <div class="section-cta">
            <a href="/programs.php" class="btn btn-secondary">View All Programs</a>
        </div>
    </div>
</section>

<!-- IMPACT BANNER -->
<section class="impact-banner">
    <div class="container impact-banner-inner">
        <div class="impact-text">
            <h2>Since 2016, we have helped <em>700+ children</em> attend school across Cameroon, South Africa, Kenya &amp; Tanzania.</h2>
            <p>And we are just getting started. With your support, we can reach thousands more.</p>
        </div>
        <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-white btn-lg">Make a Difference</a>
    </div>
</section>

<!-- LATEST NEWS -->
<?php if ($latest_news): ?>
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Latest Updates</span>
            <h2>Activities &amp; News</h2>
            <p>See the difference your support is making on the ground.</p>
        </div>
        <div class="news-grid">
            <?php foreach ($latest_news as $post): ?>
            <article class="news-card">
                <?php if ($post['featured_image']): ?>
                <div class="news-card-img">
                    <img src="/uploads/<?= h($post['featured_image']) ?>" alt="<?= h($post['title']) ?>">
                </div>
                <?php else: ?>
                <div class="news-card-img news-card-img-placeholder">
                    <img src="/assets/images/logo.png" alt="Divine Mercy Foundation">
                </div>
                <?php endif; ?>
                <div class="news-card-body">
                    <span class="news-tag"><?= ucfirst(h($post['category'])) ?></span>
                    <h3><a href="/activity.php?slug=<?= h($post['slug']) ?>"><?= h($post['title']) ?></a></h3>
                    <p><?= h(excerpt($post['excerpt'] ?: $post['content'], 120)) ?></p>
                    <div class="news-card-footer">
                        <time datetime="<?= h($post['published_at']) ?>"><?= format_date($post['published_at']) ?></time>
                        <a href="/activity.php?slug=<?= h($post['slug']) ?>" class="read-more">Read more →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <div class="section-cta">
            <a href="/activities.php" class="btn btn-secondary">View All Activities</a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- QUOTE / FAITH SECTION -->
<section class="faith-section">
    <div class="container">
        <blockquote class="faith-quote">
            <p>"For I was hungry and you gave me food, I was thirsty and you gave me drink, I was a stranger and you welcomed me."</p>
            <cite>Matthew 25:35</cite>
        </blockquote>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
