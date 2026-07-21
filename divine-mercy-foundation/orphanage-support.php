<?php
$page_title = 'Support the Orphanage';
$meta_desc  = 'Support the Divine Mercy Foundation Orphanage — donate, sponsor a child, or volunteer to help vulnerable children in Cameroon.';
require_once 'includes/header.php';
require_once 'includes/db.php';
$donate_url = get_setting('donate_url', 'https://buy.stripe.com/9AQ00121AeUD9os288');
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Support</div>
        <h1>Support the Orphanage</h1>
        <p>Your generosity builds walls, fills plates, and transforms futures. Every contribution counts.</p>
    </div>
</section>

<!-- How to help -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Ways to Help</span>
            <h2>How You Can Make a Difference</h2>
            <p>There are several meaningful ways to support the children at our orphanage in Cameroon.</p>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <h3>One-Time Donation</h3>
                <p>Any amount helps. A one-time gift goes directly toward food, clothing, building materials, school supplies, and day-to-day care for the children.</p>
                <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="margin-top:1rem;">Donate Now</a>
            </div>
            <div class="program-card">
                <h3>Monthly Giving</h3>
                <p>A monthly gift — even $10 or $25 — provides consistent support that we can plan around. Recurring donors are the backbone of our orphanage operations.</p>
                <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="margin-top:1rem;">Give Monthly</a>
            </div>
            <div class="program-card">
                <h3>Sponsor a Child</h3>
                <p>Sponsor a specific child's education, meals, and care. You'll know exactly who you're helping and receive updates on their progress and well-being.</p>
                <a href="/contact.php" class="btn btn-outline" style="margin-top:1rem;">Contact Us</a>
            </div>
            <div class="program-card">
                <h3>Building Fund</h3>
                <p>Donate specifically to complete the orphanage building — additional rooms, roofing, windows, and facilities are still needed to house more children.</p>
                <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="margin-top:1rem;">Fund the Build</a>
            </div>
        </div>
    </div>
</section>

<!-- Impact amounts -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Your Impact</span>
            <h2>See What Your Gift Does</h2>
        </div>
        <div class="impact-amounts">
            <div class="impact-amount-card">
                <div class="impact-amount">$10</div>
                <div class="impact-desc">Provides a week of nutritious meals for one child</div>
            </div>
            <div class="impact-amount-card">
                <div class="impact-amount">$25</div>
                <div class="impact-desc">Supplies school books and stationery for one child for a term</div>
            </div>
            <div class="impact-amount-card">
                <div class="impact-amount">$50</div>
                <div class="impact-desc">Covers a school uniform and shoes for one child</div>
            </div>
            <div class="impact-amount-card">
                <div class="impact-amount">$100</div>
                <div class="impact-desc">Pays one child's full school fees for a term</div>
            </div>
            <div class="impact-amount-card">
                <div class="impact-amount">$250</div>
                <div class="impact-desc">Funds one month of full care for a child — food, shelter, schooling</div>
            </div>
            <div class="impact-amount-card">
                <div class="impact-amount">$500+</div>
                <div class="impact-desc">Contributes to building materials, roofing, or facility completion</div>
            </div>
        </div>
        <div style="text-align:center;margin-top:2.5rem;">
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Donate Now</a>
        </div>
    </div>
</section>

<!-- Volunteer / partner -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Get Involved</span>
            <h2>More Than Money — Your Time Matters Too</h2>
            <p>We welcome volunteers, professionals, and organisations who want to contribute their time and skills. Whether you're a teacher, doctor, builder, fundraiser, or simply someone with a heart to serve — there is a place for you.</p>
            <p>We also partner with churches, schools, community groups, and businesses who want to make a collective impact. Get in touch and let's talk about how we can work together.</p>
            <div style="margin-top:2rem;">
                <a href="/contact.php" class="btn btn-primary">Contact Us to Volunteer</a>
            </div>
        </div>
        <div class="section-split-visual">
            <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-3-1024x576.jpeg" alt="Volunteers at the orphanage" style="width:100%;border-radius:12px;object-fit:cover;max-height:380px;">
        </div>
    </div>
</section>

<!-- CTA banner -->
<?php require_once 'includes/footer.php'; ?>
