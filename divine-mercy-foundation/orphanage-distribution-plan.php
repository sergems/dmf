<?php
$page_title = 'Distribution Plan — Orphanage';
$meta_desc  = 'Architectural distribution plan of the Divine Mercy Foundation Orphanage building in Cameroon.';
$current_page = 'orphanage-distribution-plan';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Distribution Plan</div>
        <h1>Distribution Plan</h1>
        <p>Architectural floor plan showing the layout and room distribution of the Divine Mercy Foundation Orphanage.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">
        <div style="display:flex; gap:1rem; flex-wrap:wrap; align-items:center; margin-bottom:2rem;">
            <a href="/assets/documents/distribution-plan-orphanage.pdf" class="btn btn-primary" target="_blank" download>
                ⬇ Download PDF
            </a>
            <a href="/assets/documents/distribution-plan-orphanage.pdf" class="btn btn-outline" target="_blank">
                Open in New Tab
            </a>
        </div>

        <div style="width:100%; border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(13,31,53,.12); border:1px solid rgba(13,31,53,.09);">
            <iframe
                src="/assets/documents/distribution-plan-orphanage.pdf"
                width="100%"
                height="800px"
                style="display:block; border:none;"
                title="Orphanage Distribution Plan">
                <p>Your browser does not support PDF embedding.
                   <a href="/assets/documents/distribution-plan-orphanage.pdf">Download the PDF</a> to view it.</p>
            </iframe>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Help Build This Orphanage</h2>
            <p>Every contribution brings us closer to completing this home for children in need.</p>
        </div>
        <a href="/orphanage-support.php" class="btn btn-white">Support the Orphanage</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
