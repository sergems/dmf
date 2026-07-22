<?php
$page_title = 'About the Orphanage';
$meta_desc  = 'Learn about the Divine Mercy Foundation Orphanage in Cameroon — its history, mission, and the children it serves.';
require_once 'includes/header.php';
$orphanage_story    = get_page_content('orphanage_story');
$orphanage_location = get_page_content('orphanage_location');
$wpimg = '/assets/images/wp-uploads';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> About</div>
        <h1>About the Orphanage</h1>
        <p>A story of faith, compassion and determination to give every child a safe place to call home.</p>
    </div>
</section>

<!-- Story -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Our Story</span>
            <h2>From a Dream to a Real Home</h2>
            <p><?= nl2br(h($orphanage_story['content'])) ?></p>
        </div>
        <div class="section-split-visual">
            <a href="<?= $wpimg ?>/2026/02/dmf-2-1024x576.jpeg" data-gallery="about-orphanage" class="gallery-item" style="border-radius:12px;overflow:hidden;">
                <img src="<?= $wpimg ?>/2026/02/dmf-2-1024x576.jpeg" alt="Orphanage building" style="width:100%;object-fit:cover;max-height:400px;">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
        </div>
    </div>
</section>

<!-- Mission & Values -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Purpose</span>
            <h2>What the Orphanage Stands For</h2>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">🏠</div>
                <h3>Safe Shelter</h3>
                <p>Every child deserves a secure roof over their head. The orphanage provides a permanent, safe home free from violence, neglect, and uncertainty.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🍽️</div>
                <h3>Nutritious Food</h3>
                <p>Children at the orphanage receive balanced, healthy meals daily. We are also developing a chicken coop to move toward self-sustainable food production.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">📚</div>
                <h3>Education</h3>
                <p>Every child in the orphanage is supported through school — with fees, uniforms, books, and mentorship provided to ensure no child falls behind.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">❤️</div>
                <h3>Love & Care</h3>
                <p>Beyond physical needs, the orphanage provides emotional support, spiritual formation, and a sense of belonging that helps children heal and grow.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🔒</div>
                <h3>Security</h3>
                <p>A completed perimeter wall now protects the orphanage compound, ensuring the children are safe from outside threats at all times.</p>
            </div>
            <div class="value-card">
                <div class="value-icon">🌱</div>
                <h3>Future-Focused</h3>
                <p>We invest in each child's long-term development — equipping them with the skills, confidence, and education needed to thrive independently.</p>
            </div>
        </div>
    </div>
</section>

<!-- Location -->
<section class="section section-white">
    <div class="container section-split reverse">
        <div class="section-split-visual">
            <a href="<?= $wpimg ?>/2026/02/dmf-6-150x150.jpeg" data-gallery="about-orphanage" class="gallery-item" style="border-radius:12px;overflow:hidden;">
                <img src="<?= $wpimg ?>/2026/02/dmf-6-150x150.jpeg" alt="Orphanage location" style="width:100%;object-fit:cover;max-height:400px;">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
        </div>
        <div class="section-split-text">
            <span class="section-eyebrow">Where We Are</span>
            <h2>Located in Cameroon, Reaching Many</h2>
            <p><?= nl2br(h($orphanage_location['content'])) ?></p>
            <div style="margin-top:1.5rem;">
                <a href="/orphanage-children.php" class="btn btn-primary">Meet the Children</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<?php require_once 'includes/footer.php'; ?>
