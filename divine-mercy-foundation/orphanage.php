<?php
$page_title = 'Orphanage';
$meta_desc  = 'Divine Mercy Foundation Orphanage — providing shelter, food, education and love to vulnerable children in Cameroon.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Orphanage</div>
        <h1>Our Orphanage</h1>
        <p>A safe home built with love — giving vulnerable children shelter, food, education and a future.</p>
    </div>
</section>

<!-- Intro -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Progress Update</span>
            <h2>Building a Home, One Step at a Time</h2>
            <p>We are proud to share the latest progress on our orphanage in Cameroon. The water tank has been successfully installed, electricity has also been connected — all made possible by the generosity of our donors. We are truly grateful.</p>
            <p>Every day, Divine Mercy Foundation provides love, care, education, and a brighter future for vulnerable children. The construction continues and we still need your support to complete this mission.</p>
            <div class="hero-actions" style="margin-top:2rem;">
                <a href="/orphanage-support.php" class="btn btn-primary">Support the Orphanage</a>
                <a href="/orphanage-gallery.php" class="btn btn-outline">View Gallery</a>
            </div>
        </div>
        <div class="section-split-visual">
            <div class="programs-img-wrap">
                <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-1-1024x576.jpeg" alt="Orphanage building" style="width:100%;border-radius:12px;object-fit:cover;max-height:380px;">
            </div>
        </div>
    </div>
</section>

<!-- Milestone cards -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Milestones</span>
            <h2>What We've Accomplished</h2>
            <p>Thanks to generous donors, the orphanage has reached several key milestones.</p>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">💧</div>
                <h3>Water Tank Installed</h3>
                <p>A dedicated water tank now provides clean, reliable water to every child living in the orphanage — a basic right every child deserves.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">💡</div>
                <h3>Electricity Connected</h3>
                <p>The orphanage now has electricity, enabling children to study after dark, stay safe, and access improved sanitation facilities.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🧱</div>
                <h3>Perimeter Wall Built</h3>
                <p>Completion of the concrete security wall protects the children and the building, with space allocated for a chicken coop toward self-sustainability.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🐔</div>
                <h3>Toward Self-Sustainability</h3>
                <p>A chicken coop is being established to provide healthy food for the children — progressing toward a self-sustaining, thriving home.</p>
            </div>
        </div>
    </div>
</section>

<!-- Recent photos strip -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Latest Photos</span>
            <h2>See the Progress</h2>
        </div>
        <div class="orphanage-photo-grid">
            <?php
            $photos = [
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-5-1024x576.jpeg', 'Orphanage exterior 2026'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-8-1024x576.jpeg', 'Construction progress'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-9-1024x576.jpeg', 'Orphanage grounds'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-3-1024x576.jpeg', 'Building interior'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-4-1024x576.jpeg', 'Orphanage view'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.34.32-1024x576.jpeg', 'Perimeter wall completion'],
            ];
            foreach ($photos as [$src, $alt]):
            ?>
            <div class="orphanage-photo-item">
                <img src="<?= h($src) ?>" alt="<?= h($alt) ?>" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align:center;margin-top:2rem;">
            <a href="/orphanage-gallery.php" class="btn btn-outline">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Help Complete the Orphanage</h2>
            <p>Children are still living in difficult conditions. Your donation — no matter the size — helps provide food, shelter, schooling, and emotional support to children who need it most.</p>
        </div>
        <a href="/orphanage-support.php" class="btn btn-white">Support Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
