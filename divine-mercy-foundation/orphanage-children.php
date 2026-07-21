<?php
$page_title = 'Children at the Orphanage';
$meta_desc  = 'Meet the vulnerable children at the Divine Mercy Foundation Orphanage in Cameroon — their stories, needs, and hopes.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/orphanage.php">Orphanage</a> <span>/</span> Children</div>
        <h1>Children at the Orphanage</h1>
        <p>Behind every donation is a real child — with a name, a story, and a dream for a better future.</p>
    </div>
</section>

<!-- Who are the children -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Who We Serve</span>
            <h2>Vulnerable Children Who Need Us Most</h2>
            <p>The children at the Divine Mercy Foundation Orphanage come from some of the most difficult circumstances imaginable. Many are orphans who have lost one or both parents to illness, poverty, or conflict. Others come from single-parent households living in extreme poverty, where a parent simply cannot provide food, shelter or schooling.</p>
            <p>Before coming to the orphanage, many of these children had no security, no reliable meals, and no access to education. The orphanage changes all of that — giving each child a stable home and the chance to grow into their full potential.</p>
        </div>
        <div class="section-split-visual">
            <img src="https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-05.19.37-576x1024.jpeg" alt="Child at the orphanage" style="width:100%;border-radius:12px;object-fit:cover;max-height:460px;">
        </div>
    </div>
</section>

<!-- Conditions before / after -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">The Difference We Make</span>
            <h2>Before & After the Orphanage</h2>
        </div>
        <div class="before-after-grid">
            <div class="before-card">
                <h3>😔 Before</h3>
                <ul>
                    <li>No secure shelter — living in unsafe or temporary conditions</li>
                    <li>Little or no food — malnutrition and hunger</li>
                    <li>No access to school, books, or learning materials</li>
                    <li>Exposed to exploitation, violence, and neglect</li>
                    <li>No clean drinking water or reliable sanitation</li>
                    <li>No adult supervision or emotional support</li>
                </ul>
            </div>
            <div class="after-card">
                <h3>😊 After</h3>
                <ul>
                    <li>A permanent, secure, and loving home</li>
                    <li>Balanced, nutritious meals provided daily</li>
                    <li>Full school sponsorship — fees, uniforms, books</li>
                    <li>A safe compound with a protective perimeter wall</li>
                    <li>Clean water via an installed water tank</li>
                    <li>Caring staff, mentors, and spiritual guidance</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Photos of children -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Life at the Orphanage</span>
            <h2>Moments of Joy &amp; Hope</h2>
        </div>
        <div class="orphanage-photo-grid">
            <?php
            $photos = [
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-576x1024.jpeg', 'Children at the orphanage'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-1-576x1024.jpeg', 'Daily life'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.24.53-2-576x1024.jpeg', 'Children together'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-04.57.10-576x1024.jpeg', 'Orphanage activity'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-1-1024x576.jpeg', 'Children smiling'],
                ['https://divinemercyfoundationfrbz.org/wp-content/uploads/2025/11/WhatsApp-Image-2025-11-27-at-14.08.03-2-1024x576.jpeg', 'Happy children'],
            ];
            foreach ($photos as [$src, $alt]):
            ?>
            <div class="orphanage-photo-item">
                <img src="<?= h($src) ?>" alt="<?= h($alt) ?>" loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Needs -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Current Needs</span>
            <h2>What the Children Still Need</h2>
            <p>The orphanage is growing, but the work is not finished. Here is what your support can provide right now.</p>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <h3>Beds & Bedding</h3>
                <p>More beds and bedding are needed as the number of children in the orphanage grows. Every child deserves a proper place to sleep.</p>
            </div>
            <div class="program-card">
                <h3>Clothing</h3>
                <p>Many children arrive with little more than the clothes on their backs. Donations of clothing — especially school uniforms — are urgently needed.</p>
            </div>
            <div class="program-card">
                <h3>School Supplies</h3>
                <p>Notebooks, pens, backpacks and textbooks are needed for every child enrolled in school. Education begins with having the right tools.</p>
            </div>
            <div class="program-card">
                <h3>Building Completion</h3>
                <p>The orphanage building still requires funding to complete additional rooms, roofing, and facilities that will accommodate more children.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<?php require_once 'includes/footer.php'; ?>
