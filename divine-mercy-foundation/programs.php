<?php
$page_title = 'Our Programs';
$meta_desc  = 'Explore Divine Mercy Foundation\'s programs: Child Education, Child Protection, and Health & Nutrition for vulnerable children in Africa.';
require_once 'includes/header.php';

$edu    = get_page_content('education_intro');
$prot   = get_page_content('child_protection_text');
$health = get_page_content('health_nutrition_text');
$donate_url = get_setting('donate_url', '#');
?>

<!-- PAGE HERO -->
<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Programs</div>
        <h1>Our Programs</h1>
        <p>Three pillars of care — education, protection, and health — guiding every child toward dignity and a brighter future.</p>
    </div>
</section>

<!-- EDUCATION -->
<section class="section section-white" id="education">
    <div class="container section-split">
        <div class="section-split-visual">
            <div class="program-visual program-visual--red">
                <div class="program-visual-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2z"/><path d="M22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"/></svg>
                </div>
                <div class="program-visual-label">Child Education</div>
                <div class="program-visual-stat">700+ children helped</div>
            </div>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Program 01</span>
            <h2><?= h($edu['title']) ?></h2>
            <p><?= h($edu['content']) ?></p>
            <ul class="program-list">
                <li>School fees sponsorship for orphans and disadvantaged children</li>
                <li>Textbooks, uniforms, and school supplies</li>
                <li>Coverage from day care through university level</li>
                <li>One child per family to maximize reach across communities</li>
                <li>Active in Cameroon, South Africa (school fees), Kenya, and Tanzania</li>
                <li>Plans to build a school in Cameroon</li>
            </ul>
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary">Support Education</a>
        </div>
    </div>
</section>

<!-- CHILD PROTECTION -->
<section class="section section-light" id="protection">
    <div class="container section-split reverse">
        <div class="section-split-visual">
            <div class="program-visual program-visual--navy">
                <div class="program-visual-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="program-visual-label">Child Protection</div>
                <div class="program-visual-stat">Safe environments for every child</div>
            </div>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Program 02</span>
            <h2><?= h($prot['title']) ?></h2>
            <p><?= h($prot['content']) ?></p>
            <ul class="program-list">
                <li>Identifying and supporting children at risk of abuse and exploitation</li>
                <li>Emotional support and counseling for vulnerable children</li>
                <li>Assisting orphans and children from single-parent households</li>
                <li>Partnerships with local communities to create safe environments</li>
            </ul>
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary">Support Child Protection</a>
        </div>
    </div>
</section>

<!-- HEALTH & NUTRITION -->
<section class="section section-white" id="health">
    <div class="container section-split">
        <div class="section-split-visual">
            <div class="program-visual program-visual--red">
                <div class="program-visual-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                </div>
                <div class="program-visual-label">Health &amp; Nutrition</div>
                <div class="program-visual-stat">Daily meals &amp; clean water</div>
            </div>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Program 03</span>
            <h2><?= h($health['title']) ?></h2>
            <p><?= h($health['content']) ?></p>
            <ul class="program-list">
                <li>Daily balanced, nutritious meals for orphaned children</li>
                <li>Community health education and awareness</li>
                <li>Drilling clean water wells in rural communities</li>
                <li>Addressing malnutrition, cholera, and water-borne diseases</li>
            </ul>
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary">Support Health &amp; Nutrition</a>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header section-header--light">
            <span class="section-eyebrow section-eyebrow--light">The Process</span>
            <h2>How Your Donation Works</h2>
        </div>
        <div class="steps-grid">
            <div class="step-card">
                <div class="step-num">01</div>
                <h3>You Donate</h3>
                <p>Your secure donation is processed and directed toward our active programs in Cameroon, South Africa, Kenya, and Tanzania.</p>
            </div>
            <div class="step-card">
                <div class="step-num">02</div>
                <h3>We Identify</h3>
                <p>Our ground teams identify the most vulnerable children and families — prioritizing orphans, refugees, and single-parent households.</p>
            </div>
            <div class="step-card">
                <div class="step-num">03</div>
                <h3>We Deliver</h3>
                <p>Resources are delivered directly to the children: school fees paid, supplies distributed, meals provided, and wells drilled.</p>
            </div>
            <div class="step-card">
                <div class="step-num">04</div>
                <h3>Lives Change</h3>
                <p>Children attend school, grow healthy, and build a foundation for a future of dignity and self-sufficiency.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="section section-white section-center">
    <div class="container">
        <h2>Ready to Make a Difference?</h2>
        <p class="lead">Every donation — no matter the size — transforms a child's life. Join our community of compassionate donors today.</p>
        <div class="hero-actions" style="justify-content:center;margin-top:2rem;">
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg">Donate Now</a>
            <a href="/contact.php" class="btn btn-outline btn-lg">Contact Us</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
