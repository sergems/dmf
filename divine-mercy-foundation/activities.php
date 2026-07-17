<?php
$page_title = 'Activities & News';
$meta_desc  = 'See the latest news and activities from Divine Mercy Foundation — school sponsorships, outreach, and more.';
require_once 'includes/header.php';

$per_page    = 9;
$current_pg  = max(1, (int)($_GET['page'] ?? 1));
$category    = in_array($_GET['cat'] ?? '', ['news','activity','announcement']) ? $_GET['cat'] : '';
$offset      = ($current_pg - 1) * $per_page;
$posts       = get_news_list($per_page, $offset, $category);
$total       = count_news($category);
$total_pages = (int)ceil($total / $per_page);
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Activities &amp; News</div>
        <h1>Activities &amp; News</h1>
        <p>Updates from the ground — school sponsorships, outreach programs, and stories of transformation.</p>
    </div>
</section>

<section class="section section-light">
    <div class="container">

        <!-- Filter tabs -->
        <div class="filter-tabs">
            <a href="/activities.php" class="filter-tab <?= $category === '' ? 'active' : '' ?>">All</a>
            <a href="/activities.php?cat=activity" class="filter-tab <?= $category === 'activity' ? 'active' : '' ?>">Activities</a>
            <a href="/activities.php?cat=news" class="filter-tab <?= $category === 'news' ? 'active' : '' ?>">News</a>
            <a href="/activities.php?cat=announcement" class="filter-tab <?= $category === 'announcement' ? 'active' : '' ?>">Announcements</a>
        </div>

        <?php if ($posts): ?>
        <div class="news-grid news-grid--large">
            <?php foreach ($posts as $post): ?>
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
                    <p><?= h(excerpt($post['excerpt'] ?: $post['content'], 130)) ?></p>
                    <div class="news-card-footer">
                        <time datetime="<?= h($post['published_at']) ?>"><?= format_date($post['published_at']) ?></time>
                        <a href="/activity.php?slug=<?= h($post['slug']) ?>" class="read-more">Read more →</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php if ($current_pg > 1): ?>
                <a href="?page=<?= $current_pg - 1 ?><?= $category ? '&cat=' . h($category) : '' ?>" class="page-btn">← Prev</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?><?= $category ? '&cat=' . h($category) : '' ?>"
                   class="page-btn <?= $i === $current_pg ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($current_pg < $total_pages): ?>
                <a href="?page=<?= $current_pg + 1 ?><?= $category ? '&cat=' . h($category) : '' ?>" class="page-btn">Next →</a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php else: ?>
        <div class="empty-state">
            <p>No posts found. Check back soon for updates!</p>
        </div>
        <?php endif; ?>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
