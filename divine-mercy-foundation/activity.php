<?php
require_once 'includes/db.php';
$slug = trim($_GET['slug'] ?? '');
if (!$slug) { header('Location: /activities.php'); exit; }

$post = get_news_by_slug($slug);
if (!$post) { header('HTTP/1.0 404 Not Found'); include '404.php'; exit; }

$page_title = $post['title'];
$meta_desc  = excerpt($post['excerpt'] ?: $post['content'], 160);

require_once 'includes/header.php';

$recent = get_news_list(3);
$donate_url = get_setting('donate_url', '#');
?>

<section class="page-hero page-hero--sm">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/activities.php">Activities</a> <span>/</span> <?= h($post['title']) ?></div>
    </div>
</section>

<section class="section section-white">
    <div class="container article-layout">

        <!-- Main content -->
        <article class="article-body">
            <?php if ($post['featured_image']): ?>
            <div class="article-featured-img">
                <img src="/uploads/<?= h($post['featured_image']) ?>" alt="<?= h($post['title']) ?>">
            </div>
            <?php endif; ?>

            <div class="article-meta">
                <span class="news-tag"><?= ucfirst(h($post['category'])) ?></span>
                <time datetime="<?= h($post['published_at']) ?>"><?= format_date($post['published_at']) ?></time>
            </div>

            <h1 class="article-title"><?= h($post['title']) ?></h1>

            <div class="article-content">
                <?= $post['content'] /* Content stored as HTML */ ?>
            </div>

            <div class="article-share">
                <span>Share:</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(SITE_URL . '/activity.php?slug=' . $slug) ?>" target="_blank" rel="noopener" class="share-btn share-btn--fb">Facebook</a>
                <a href="https://twitter.com/intent/tweet?url=<?= urlencode(SITE_URL . '/activity.php?slug=' . $slug) ?>&text=<?= urlencode($post['title']) ?>" target="_blank" rel="noopener" class="share-btn share-btn--tw">Twitter / X</a>
            </div>

            <div class="article-cta">
                <h3>Help us continue this work</h3>
                <p>Your donation supports education, protection, and hope for vulnerable children across Africa.</p>
                <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary">Donate Now</a>
            </div>

            <a href="/activities.php" class="back-link">← Back to All Activities</a>
        </article>

        <!-- Sidebar -->
        <aside class="article-sidebar">
            <div class="sidebar-widget">
                <h3>Recent Updates</h3>
                <ul class="sidebar-posts">
                    <?php foreach ($recent as $r): ?>
                    <?php if ($r['slug'] === $slug) continue; ?>
                    <li>
                        <a href="/activity.php?slug=<?= h($r['slug']) ?>"><?= h($r['title']) ?></a>
                        <time><?= format_date($r['published_at']) ?></time>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="sidebar-widget sidebar-donate">
                <img src="/assets/images/logo.png" alt="Divine Mercy Foundation">
                <h3>Give Hope Today</h3>
                <p>Every donation — big or small — changes a child's life forever.</p>
                <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="width:100%;text-align:center;">Donate Now</a>
            </div>
        </aside>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
