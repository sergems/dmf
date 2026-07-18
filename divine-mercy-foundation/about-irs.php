<?php
$page_title = 'IRS Tax Exempt';
$meta_desc  = 'Divine Mercy Foundation IRS 501(c)(3) tax-exempt status — your donations are tax-deductible under US federal law.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/about.php">About Us</a> <span>/</span> IRS Tax Exempt</div>
        <h1>IRS Tax Exempt</h1>
        <p>Divine Mercy Foundation is a federally recognised 501(c)(3) tax-exempt nonprofit — your donations are fully tax-deductible.</p>
    </div>
</section>

<!-- 501c3 status -->
<section class="section section-white">
    <div class="container">
        <div class="section-split">
            <div class="section-split-text">
                <span class="section-eyebrow">Official Status</span>
                <h2>Recognised Under Section 501(c)(3)</h2>
                <p>Divine Mercy Foundation has been recognised by the Internal Revenue Service (IRS) of the United States as a tax-exempt organisation under Section 501(c)(3) of the Internal Revenue Code.</p>
                <p>This means that all gifts and contributions made to Divine Mercy Foundation are <strong>tax-deductible to the extent allowed by law</strong>. Donors who itemise their deductions on their US federal income tax return may deduct the full value of their charitable gift.</p>
                <p>Making a charitable gift is an important and very personal decision. The satisfaction in giving to Divine Mercy Foundation comes in knowing that you are investing in the lives of economically disadvantaged children whose success in education would empower them to improve their quality of life in keeping with their human dignity.</p>
            </div>
            <div class="section-split-visual">
                <div class="irs-status-card">
                    <div class="irs-badge">501(c)(3)</div>
                    <h3>Tax-Exempt Status</h3>
                    <p>Recognised by the Internal Revenue Service of the United States of America</p>
                    <div class="irs-detail-row"><span>Organisation</span><strong>Divine Mercy Foundation</strong></div>
                    <div class="irs-detail-row"><span>Classification</span><strong>Public Charity</strong></div>
                    <div class="irs-detail-row"><span>Deductibility</span><strong>Contributions are deductible</strong></div>
                    <div class="irs-detail-row"><span>Status</span><strong>Active &amp; In Good Standing</strong></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Donor benefits -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">For Donors</span>
            <h2>What This Means for You</h2>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">💰</div>
                <h3>Tax Deductible Gifts</h3>
                <p>Donations made to Divine Mercy Foundation are deductible from your US federal taxable income if you itemise deductions. This effectively reduces the after-tax cost of your gift.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📄</div>
                <h3>Donation Receipts</h3>
                <p>Every donor receives an official written acknowledgment of their contribution. This receipt contains all the information required by the IRS for your tax records.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🏢</div>
                <h3>Corporate Matching</h3>
                <p>Many employers match their employees' charitable contributions. Because we hold 501(c)(3) status, your employer may match your gift to Divine Mercy Foundation — doubling your impact.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📦</div>
                <h3>Non-Cash Donations</h3>
                <p>Donations of goods, property, or securities may also be tax-deductible. Please contact us before making a non-cash gift so we can assist you in properly documenting it.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📅</div>
                <h3>Year-End Giving</h3>
                <p>Donations must be made by December 31st of the tax year to be deductible for that year. Plan your year-end giving with Divine Mercy Foundation and make a lasting impact.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📜</div>
                <h3>Estate &amp; Planned Giving</h3>
                <p>Consider including Divine Mercy Foundation in your will or estate plan. A planned gift leaves a lasting legacy of mercy for future generations. Contact us for more information.</p>
            </div>
        </div>
    </div>
</section>

<!-- Verification -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Verification</span>
            <h2>Verify Our Tax-Exempt Status</h2>
            <p>You can independently verify Divine Mercy Foundation's 501(c)(3) status using the IRS Tax Exempt Organisation Search tool at <a href="https://apps.irs.gov/app/eos/" target="_blank" rel="noopener" style="color:var(--red);">apps.irs.gov</a>. Search by our organisation name: <strong>Divine Mercy Foundation</strong>.</p>
        </div>
        <div style="text-align:center;margin-top:1rem;">
            <a href="https://apps.irs.gov/app/eos/" target="_blank" rel="noopener" class="btn btn-outline">Verify on IRS.gov ↗</a>
            <a href="/contact.php" class="btn btn-primary" style="margin-left:1rem;">Request Determination Letter</a>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Give Generously — and Benefit Too</h2>
            <p>Your tax-deductible gift to Divine Mercy Foundation changes lives and reduces your tax burden. It is truly a gift that gives twice.</p>
        </div>
        <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-white">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
