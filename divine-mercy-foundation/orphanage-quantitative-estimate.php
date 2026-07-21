<?php
$page_title = 'Quantitative Estimate — Orphanage Construction';
$meta_desc  = 'Detailed quantitative and cost estimate for the construction works of the Divine Mercy Foundation Orphanage building.';
$current_page = 'orphanage-quantitative-estimate';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Quantitative Estimate</div>
        <h1>Quantitative Estimate</h1>
        <p>Full itemised cost estimate for the construction of the Orphanage building — Fondation Miséricorde Divine.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container">

        <div class="section-split" style="max-width:780px; margin:0 auto 2.5rem; background:var(--navy-light); border-radius:12px; padding:1.5rem 2rem; display:grid; grid-template-columns:1fr 1fr 1fr; gap:1.5rem; text-align:center;">
            <div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--red);">89,996,275</div>
                <div style="font-size:.82rem; color:var(--text-light); margin-top:.2rem;">Total Cost (FCFA)</div>
            </div>
            <div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--red);">143,010</div>
                <div style="font-size:.82rem; color:var(--text-light); margin-top:.2rem;">Cost per m²</div>
            </div>
            <div>
                <div style="font-size:1.5rem; font-weight:700; color:var(--red);">2 Phases</div>
                <div style="font-size:.82rem; color:var(--text-light); margin-top:.2rem;">Concrete + Finishing Works</div>
            </div>
        </div>

        <div style="display:flex; gap:1rem; flex-wrap:wrap; align-items:center; margin-bottom:2rem;">
            <a href="/assets/documents/quantitative-estimate-orphanage.pdf" class="btn btn-primary" target="_blank" download>
                ⬇ Download PDF
            </a>
            <a href="/assets/documents/quantitative-estimate-orphanage.pdf" class="btn btn-outline" target="_blank">
                Open in New Tab
            </a>
        </div>

        <div style="width:100%; border-radius:10px; overflow:hidden; box-shadow:0 4px 20px rgba(13,31,53,.12); border:1px solid rgba(13,31,53,.09);">
            <iframe
                src="/assets/documents/quantitative-estimate-orphanage.pdf"
                width="100%"
                height="900px"
                style="display:block; border:none;"
                title="Orphanage Quantitative Estimate">
                <p>Your browser does not support PDF embedding.
                   <a href="/assets/documents/quantitative-estimate-orphanage.pdf">Download the PDF</a> to view it.</p>
            </iframe>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Help Fund the Construction</h2>
            <p>Your donation directly contributes to building a permanent, safe home for orphaned children.</p>
        </div>
        <a href="/donate.php" class="btn btn-white">Donate Now</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
