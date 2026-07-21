<?php
$page_title = 'Support the Elderly and Handicapped in Rural Areas';
$meta_desc  = 'Divine Mercy Foundation supports abandoned elderly and handicapped people in rural Cameroon through volunteer care teams and outreach.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/about.php">About Us</a> <span>/</span> Support the Elderly</div>
        <h1>Support the Elderly &amp; Handicapped in Rural Areas</h1>
        <p>Restoring dignity to those who have been forgotten — our volunteer care programme for rural Cameroon.</p>
    </div>
</section>

<!-- The problem -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">The Reality</span>
            <h2>Abandoned to Die — the Crisis of Rural Elderly in Cameroon</h2>
            <p>Most elderly and handicapped people in Cameroon — especially those with no children — are totally abandoned to die without care. They can go days without food, without bathing, without light, and when they are sick, there is no one to assist them.</p>
            <p>Life is even more critical in rural communities where there is no running water and no electricity. People with physical and mental disabilities face even greater vulnerability, often left entirely on their own with no access to medical care, food, or human companionship.</p>
            <p>Some of these elderly people die alone and abandoned in their homes — and are only discovered after days.</p>
        </div>
        <div class="section-split-visual">
            <div class="elderly-stat-card">
                <div class="elderly-stat-item">
                    <div class="elderly-stat-num">Days</div>
                    <div class="elderly-stat-label">Some go without food or care for days at a time</div>
                </div>
                <div class="elderly-stat-item">
                    <div class="elderly-stat-num">0</div>
                    <div class="elderly-stat-label">Access to running water or electricity in many rural areas</div>
                </div>
                <div class="elderly-stat-item">
                    <div class="elderly-stat-num">Alone</div>
                    <div class="elderly-stat-label">Many die without anyone knowing, discovered days later</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our response -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Response</span>
            <h2>Volunteer Care Teams</h2>
            <p>Divine Mercy Foundation is organising teams of volunteers recruited among young people to provide hands-on care to the most vulnerable elderly and disabled individuals in rural Cameroon.</p>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">🧹</div>
                <h3>Daily Care Volunteers</h3>
                <p>Young volunteers serve as care-givers who bathe the elderly, gather firewood, clean their homes, and prepare food — restoring basic dignity and comfort.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🩺</div>
                <h3>Health Checks</h3>
                <p>Volunteer nurses conduct basic health assessments, administer treatments and medications, and refer individuals to medical facilities when needed.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🤝</div>
                <h3>Companionship</h3>
                <p>Beyond physical care, volunteers provide human companionship — conversation, prayer, and emotional presence — to those who are deeply isolated and lonely.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">♿</div>
                <h3>Disability Support</h3>
                <p>People with physical and mental disabilities are a special concern. We attend to them to the minimum of our abilities and work toward better ways to address their unique challenges.</p>
            </div>
        </div>
    </div>
</section>

<!-- How to help -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">How You Can Help</span>
            <h2>Support This Programme</h2>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">💳</div>
                <h3>Donate</h3>
                <p>Your donation funds transport costs for volunteers, medical supplies, food, and other essentials for the elderly individuals we serve.</p>
                <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-primary" style="margin-top:1rem;">Donate Now</a>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🙋</div>
                <h3>Volunteer</h3>
                <p>If you are based in Cameroon or willing to travel, we welcome volunteers — especially those with medical, nursing, or social care backgrounds.</p>
                <a href="/contact.php" class="btn btn-outline" style="margin-top:1rem;">Apply to Volunteer</a>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📢</div>
                <h3>Raise Awareness</h3>
                <p>Share this programme with your network. The more people know about the crisis of abandoned elderly in rural Cameroon, the more support we can mobilise.</p>
                <a href="/contact.php" class="btn btn-outline" style="margin-top:1rem;">Partner With Us</a>
            </div>
        </div>
    </div>
</section>

<!-- Plea -->
<?php require_once 'includes/footer.php'; ?>
