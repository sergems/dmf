<?php
$page_title = 'Orphanage — Orphanage Elizabeth Sana, Yaoundé';
$meta_desc  = 'Divine Mercy Foundation is constructing Orphanage Elizabeth Sana in Yaoundé, Cameroon — a safe, permanent home for 80 vulnerable children. Follow our progress.';
$current_page = 'orphanage';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Orphanage</div>
        <h1>Orphanage Elizabeth Sana</h1>
        <p>Yaoundé, Cameroon — a permanent, safe home for 80 vulnerable children from across Africa.</p>
    </div>
</section>

<!-- Progress update -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Progress Update</span>
            <h2>Building a Home, Step by Step</h2>
            <p>We would like to share the progress update of our orphanage. The water tank has been successfully installed, electricity has also been installed. We would like to thank everyone that has donated so far to make this come true — we are truly grateful.</p>
            <p style="margin-top:1rem;">Every day, Divine Mercy Foundation provides love, care, education, and a brighter future for vulnerable children — and we still need you.</p>
            <div class="hero-actions" style="margin-top:1.75rem;">
                <a href="/orphanage-support.php" class="btn btn-primary">Support the Orphanage</a>
                <a href="/orphanage-gallery.php" class="btn btn-outline">View Gallery</a>
            </div>
        </div>
        <div class="section-split-visual">
            <div class="programs-img-wrap">
                <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/dmf-1-1024x576.jpeg"
                     alt="Orphanage Elizabeth Sana — 2026"
                     style="width:100%;border-radius:12px;object-fit:cover;max-height:380px;">
            </div>
        </div>
    </div>
</section>

<!-- Key stats -->
<section class="section section-light">
    <div class="container">
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:1.5rem; max-width:900px; margin:0 auto; text-align:center;">
            <div style="background:#fff; border-radius:12px; padding:1.75rem 1rem; box-shadow:0 2px 12px rgba(13,31,53,.07);">
                <div style="font-size:2rem; font-weight:700; color:var(--red);">80</div>
                <div style="font-size:.85rem; color:var(--text-light); margin-top:.35rem;">Planned Capacity (children)</div>
            </div>
            <div style="background:#fff; border-radius:12px; padding:1.75rem 1rem; box-shadow:0 2px 12px rgba(13,31,53,.07);">
                <div style="font-size:2rem; font-weight:700; color:var(--red);">60</div>
                <div style="font-size:.85rem; color:var(--text-light); margin-top:.35rem;">Children Currently Supported</div>
            </div>
            <div style="background:#fff; border-radius:12px; padding:1.75rem 1rem; box-shadow:0 2px 12px rgba(13,31,53,.07);">
                <div style="font-size:2rem; font-weight:700; color:var(--red);">$3,500</div>
                <div style="font-size:.85rem; color:var(--text-light); margin-top:.35rem;">Monthly Feeding &amp; Tuition Cost</div>
            </div>
            <div style="background:#fff; border-radius:12px; padding:1.75rem 1rem; box-shadow:0 2px 12px rgba(13,31,53,.07);">
                <div style="font-size:2rem; font-weight:700; color:var(--red);">735</div>
                <div style="font-size:.85rem; color:var(--text-light); margin-top:.35rem;">Children Assisted (2016–2022)</div>
            </div>
        </div>
    </div>
</section>

<!-- About the project -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">About the Project</span>
            <h2>Our Mission — No Discrimination</h2>
        </div>
        <div style="max-width:800px; margin:0 auto; font-size:1.05rem; line-height:1.85; color:var(--text-light);">
            <p>Divine Mercy Foundation is making steady progress in constructing its orphanage in Cameroon, which will provide a safe and nurturing home for <strong>80 children</strong> — boys and girls — from across Africa. Currently, we are supporting 60 children who remain with guardians by covering their feeding and tuition expenses, costing approximately <strong>$3,500 monthly</strong>.</p>
            <p style="margin-top:1rem;">The orphanage operates under the <strong>Child Protection Act</strong>, with a certified social worker, a qualified nurse, and thoroughly vetted and trained staff ensuring child safety and care. Construction has been paused due to a lack of funds, despite significant progress so far. We appeal for donations to help us complete this vital project and provide a permanent sanctuary for these children.</p>
            <p style="margin-top:1rem;">We thank you all for your support in building this orphanage with us. We are progressing with you. Please help us finalize the project through your generous contributions.</p>
            <p style="margin-top:1rem; font-style:italic; color:var(--navy);">Divine Mercy Foundation — Orphanage Elizabeth Sana, Yaoundé, Cameroon.</p>
        </div>
    </div>
