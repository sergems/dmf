<?php
$page_title = 'Our Mission';
$meta_desc  = 'The mission of Divine Mercy Foundation — a 501(c)(3) faith-based nonprofit serving the poor, orphans, and vulnerable in Cameroon and beyond.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> <a href="/about.php">About Us</a> <span>/</span> Our Mission</div>
        <h1>Our Mission</h1>
        <p>Rooted in faith, driven by mercy — bringing hope and dignity to the most vulnerable.</p>
    </div>
</section>

<!-- Foundation statement -->
<section class="section section-white">
    <div class="container section-split">
        <div class="section-split-text">
            <span class="section-eyebrow">Who We Are</span>
            <h2>A Faith-Based Foundation for the Vulnerable</h2>
            <p>Divine Mercy Foundation is a 501(c)(3) non-profit foundation drawing its roots from the corporal works of mercy as described in the Gospel of Matthew 25:31–46. As a faith-based ministry, the Foundation imitates Jesus's ministry to set people free (John 8:36) and to give life abundantly to humanity (John 10:10).</p>
            <p>The Foundation aims at intervening, advocating and protesting whenever the flow of life is being denied, restricted or even completely inadequate to the normal conditions of life. We are based in Texas, USA, and operate primarily in Cameroon, South Africa, Kenya and Tanzania.</p>
        </div>
        <div class="section-split-visual">
            <div class="mission-scripture-card">
                <div class="scripture-icon">✝</div>
                <blockquote>
                    "For I was hungry and you gave me food, I was thirsty and you gave me drink, I was a stranger and you welcomed me."
                </blockquote>
                <cite>— Matthew 25:35</cite>
            </div>
        </div>
    </div>
</section>

<!-- Catechism quote -->
<section class="section section-light">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Foundation</span>
            <h2>The Works of Mercy</h2>
            <p>The Catechism of the Catholic Church, paragraph 2447, reads:</p>
        </div>
        <div class="mission-quote-block">
            <p class="mission-quote-text">"The works of mercy are charitable actions by which we come to the aid of our neighbor in his spiritual and bodily necessities."</p>
            <div class="mission-scripture-refs">
                <span>Isaiah 58:6–7</span>
                <span>Hebrews 13:3</span>
                <span>Matthew 25:31–46</span>
                <span>Tobit 4:5–11</span>
                <span>Sirach 17:22</span>
                <span>Matthew 6:2–4</span>
            </div>
        </div>
        <div class="mission-verse-grid">
            <div class="mission-verse">
                <p>"He who has two coats, let him share with him who has none, and he who has food must do likewise."</p>
            </div>
            <div class="mission-verse">
                <p>"If a brother or sister is ill-clad and in lack of daily food, and one of you says to them, 'Go in peace, be warmed and filled,' without giving them the things needed for the body, what does it profit?"</p>
                <cite>James 2:15–16; cf. 1 John 3:17</cite>
            </div>
        </div>
    </div>
</section>

<!-- What we do -->
<section class="section section-white">
    <div class="container">
        <div class="section-header">
            <span class="section-eyebrow">Our Work</span>
            <h2>How We Live Our Mission</h2>
        </div>
        <div class="programs-grid">
            <div class="program-card">
                <div class="program-card-icon">🏠</div>
                <h3>Shelter the Homeless</h3>
                <p>We build and support orphanages, transitional homes and safe spaces for children and families who have nowhere to go.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🍽️</div>
                <h3>Feed the Hungry</h3>
                <p>Through soup kitchens and food distribution programmes, we ensure that no one in our communities goes to bed hungry.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">📚</div>
                <h3>Educate the Young</h3>
                <p>We sponsor school fees, uniforms, books and supplies — empowering children through education to break the cycle of poverty.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">👴</div>
                <h3>Care for the Elderly</h3>
                <p>We organise volunteer teams to care for elderly and handicapped individuals abandoned in rural Cameroonian communities.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">🌍</div>
                <h3>Advocate for the Poor</h3>
                <p>We speak up for those whose voices are not heard — fighting against systems that deny human dignity and basic rights.</p>
            </div>
            <div class="program-card">
                <div class="program-card-icon">⛪</div>
                <h3>Spiritual Formation</h3>
                <p>Rooted in faith, we nurture the spiritual lives of those we serve, building small chapels and offering pastoral accompaniment.</p>
            </div>
        </div>
    </div>
</section>

<!-- Vision -->
<section class="section section-light">
    <div class="container">
        <div class="section-split reverse">
            <div class="section-split-visual">
                <div class="mission-vision-card">
                    <h3>Our Vision</h3>
                    <p>A world where every person — regardless of circumstance — has access to food, shelter, education, and the experience of being loved.</p>
                    <h3 style="margin-top:1.5rem;">Our Values</h3>
                    <ul class="mission-values-list">
                        <li>✝ Faith — grounded in the Gospel of Jesus Christ</li>
                        <li>❤ Mercy — meeting every person with compassion</li>
                        <li>🌿 Dignity — honouring the worth of every human life</li>
                        <li>🤝 Community — working together with and for the poor</li>
                        <li>🕊 Justice — advocating for those denied their rights</li>
                    </ul>
                </div>
            </div>
            <div class="section-split-text">
                <span class="section-eyebrow">Where We're Headed</span>
                <h2>Expanding Our Reach, Deepening Our Impact</h2>
                <p>We envision a world where the disadvantaged are able to reach their highest potential in keeping with their human dignity. Every programme, every donation, every volunteer hour moves us closer to that vision.</p>
                <p>We are actively growing our work in Cameroon, South Africa, Kenya and Tanzania — and we invite you to be part of the story.</p>
                <div style="margin-top:2rem;">
                    <a href="/contact.php" class="btn btn-primary">Partner With Us</a>
                    <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-outline" style="margin-left:1rem;">Donate</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="impact-banner">
    <div class="container impact-inner">
        <div class="impact-text">
            <h2>Be a Witness to Mercy</h2>
            <p>Every act of generosity fulfils the mission. Join us in bringing hope, sharing love, and changing lives.</p>
        </div>
        <a href="<?= h(get_setting('donate_url','#')) ?>" target="_blank" rel="noopener" class="btn btn-white">Give Today</a>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
