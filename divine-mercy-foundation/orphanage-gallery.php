<?php
$page_title = 'Orphanage Gallery';
$meta_desc  = 'Photo gallery of the Divine Mercy Foundation Orphanage — documenting construction progress and the lives of the children we serve.';
require_once 'includes/header.php';

define('WP_IMG', '/assets/images/wp-uploads');
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
            <a href="/assets/images/orphanage-july2026/<?= h($n) ?>.jpeg" class="gallery-item" data-gallery="jul2026">
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
                ['dmf-1-1024x576.jpeg', 'Orphanage 2026 — update 1'],
                ['dmf-2-1024x576.jpeg', 'Orphanage 2026 — update 2'],
                ['dmf-3-1024x576.jpeg', 'Orphanage 2026 — update 3'],
                ['dmf-4-1024x576.jpeg', 'Orphanage 2026 — update 4'],
                ['dmf-5-1024x576.jpeg', 'Orphanage 2026 — update 5'],
                ['dmf-8-1024x576.jpeg', 'Orphanage 2026 — update 6'],
                ['dmf-9-1024x576.jpeg', 'Orphanage 2026 — update 7'],
            ];
            foreach ($gallery_2026 as $i => [$file, $alt]):
            ?>
            <a href="<?= WP_IMG ?>/2026/02/<?= h($file) ?>" class="gallery-item" data-gallery="feb2026">
                <img src="<?= WP_IMG ?>/2026/02/<?= h($file) ?>" alt="<?= h($alt) ?>" loading="lazy">
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
                ['WhatsApp-Image-2025-11-27-at-14.08.03-1-1024x576.jpeg', 'Children smiling — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-14.08.03-2-1024x576.jpeg', 'Happy children — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-14.08.03-3-1024x576.jpeg', 'Children together — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-14.24.53-576x1024.jpeg',   'Children at the orphanage — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-14.24.53-1-576x1024.jpeg', 'Daily life — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-14.24.53-2-576x1024.jpeg', 'Children together — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-04.57.10-576x1024.jpeg',   'Orphanage activity — November 2025'],
                ['WhatsApp-Image-2025-11-27-at-05.19.37-576x1024.jpeg',   'Child at the orphanage — November 2025'],
            ];
            foreach ($gallery_nov25 as [$file, $alt]):
            ?>
            <a href="<?= WP_IMG ?>/2025/11/<?= h($file) ?>" class="gallery-item" data-gallery="nov2025">
                <img src="<?= WP_IMG ?>/2025/11/<?= h($file) ?>" alt="<?= h($alt) ?>" loading="lazy">
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
                ['WhatsApp-Image-2025-08-26-at-06.27.46-1-1024x576.jpeg', 'Perimeter wall — August 2025'],
                ['WhatsApp-Image-2025-08-26-at-06.34.32-1024x576.jpeg',   'Construction progress — August 2025'],
                ['WhatsApp-Image-2025-08-26-at-06.27.46-1024x576.jpeg',   'Orphanage compound — August 2025'],
            ];
            foreach ($gallery_aug25 as [$file, $alt]):
            ?>
            <a href="<?= WP_IMG ?>/2025/08/<?= h($file) ?>" class="gallery-item" data-gallery="aug2025">
                <img src="<?= WP_IMG ?>/2025/08/<?= h($file) ?>" alt="<?= h($alt) ?>" loading="lazy">
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
                ['WhatsApp-Image-2025-02-26-at-12.11.20.jpeg',   'Construction in progress — February 2025'],
                ['WhatsApp-Image-2025-02-26-at-12.11.19-1.jpeg', 'Building progress — February 2025'],
                ['WhatsApp-Image-2025-02-26-at-12.11.19.jpeg',   'Orphanage building — February 2025'],
                ['WhatsApp-Image-2025-02-26-at-12.09.44.jpeg',   'Construction site — February 2025'],
            ];
            foreach ($gallery_feb25 as [$file, $alt]):
            ?>
            <a href="<?= WP_IMG ?>/2025/02/<?= h($file) ?>" class="gallery-item" data-gallery="feb2025">
                <img src="<?= WP_IMG ?>/2025/02/<?= h($file) ?>" alt="<?= h($alt) ?>" loading="lazy">
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
                ['2023/07', 'WhatsApp-Image-2023-07-29-at-20.41.50-5.jpeg',    'Early days — July 2023'],
                ['2023/07', 'WhatsApp-Image-2023-07-29-at-20.41.51-1-1.jpeg',  'Temporary orphanage — July 2023'],
                ['2023/07', 'WhatsApp-Image-2023-07-29-at-20.41.56.jpeg',      'Children in early days — July 2023'],
                ['2023/05', 'WhatsApp-Image-2023-05-02-at-18.49.48-576x1024.jpeg', 'Orphanage May 2023'],
                ['2023/05', 'WhatsApp-Image-2023-05-02-at-18.49.45-576x1024.jpeg', 'Children — May 2023'],
                ['2023/05', 'WhatsApp-Image-2023-05-02-at-18.49.47-576x1024.jpeg', 'Early orphanage — May 2023'],
            ];
            foreach ($gallery_2023 as [$yrmo, $file, $alt]):
            ?>
            <a href="<?= WP_IMG ?>/<?= h($yrmo) ?>/<?= h($file) ?>" class="gallery-item" data-gallery="2023">
                <img src="<?= WP_IMG ?>/<?= h($yrmo) ?>/<?= h($file) ?>" alt="<?= h($alt) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>
