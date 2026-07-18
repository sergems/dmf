<?php
$page_title = 'Reports';
$meta_desc  = 'Annual reports of Divine Mercy Foundation — financial and programme reports from 2021 to 2025.';
require_once 'includes/header.php';
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
            <p>Each year Divine Mercy Foundation publishes a report covering our programmes, expenditure and impact across Cameroon, South Africa, Kenya and Tanzania. Download the report for each year below.</p>
        </div>
        <div class="reports-grid">

            <div class="report-card">
                <div class="report-year">2025</div>
                <div class="report-info">
                    <h3>Annual Report 2025</h3>
                    <p>Programme outcomes, financial summary and community impact for the 2025 fiscal year.</p>
                </div>
                <div class="report-actions">
                    <a href="/assets/documents/report-2025.pdf" target="_blank" class="btn btn-primary report-dl-btn">⬇ Download</a>
                </div>
            </div>

            <div class="report-card">
                <div class="report-year">2024</div>
                <div class="report-info">
                    <h3>Annual Report 2024</h3>
                    <p>Programme outcomes, financial summary and community impact for the 2024 fiscal year.</p>
                </div>
                <div class="report-actions">
                    <a href="/assets/documents/report-2024.pdf" target="_blank" class="btn btn-primary report-dl-btn">⬇ Download</a>
                </div>
            </div>

            <div class="report-card">
                <div class="report-year">2023</div>
                <div class="report-info">
                    <h3>Annual Report 2023</h3>
                    <p>Programme outcomes, financial summary and community impact for the 2023 fiscal year.</p>
                </div>
                <div class="report-actions">
                    <span class="report-badge upcoming">Coming Soon</span>
                </div>
            </div>

            <div class="report-card">
                <div class="report-year">2022</div>
                <div class="report-info">
                    <h3>Annual Report 2022</h3>
                    <p>Programme outcomes, financial summary and community impact for the 2022 fiscal year.</p>
                </div>
                <div class="report-actions">
                    <span class="report-badge upcoming">Coming Soon</span>
                </div>
            </div>

            <div class="report-card">
                <div class="report-year">2021</div>
                <div class="report-info">
                    <h3>Annual Report 2021</h3>
                    <p>Programme outcomes, financial summary and community impact for the 2021 fiscal year.</p>
                </div>
                <div class="report-actions">
                    <span class="report-badge upcoming">Coming Soon</span>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container" style="max-width:700px;text-align:center;">
        <span class="section-eyebrow">Transparency</span>
        <h2>Our Commitment to Accountability</h2>
        <p>Divine Mercy Foundation is a 501(c)(3) tax-exempt organisation. We file annual Form 990 returns with the IRS and maintain full financial records open to review. If you have questions about our finances or programmes, please contact us directly.</p>
        <div style="margin-top:2rem;">
            <a href="/contact.php" class="btn btn-primary">Contact Us</a>
            <a href="/about-irs.php" class="btn btn-outline" style="margin-left:1rem;">IRS Tax Exempt Status</a>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Your Generosity at Work</h2>
            <p>Every dollar donated goes directly to our programmes. See our reports for a full account of how your gifts are used.</p>
        </div>
        <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-white">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
