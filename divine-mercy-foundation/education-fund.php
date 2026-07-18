<?php
$page_title = 'Education Fund';
$meta_desc  = 'Divine Mercy Foundation Education Fund — sponsor a child\'s education in Cameroon with tuition, uniforms and feeding support.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/reports.php">Reports</a> <span>/</span> Education Fund</div>
        <h1>Education Fund</h1>
        <p>Education is the best gift we can give to every child.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:820px;">

        <p>Education is the best gift we can give to every child. However not every child has the chance to afford education.</p>

        <p>We have orphans and very disadvantaged kids whom we are helping for tuition, uniforms, and feeding.</p>

        <p>Please support one child of your choice; You may choose to adopt one to sponsor him/her till they finish their education. Please donate by scanning our QR code below or write a check to Divine mercy Foundation, Fr. Georges Roger Bidzogo sac (email it to Holy Redeemer Catholic Church, 1227 East Bristol Road, MI 48529. You also send to our address in Texas, which takes a little bit longer for our general secretary to get the checks.</p>

        <p>The drive campaign for this academic year goes from this month till January 2025.</p>

        <div class="edu-qr-block">
            <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/09/QR-150x150.jpg"
                 alt="Donate QR Code — Divine Mercy Foundation"
                 class="edu-qr-img">
            <p class="edu-qr-caption">Scan to donate</p>
        </div>

    </div>
</section>

<section class="section section-light">
    <div class="container" style="max-width:820px;">
        <div class="edu-appeal-box">
            <h2>Give hope. Change a life.</h2>
            <p>Every day, Divine Mercy Foundation provides love, care, education, and a brighter future for vulnerable children in Cameroon and South Africa. But we can't do it alone — your kindness keeps their dreams alive. 💛</p>
            <p>Will you make a difference today? Your donation, no matter the amount, helps us provide food, shelter, schooling, and emotional support to children who need it most.</p>
            <p>👉 Donate now and be the reason a child smiles. Thank you for your compassion.</p>
            <div style="margin-top:1.75rem;display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-primary">Donate Now</a>
                <a href="/school-tuition.php" class="btn btn-outline">View School Tuition List</a>
            </div>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">How It Works</span>
            <h2>Sponsor a Child's Education</h2>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">👶</div>
                <h3>Choose a Child</h3>
                <p>Browse our school tuition list to see the children who need support. Each child's name, school, class and tuition amount is listed.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">💳</div>
                <h3>Make a Donation</h3>
                <p>Donate by scanning the QR code, writing a cheque to Divine Mercy Foundation, or sending funds to our Texas address.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📚</div>
                <h3>Change a Life</h3>
                <p>Your gift covers tuition, uniforms and feeding — giving a child the chance to learn, grow, and build a future with dignity.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🔁</div>
                <h3>Long-Term Sponsorship</h3>
                <p>You may choose to adopt a child as a long-term sponsor, supporting them all the way through to the end of their education.</p>
            </div>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Education Changes Everything</h2>
            <p>A child who receives an education breaks the cycle of poverty — for themselves, their family, and their community.</p>
        </div>
        <a href="/school-tuition.php" class="btn btn-white">See Tuition List</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
