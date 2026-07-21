<?php
$page_title = 'Orphanage Gallery';
$meta_desc  = 'Photo gallery of the Divine Mercy Foundation Orphanage — documenting construction progress and the lives of the children we serve.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Gallery</div>
        <h1>Orphanage Gallery</h1>
        <p>A visual journey through the construction, growth and daily life of our orphanage in Cameroon.</p>
    </div>
</section>

<!-- July 2026 — new photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">July 2026 — New</span>
            <h2>Life Inside the Orphanage</h2>
            <p>Children learning in their new classrooms, sharing meals in the dining hall, and celebrating together — a window into daily life at Orphanage Elizabeth Sana.</p>
        </div>
        <div class="gallery-grid">
            <?php
            $jul26_photos = [
                ['img-01', 'The orphanage building — Orphanage Elizabeth Sana, Yaoundé'],
                ['img-05', 'Children in their classroom in red foundation uniforms'],
                ['img-06', 'Children relaxing between activities'],
                ['img-07', 'Girls dressed in white for a special celebration'],
                ['img-08', 'Children sharing a meal in the dining hall'],
                ['img-09', 'Children at the orphanage — July 2026'],
                ['img-10', 'Children at the orphanage — July 2026'],
                ['img-11', 'Children at the orphanage — July 2026'],
                ['img-12', 'Children at the orphanage — July 2026'],
                ['img-13', 'Children at the orphanage — July 2026'],
                ['img-14', 'Children at the orphanage — July 2026'],
                ['img-15', 'Children at the orphanage — July 2026'],
                ['img-16', 'Children at the orphanage — July 2026'],
            ];
            foreach ($jul26_photos as [$n, $alt]): ?>
            <a href="/assets/images/orphanage-july2026/<?= h($n) ?>.jpeg" class="gallery-item" target="_blank" rel="noopener">
                <img src="/assets/images/orphanage-july2026/<?= h($n) ?>.jpeg" alt="<?= h($alt) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Feb 2026 photos -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">2026</span>
            <h2>Latest Updates</h2>
            <p>Water tank installed, electricity connected — the orphanage continues to grow.</p>
        </div>
        <div class="gallery-grid">
            <?php
            $gallery_2026 = [
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-1-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-2-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-3-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-4-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-5-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-8-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-9-1024x576.jpeg',
            ];
            foreach ($gallery_2026 as $i => $src):
            ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="Orphanage 2026 — photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Nov 2025 -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">November 2025</span>
            <h2>Children & Daily Life</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $gallery_nov25 = [
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-1-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-2-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-3-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-1-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-2-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-04.57.10-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-576x1024.jpeg',
            ];
            foreach ($gallery_nov25 as $i => $src):
            ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="Orphanage November 2025 — photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Aug 2025 -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">August 2025</span>
            <h2>Perimeter Wall Completed</h2>
            <p>Completion of the concrete wall to protect the orphanage — and opening space for a chicken coop toward self-sustainability.</p>
        </div>
        <div class="gallery-grid">
            <?php
            $gallery_aug25 = [
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.27.46-1-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.34.32-1024x576.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/WhatsApp-Image-2025-08-26-at-06.27.46-1024x576.jpeg',
            ];
            foreach ($gallery_aug25 as $i => $src):
            ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="Orphanage August 2025 — photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Feb 2025 -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">February 2025</span>
            <h2>Construction in Progress</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $gallery_feb25 = [
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.20.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.19-1.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.11.19.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/WhatsApp-Image-2025-02-26-at-12.09.44.jpeg',
            ];
            foreach ($gallery_feb25 as $i => $src):
            ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="Orphanage February 2025 — photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Earlier photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">2023 — Early Days</span>
            <h2>Where It All Began</h2>
            <p>The temporary orphanage before permanent construction began — children were living in very difficult conditions.</p>
        </div>
        <div class="gallery-grid">
            <?php
            $gallery_2023 = [
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/07/WhatsApp-Image-2023-07-29-at-20.41.50-5.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/07/WhatsApp-Image-2023-07-29-at-20.41.51-1-1.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/07/WhatsApp-Image-2023-07-29-at-20.41.56.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.48-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.45-576x1024.jpeg',
                'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-02-at-18.49.47-576x1024.jpeg',
            ];
            foreach ($gallery_2023 as $i => $src):
            ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="Orphanage 2023 — photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Help Write the Next Chapter</h2>
            <p>These photos show how far we've come. With your support, the next chapter will be even better.</p>
        </div>
        <a href="/orphanage-support.php" class="btn btn-white">Support the Orphanage</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
