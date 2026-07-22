<?php
$page_title = 'Orphanage — Orphanage Elizabeth Sana, Yaoundé';
$meta_desc  = 'Divine Mercy Foundation is constructing Orphanage Elizabeth Sana in Yaoundé, Cameroon — a safe, permanent home for 80 vulnerable children. Follow our progress.';
$current_page = 'orphanage';
require_once 'includes/header.php';
$orphanage_progress = get_page_content('orphanage_progress_update');
$orphanage_about    = get_page_content('orphanage_about_project');
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
            <p><?= nl2br(h($orphanage_progress['content'])) ?></p>
            <div class="hero-actions" style="margin-top:1.75rem;">
                <a href="/orphanage-support.php" class="btn btn-primary">Support the Orphanage</a>
                <a href="/orphanage-gallery.php" class="btn btn-outline">View Gallery</a>
            </div>
        </div>
        <div class="section-split-visual">
            <div class="programs-img-wrap">
                <img src="/assets/images/orphanage-july2026/img-01.jpeg"
                     alt="Orphanage Elizabeth Sana — July 2026"
                     style="width:100%;border-radius:12px;object-fit:cover;max-height:380px;">
            </div>
        </div>
    </div>
</section>


<!-- ── NEW UPDATE: Children now living in the orphanage ── -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Major Update — 2025</span>
            <h2>The Children Are Now Home</h2>
            <p style="max-width:720px;margin:0 auto;">We are overjoyed to announce that the children are now living in the orphanage here in Assok, Yaoundé, Cameroon. After years of construction, sacrifice, and the generosity of donors across the world — our children have a real home.</p>
        </div>

        <!-- Photo grid -->
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:1rem; margin-bottom:3rem;">
            <?php
            $update_imgs = [
                ['src'=>'/assets/images/orphanage-2025-update/img-05.jpeg','alt'=>'The orphanage building — Assok, Yaoundé'],
                ['src'=>'/assets/images/orphanage-2025-update/img-01.jpeg','alt'=>'Children in their classroom'],
                ['src'=>'/assets/images/orphanage-2025-update/img-04.jpeg','alt'=>'Mealtime at the orphanage'],
                ['src'=>'/assets/images/orphanage-2025-update/img-02.jpeg','alt'=>'Children at the orphanage'],
                ['src'=>'/assets/images/orphanage-2025-update/img-03.jpeg','alt'=>'Girls in white dresses at the orphanage'],
                ['src'=>'/assets/images/orphanage-2025-update/img-06.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-07.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-08.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-09.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-10.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-11.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
                ['src'=>'/assets/images/orphanage-2025-update/img-12.jpeg','alt'=>'Children at Orphanage Elizabeth Sana'],
            ];
            foreach ($update_imgs as $img): ?>
            <a href="<?= h($img['src']) ?>" class="gallery-item" target="_blank" rel="noopener" style="border-radius:10px;overflow:hidden;display:block;aspect-ratio:4/3;">
                <img src="<?= h($img['src']) ?>" alt="<?= h($img['alt']) ?>" loading="lazy" style="width:100%;height:100%;object-fit:cover;">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Text + Map split -->
        <div class="container section-split" style="padding:0;">
            <div class="section-split-text">
                <span class="section-eyebrow">Our Location</span>
                <h3>Orphanage Elizabeth Sana</h3>
                <p>The children are now settled in their new home in <strong>Assok, Yaoundé, Cameroon</strong>. They have proper bedrooms, a dining room, a classroom, and safe outdoor space — everything a child deserves.</p>
                <p>The orphanage is officially registered on Google Maps under:</p>
                <p><strong>Orphelinat Élizabetta Sanna de Divine Mercy Foundation</strong><br>
                P.O. Box 14040, Assok, Yaoundé, Cameroon</p>
                <div style="margin-top:1.5rem;display:flex;gap:1rem;flex-wrap:wrap;">
                    <a href="https://maps.app.goo.gl/search/?q=Orphelinat+%C3%89lizabetta+Sanna+de+Divine+Mercy+Foundation" target="_blank" rel="noopener" class="btn btn-outline">View on Google Maps</a>
                    <a href="/donate.php" class="btn btn-primary">Support the Orphanage</a>
                </div>
            </div>
            <div class="section-split-visual">
                <div style="border-radius:12px;overflow:hidden;box-shadow:0 4px 20px rgba(13,31,53,.1);height:320px;">
                    <iframe
                        src="https://maps.google.com/maps?q=Orph%C3%A9linat+%C3%89lizabetta+Sanna+de+Divine+Mercy+Foundation,+Assok,+Yaound%C3%A9,+Cameroon&output=embed"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Orphanage Elizabeth Sana — Assok, Yaoundé"></iframe>
                </div>
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
            <p><?= nl2br(h($orphanage_about['content'])) ?></p>
        </div>
    </div>
</section>

<?php
// ── Dynamic photo albums from DB ─────────────────────────────
$_albums = get_db()->query("SELECT * FROM orphanage_albums ORDER BY sort_order, id")->fetchAll();
$_photo_stmt = get_db()->prepare("SELECT * FROM orphanage_photos WHERE album_id=? ORDER BY sort_order, id");
$_bg = ['section-light','section-white'];
foreach ($_albums as $_ai => $_album):
    $_photo_stmt->execute([$_album['id']]);
    $_photos = $_photo_stmt->fetchAll();
    if (empty($_photos)) continue;
?>
<section class="section <?= $_bg[$_ai % 2] ?>">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow"><?= h($_album['eyebrow']) ?></span>
            <h2><?= h($_album['heading']) ?></h2>
            <?php if (!empty($_album['description'])): ?>
            <p><?= nl2br(h($_album['description'])) ?></p>
            <?php endif; ?>
        </div>
        <div class="gallery-grid">
            <?php foreach ($_photos as $_p):
                $_src = str_starts_with($_p['src'],'http') ? $_p['src'] : '/'.$_p['src'];
                $_alt = $_p['caption'] ?: h($_album['eyebrow']).' — Orphanage Elizabeth Sana';
            ?>
            <a href="<?= h($_src) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($_src) ?>" alt="<?= h($_alt) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

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
