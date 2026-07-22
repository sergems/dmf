<?php
$page_title = 'Reports';
$meta_desc  = 'Annual reports of Divine Mercy Foundation — financial and programme reports.';
require_once 'includes/header.php';
$reports_intro          = get_page_content('reports_intro');
$reports_accountability = get_page_content('reports_accountability');

$reports = get_db()->query("SELECT * FROM reports ORDER BY year DESC")->fetchAll();
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Reports</div>
        <h1>Annual Reports</h1>
        <p>Transparency and accountability to our donors, partners and the communities we serve.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Financial &amp; Programme Reports</span>
            <p><?= nl2br(h($reports_intro['content'])) ?></p>
        </div>

        <?php if (empty($reports)): ?>
        <p style="text-align:center;color:var(--text-muted);padding:2rem 0;">Reports will be published here once available.</p>
        <?php else: ?>
        <div class="reports-grid">
            <?php foreach ($reports as $r): ?>
            <div class="report-card">
                <div class="report-year"><?= h($r['year']) ?></div>
                <div class="report-info">
                    <h3><?= h($r['title']) ?></h3>
                    <?php if ($r['description']): ?>
                    <p><?= h($r['description']) ?></p>
                    <?php endif; ?>
                </div>
                <div class="report-actions">
                    <?php if ($r['filename']): ?>
                    <a href="/uploads/reports/<?= h($r['filename']) ?>" target="_blank"
                       class="btn btn-primary report-dl-btn">⬇ Download PDF</a>
                    <?php else: ?>
                    <span class="report-badge upcoming">Coming Soon</span>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<section class="section section-light">
    <div class="container" style="max-width:700px;text-align:center;">
        <span class="section-eyebrow">Transparency</span>
        <h2>Our Commitment to Accountability</h2>
        <p><?= nl2br(h($reports_accountability['content'])) ?></p>
        <div style="margin-top:2rem;">
            <a href="/contact.php" class="btn btn-primary">Contact Us</a>
            <a href="/about-irs.php" class="btn btn-outline" style="margin-left:1rem;">IRS Tax Exempt Status</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
