<?php
$page_title = 'Feeding – Soup Kitchen';
$meta_desc  = 'The Divine Mercy Foundation Soup Kitchen provides daily hot meals to orphaned children and vulnerable families in Cameroon.';
$current_page = 'orphanage-soup-kitchen';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Feeding – Soup Kitchen</div>
        <h1>Feeding – Soup Kitchen</h1>
        <p>Providing daily hot meals to the children of the Divine Mercy Foundation Orphanage and vulnerable families in our community.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="section-split" style="grid-template-columns:1fr 1fr; gap:3rem; align-items:center;">
            <div>
                <span class="section-eyebrow">Our Commitment</span>
                <h2>No Child Goes Hungry</h2>
                <p>The soup kitchen at the Divine Mercy Foundation Orphanage is one of our most vital daily operations. Every morning, our team prepares nourishing meals for the children in our care and extends that generosity to vulnerable families in the surrounding community.</p>
                <p style="margin-top:1rem;">Good nutrition is the foundation of a healthy childhood — it supports learning, growth, and emotional well-being. By ensuring every child receives at least one hot, balanced meal each day, we give them the strength to thrive.</p>
                <a href="/donate.php" class="btn btn-primary" style="margin-top:1.5rem;">Support Our Feeding Programme</a>
            </div>
            <div>
                <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-849x1024.jpeg"
                     alt="Children at the soup kitchen"
                     style="width:100%; border-radius:12px; box-shadow:0 6px 24px rgba(13,31,53,.12);"
                     loading="lazy">
            </div>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">May 2023</span>
            <h2>Soup Kitchen in Action</h2>
            <p>Volunteers and staff working together to prepare and serve meals for the children.</p>
        </div>
        <div class="gallery-grid">
            <?php
            $images = [
                ['src' => 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-09-at-00.00.53-1024x768.jpeg',   'alt' => 'Soup kitchen — meal preparation'],
                ['src' => 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-09-at-00.00.53-1-1024x768.jpeg', 'alt' => 'Soup kitchen — serving meals'],
                ['src' => 'https://divinemercyfoundationfrbz.org/wp-content/uploads/2023/05/WhatsApp-Image-2023-05-09-at-00.00.53-2-1024x768.jpeg', 'alt' => 'Soup kitchen — children receiving food'],
            ];
            foreach ($images as $img): ?>
            <a href="<?= h($img['src']) ?>" class="gallery-item" target="_blank" rel="noopener">
                <img src="<?= h($img['src']) ?>" alt="<?= h($img['alt']) ?>" loading="lazy">
                <div class="gallery-overlay"><span>View</span></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <h2>Why This Matters</h2>
        </div>
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:1.5rem; max-width:900px; margin:0 auto;">
            <div style="background:var(--navy-light); border-radius:12px; padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; margin-bottom:.5rem;">🍲</div>
                <h3 style="font-size:1rem; margin-bottom:.5rem;">Daily Hot Meals</h3>
                <p style="font-size:.85rem; color:var(--text-light);">Every child receives at least one nutritious hot meal every single day.</p>
            </div>
            <div style="background:var(--navy-light); border-radius:12px; padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; margin-bottom:.5rem;">👨‍👩‍👧</div>
                <h3 style="font-size:1rem; margin-bottom:.5rem;">Community Reach</h3>
                <p style="font-size:.85rem; color:var(--text-light);">Meals are extended to vulnerable families beyond the orphanage walls.</p>
            </div>
            <div style="background:var(--navy-light); border-radius:12px; padding:1.5rem; text-align:center;">
                <div style="font-size:2rem; margin-bottom:.5rem;">❤️</div>
                <h3 style="font-size:1rem; margin-bottom:.5rem;">Volunteer-Powered</h3>
                <p style="font-size:.85rem; color:var(--text-light);">Dedicated volunteers and staff make this programme possible every day.</p>
            </div>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Feed a Child Today</h2>
            <p>A small contribution goes a long way — help us keep the soup kitchen running every day.</p>
        </div>
        <a href="/donate.php" class="btn btn-white">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
