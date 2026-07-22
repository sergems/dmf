<?php
require_once 'includes/functions.php';
require_once 'config.php';
session_name(ADMIN_SESSION_NAME);
session_start();

$page_title = 'Contact Us';
$meta_desc  = 'Get in touch with Divine Mercy Foundation. We would love to hear from you.';
require_once 'includes/header.php';
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Contact</div>
        <h1>Contact Us</h1>
        <p>We'd love to hear from you — whether you want to volunteer, partner with us, or simply learn more.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container" style="max-width:860px;">
        <div class="section-header">
            <span class="section-eyebrow">Get In Touch</span>
            <h2>Reach Out to Us</h2>
            <p>Have a question, want to volunteer, or interested in partnering with us? Here's how to find us.</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:1.5rem;margin-top:2rem;">

            <!-- Email -->
            <div class="contact-card" style="flex-direction:column;align-items:flex-start;gap:.75rem;">
                <div class="contact-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                </div>
                <div>
                    <strong>Email</strong>
                    <a href="mailto:<?= h(get_setting('site_email')) ?>" style="display:block;margin-top:.25rem;"><?= h(get_setting('site_email')) ?></a>
                </div>
            </div>

            <!-- Phone -->
            <div class="contact-card" style="flex-direction:column;align-items:flex-start;gap:.75rem;">
                <div class="contact-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.49 12 19.79 19.79 0 011.42 3.39a2 2 0 012-2.18H6.4a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L7.53 9.09a16 16 0 006.29 6.29l1.07-1.07a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                </div>
                <div>
                    <strong>Phone</strong>
                    <a href="tel:+237656165627" style="display:block;margin-top:.25rem;">+237 656 165 627</a>
                    <a href="tel:+237678670126" style="display:block;">+237 678 670 126</a>
                    <a href="tel:+237695065969" style="display:block;">+237 695 065 969</a>
                </div>
            </div>

            <!-- Address -->
            <div class="contact-card" style="flex-direction:column;align-items:flex-start;gap:.75rem;">
                <div class="contact-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <div>
                    <strong>Address</strong>
                    <span style="display:block;margin-top:.25rem;">P.O. Box 14040</span>
                    <span style="display:block;">Assok | Nkoabang, Yaoundé</span>
                    <span style="display:block;">Cameroon</span>
                </div>
            </div>

        </div>

        <!-- Mobile Money -->
        <div style="margin-top:2.5rem;">
            <h3 style="font-size:1.1rem;margin-bottom:1.25rem;text-align:center;">Mobile Donations (Cameroon)</h3>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
                <div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 2px 8px rgba(0,0,0,.06);">
                    <img src="/assets/images/orange-money.svg" alt="Orange Money" style="width:80px;height:40px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div style="font-size:.75rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Orange Money</div>
                        <div style="font-size:1.3rem;font-weight:700;color:#ff6600;">658 783 814</div>
                    </div>
                </div>
                <div style="background:#fff;border:1px solid #eee;border-radius:12px;padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 2px 8px rgba(0,0,0,.06);">
                    <img src="/assets/images/mtn-momo.svg" alt="MTN Mobile Money" style="width:80px;height:40px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div style="font-size:.75rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">MTN Mobile Money</div>
                        <div style="font-size:1.3rem;font-weight:700;color:#1a1a1a;">679 141 601</div>
                    </div>
                </div>
            </div>
            <p style="font-size:.82rem;color:#888;margin-top:1rem;text-align:center;">Send via Orange Money or MTN MoMo — please include your name as reference.</p>
        </div>

        <!-- Active Regions -->
        <div class="contact-regions" style="margin-top:2.5rem;">
            <h3>Active Regions</h3>
            <div class="region-list">
                <span class="region-tag"><img src="https://flagcdn.com/w40/cm.png" alt="Cameroon flag" class="region-flag"> Yaoundé, Cameroon</span>
                <span class="region-tag"><img src="https://flagcdn.com/w40/za.png" alt="South Africa flag" class="region-flag"> Durban, South Africa</span>
                <span class="region-tag"><img src="https://flagcdn.com/w40/ke.png" alt="Kenya flag" class="region-flag"> Kenya</span>
                <span class="region-tag"><img src="https://flagcdn.com/w40/tz.png" alt="Tanzania flag" class="region-flag"> Tanzania</span>
            </div>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
