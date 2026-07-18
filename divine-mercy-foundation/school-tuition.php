<?php
$page_title = 'School Tuition List';
$meta_desc  = 'Divine Mercy Foundation School Tuition List — children sponsored for education in Cameroon and South Africa.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/reports.php">Reports</a> <span>/</span> School Tuition</div>
        <h1>School Tuition List</h1>
        <p>The complete list of children supported by Divine Mercy Foundation for their school tuition.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:820px;">
        <p>The document below contains the full list of children that Divine Mercy Foundation is sponsoring for school tuition. Each child's name, date of birth, school, class, and tuition amount is recorded. You may download the PDF to view the complete list and choose a child to sponsor.</p>

        <div class="pdf-viewer-block">
            <div class="pdf-viewer-header">
                <div class="pdf-icon">📄</div>
                <div>
                    <h3>School Tuition List — Divine Mercy Foundation</h3>
                    <p>PDF Document · Full list of sponsored children</p>
                </div>
                <a href="/assets/documents/school-tuition-list.pdf" download class="btn btn-primary pdf-download-btn">⬇ Download PDF</a>
            </div>
            <iframe
                src="/assets/documents/school-tuition-list.pdf"
                class="pdf-embed-frame"
                title="School Tuition List — Divine Mercy Foundation">
                <p>Your browser does not support embedded PDFs.
                   <a href="/assets/documents/school-tuition-list.pdf">Download the PDF</a> to view it.</p>
            </iframe>
        </div>
    </div>
</section>

<section class="section section-light">
    <div class="container" style="max-width:700px;text-align:center;">
        <span class="section-eyebrow">Support a Child</span>
        <h2>Sponsor a Child's Education</h2>
        <p>After reviewing the list, donate to cover a child's tuition for the school year. You may also choose to be a long-term sponsor, supporting a child all the way through their education.</p>
        <div style="margin-top:2rem;">
            <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-primary">Donate Now</a>
            <a href="/education-fund.php" class="btn btn-outline" style="margin-left:1rem;">Education Fund</a>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Education is the Best Gift</h2>
            <p>Not every child has the chance to afford school. Your gift makes the difference between a child's future and no future at all.</p>
        </div>
        <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-white">Give Today</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