</section>

<!-- Latest photos 2026 -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">February 2026</span>
            <h2>Latest Progress Photos</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base26 = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2026/02/';
            $photos26 = ['dmf-1-1024x576.jpeg','dmf-2-1024x576.jpeg','dmf-3-1024x576.jpeg',
                         'dmf-4-1024x576.jpeg','dmf-5-1024x576.jpeg','dmf-8-1024x576.jpeg','dmf-9-1024x576.jpeg'];
            foreach ($photos26 as $i => $f): ?>
            <a href="<?= h($base26.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base26.$f) ?>" alt="Orphanage — February 2026, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- November 2025 photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">November 2025</span>
            <h2>November 2025 Visit</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base25n = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/';
            $photos25n = [
                'WhatsApp-Image-2025-11-27-at-04.57.10-576x1024.jpeg',
                'WhatsApp-Image-2025-11-27-at-05.19.37-849x1024.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.08.03-1-1024x576.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.08.03-2-1024x576.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.08.03-3-1024x576.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.24.53-576x1024.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.24.53-1-576x1024.jpeg',
                'WhatsApp-Image-2025-11-27-at-14.24.53-2-576x1024.jpeg',
            ];
            foreach ($photos25n as $i => $f): ?>
            <a href="<?= h($base25n.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base25n.$f) ?>" alt="Orphanage — November 2025, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- August 2025 photos -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">August 2025</span>
            <h2>Perimeter Wall Completion</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base25a = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/08/';
            $photos25a = [
                'WhatsApp-Image-2025-08-26-at-06.27.46-1024x576.jpeg',
                'WhatsApp-Image-2025-08-26-at-06.27.46-1-1024x576.jpeg',
                'WhatsApp-Image-2025-08-26-at-06.34.32-1024x576.jpeg',
            ];
            foreach ($photos25a as $i => $f): ?>
            <a href="<?= h($base25a.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base25a.$f) ?>" alt="Orphanage — August 2025, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- February 2025 photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">February 2025</span>
            <h2>February 2025 Update</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base25f = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/02/';
            $photos25f = [
                'WhatsApp-Image-2025-02-26-at-12.09.44.jpeg',
                'WhatsApp-Image-2025-02-26-at-12.11.19.jpeg',
                'WhatsApp-Image-2025-02-26-at-12.11.19-1.jpeg',
                'WhatsApp-Image-2025-02-26-at-12.11.20.jpeg',
            ];
            foreach ($photos25f as $i => $f): ?>
            <a href="<?= h($base25f.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base25f.$f) ?>" alt="Orphanage — February 2025, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- December 2024 -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">December 2024</span>
            <h2>December 2024</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $photos24d = [
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/12/house2.png',               'Orphanage building plan'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/12/WhatsApp-Image-2024-12-10-at-22.13.32-1.jpeg', 'Orphanage — December 2024'],
            ];
            foreach ($photos24d as [$src, $alt]): ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="<?= h($alt) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- May 2024 photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">May 2024</span>
            <h2>May 2024 Construction Progress</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base24m = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/05/';
            $photos24m = [
                'WhatsApp-Image-2024-05-23-at-04.51.38.jpeg',
                'WhatsApp-Image-2024-05-23-at-04.51.38-2.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.12.53-768x346.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.14.41.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.16.36.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.18.36-768x432.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.20.09.jpeg',
                'WhatsApp-Image-2024-05-23-at-05.23.18.jpeg',
                'WhatsApp-Image-2024-05-24-at-18.19.57-768x346.jpeg',
                'WhatsApp-Image-2024-05-24-at-18.19.57-1-768x346.jpeg',
                'WhatsApp-Image-2024-05-24-at-18.19.57-2-768x346.jpeg',
                'WhatsApp-Image-2024-05-24-at-18.19.57-3-768x346.jpeg',
                'WhatsApp-Image-2024-05-30-at-21.40.17.jpeg',
                'WhatsApp-Image-2024-05-30-at-21.40.17-1.jpeg',
                'WhatsApp-Image-2024-05-30-at-21.40.17-2.jpeg',
                'WhatsApp-Image-2024-05-30-at-21.40.17-3.jpeg',
            ];
            foreach ($photos24m as $i => $f): ?>
            <a href="<?= h($base24m.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base24m.$f) ?>" alt="Orphanage construction — May 2024, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Jan–Feb 2024 photos -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">January – February 2024</span>
            <h2>Early 2024 Progress</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $photos24e = [
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/06/yaounde.jpg',              'Yaoundé, Cameroon'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/1-1024x768.jpeg',          'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/1-1-1024x768.jpeg',        'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/4-1024x768.jpeg',          'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/5-1024x768.jpeg',          'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/6-1024x768.jpeg',          'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/01/7-1024x768.jpeg',          'Orphanage — Jan 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-1-768x346.jpeg',     'Orphanage — Feb 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-2-768x346.jpeg',     'Orphanage — Feb 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-3-768x346.jpeg',     'Orphanage — Feb 2024'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2024/02/image-4-768x346.jpeg',     'Orphanage — Feb 2024'],
            ];
            foreach ($photos24e as [$src, $alt]): ?>
            <a href="<?= h($src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($src) ?>" alt="<?= h($alt) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- July 2023 photos -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">July 2023</span>
            <h2>July 2023</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base23j = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/07/';
            $photos23j = [
                'DMF.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.49-1.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.49-2.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.49-3.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.50-3.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.50-4.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.50-5.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.51-1-1.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.53-1.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.53-2.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.53-3.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.53-4.jpeg',
                'WhatsApp-Image-2023-07-29-at-20.41.56.jpeg',
            ];
            foreach ($photos23j as $i => $f): ?>
            <a href="<?= h($base23j.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base23j.$f) ?>" alt="Orphanage — July 2023, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- May 2023 photos -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">May 2023</span>
            <h2>May 2023 — Early Days</h2>
        </div>
        <div class="gallery-grid">
            <?php
            $base23m = 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/';
            $photos23m = [
                'WhatsApp-Image-2023-05-02-at-18.49.45-576x1024.jpeg',
                'WhatsApp-Image-2023-05-02-at-18.49.47-576x1024.jpeg',
                'WhatsApp-Image-2023-05-02-at-18.49.47-1-576x1024.jpeg',
                'WhatsApp-Image-2023-05-02-at-18.49.48-576x1024.jpeg',
            ];
            foreach ($photos23m as $i => $f): ?>
            <a href="<?= h($base23m.$f) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($base23m.$f) ?>" alt="Orphanage — May 2023, photo <?= $i+1 ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Philosophy / adoption section -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Philosophy</span>
            <h2>Help People to Help Themselves</h2>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:2.5rem; max-width:900px; margin:0 auto;">
            <div>
                <h3 style="font-size:1.05rem; margin-bottom:.75rem;">Self-Sufficiency First</h3>
                <p style="color:var(--text-light); line-height:1.8;">Divine Mercy Foundation wishes to help people to help themselves. The proverb — <em>"Help a man to fish instead of giving him the fish"</em> — is one of our most important priorities. We wish to help every family to have a breadwinner or a person who can lift the rest of the family. From 2016 to 2022, the Foundation assisted a total of <strong>735 children</strong> in Cameroon and South Africa.</p>
            </div>
            <div>
                <h3 style="font-size:1.05rem; margin-bottom:.75rem;">Adopt a Child or Family</h3>
                <p style="color:var(--text-light); line-height:1.8;">The Foundation gives you the opportunity to adopt a child or choose a family that you can assist in order to help them develop and become autonomous. This is based on the individual life story. We currently have such children and families in Cameroon and South Africa.</p>
                <p style="color:var(--text-light); line-height:1.8; margin-top:1rem;">At the same time, the Foundation has been empowering poor parents by funding their small businesses so that they are not totally dependent on sponsorship — some run market stalls, others sell fruits and vegetables, and others open small shops.</p>
            </div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
