<?php
$page_title = 'Distribution of Tuition and School Mattresses';
$meta_desc  = 'Distribution of tuition fees and school mattresses at Orphanage Elizabeth Sana — Divine Mercy Foundation, September 2024.';
$current_page = 'orphanage-distribution-tuition';
require_once 'includes/header.php';

// All images from September 2024 distribution event — using full-res WordPress originals
$base = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/09/';
$images_sep5 = [
    'WhatsApp-Image-2024-09-05-at-06.07.02.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-1.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-2.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-3.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-4.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-5.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-6.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-7.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-8.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.02-9.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-1.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-2.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-3.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-4.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-5.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-6.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-7.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-8.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-9.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.03-10.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-1.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-2.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-3.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-4.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-5.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-6.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-7.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-8.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-9.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.04-10.jpeg',
    'WhatsApp-Image-2024-09-05-at-06.07.05.jpeg',
];
$images_sep7 = [
    'WhatsApp-Image-2024-09-07-at-04.52.55.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-1.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-2.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-3.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-4.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-5.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-6.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-7.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.55-8.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-1.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-2.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-3.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-4.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-5.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.56-6.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-1.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-2.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-3.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-4.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-5.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-6.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-7.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.57-8.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.58.jpeg',
    'WhatsApp-Image-2024-09-07-at-04.52.58-1.jpeg',
];
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Distribution of Tuition &amp; School Mattresses</div>
        <h1>Distribution of Tuition &amp; School Mattresses</h1>
        <p>Orphanage Elizabeth Sana — Divine Mercy Foundation, September 2024</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div style="max-width:720px; margin:0 auto 2.5rem; text-align:center;">
            <p style="font-size:1.05rem; color:var(--text-light); line-height:1.8;">
                In September 2024, the Divine Mercy Foundation carried out a special distribution event at Orphanage Elizabeth Sana — providing school tuition support and mattresses to the children in our care. This initiative ensures that every child not only has a roof over their head, but the means to receive an education and sleep in dignity.
            </p>
        </div>
    </div>
</section>

<!-- September 5 photos -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">5 September 2024</span>
            <h2>Tuition & Mattress Distribution — Day 1</h2>
            <p>Children and staff gather as tuition payments and school mattresses are distributed at the orphanage.</p>
        </div>
        <div class="gallery-grid">
            <?php foreach ($images_sep5 as $i => $filename): ?>
            <a href="<?= h($base . $filename) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base . $filename) ?>"
                     alt="Tuition & mattress distribution — 5 Sep 2024, photo <?= $i + 1 ?>"
                     loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- September 7 photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">7 September 2024</span>
            <h2>Tuition & Mattress Distribution — Day 2</h2>
            <p>Continued distribution ensuring every child at Orphanage Elizabeth Sana receives their school supplies and mattress.</p>
        </div>
        <div class="gallery-grid">
            <?php foreach ($images_sep7 as $i => $filename): ?>
            <a href="<?= h($base . $filename) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base . $filename) ?>"
                     alt="Tuition & mattress distribution — 7 Sep 2024, photo <?= $i + 1 ?>"
                     loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Nov 2025 follow-up -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">November 2025</span>
            <h2>Continued Support</h2>
            <p>Our commitment to the children of Orphanage Elizabeth Sana continues in 2025 and beyond.</p>
        </div>
        <div class="gallery-grid">
            <a href="https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-849x1024.jpeg" class="gallery-item" target="_blank" rel="noopener">
                <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-849x1024.jpeg"
                     alt="Orphanage Elizabeth Sana — November 2025" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Help a Child Go to School</h2>
            <p>Your donation funds tuition, school supplies, and the basic necessities every child deserves.</p>
        </div>
        <a href="/donate.php" class="btn btn-white">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
