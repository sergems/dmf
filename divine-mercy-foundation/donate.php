<?php
$page_title = 'Donate';
$meta_desc  = 'Donate to Divine Mercy Foundation and help us provide education, protection, and hope to vulnerable children in Africa.';
require_once 'includes/header.php';
$donate_url = get_setting('donate_url', '#');
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Donate</div>
        <h1>Give Hope. Change a Life.</h1>
        <p>Your donation directly supports education, protection, and hope for vulnerable children in Cameroon, South Africa, Kenya, and Tanzania.</p>
    </div>
</section>

<section class="section section-white section-center">
    <div class="container" style="max-width:700px">
        <span class="section-eyebrow">Make a Donation</span>
        <h2>Every Contribution Matters</h2>
        <p class="lead">Whether you give once or set up a recurring gift, your generosity keeps our work going. All donations are tax deductible to the extent allowed by law (501(c)(3)).</p>

        <div class="impact-amounts">
            <div class="impact-amount"><strong>$25</strong><span>Provides school supplies for one child for a term</span></div>
            <div class="impact-amount"><strong>$50</strong><span>Covers one month of school fees for a child in Cameroon</span></div>
            <div class="impact-amount"><strong>$100</strong><span>Sponsors a child's full academic term</span></div>
            <div class="impact-amount"><strong>$500</strong><span>Sponsors a full year of education for one child</span></div>
        </div>

        <!-- Mobile Money (Cameroon) -->
        <div style="background:#f8f5f5;border-radius:12px;padding:1.75rem;margin-bottom:2rem;text-align:left;">
            <h3 style="font-size:1.1rem;margin-bottom:1.25rem;text-align:center;">Mobile Donations (Cameroon)</h3>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="background:#fff;border-radius:10px;padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 2px 8px rgba(0,0,0,.07);">
                    <div style="background:#ff6600;border-radius:8px;width:48px;height:48px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="white"><path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">Orange Money</div>
                        <div style="font-size:1.35rem;font-weight:700;color:#ff6600;letter-spacing:.03em;">658 783 814</div>
                    </div>
                </div>
                <div style="background:#fff;border-radius:10px;padding:1.25rem;display:flex;align-items:center;gap:1rem;box-shadow:0 2px 8px rgba(0,0,0,.07);">
                    <div style="background:#ffcc00;border-radius:8px;width:48px;height:48px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="#333"><path d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>
                    </div>
                    <div>
                        <div style="font-size:.75rem;color:#888;font-weight:600;text-transform:uppercase;letter-spacing:.05em;">MTN Mobile Money</div>
                        <div style="font-size:1.35rem;font-weight:700;color:#333;letter-spacing:.03em;">679 141 601</div>
                    </div>
                </div>
            </div>
            <p style="font-size:.82rem;color:#888;margin-top:1rem;text-align:center;">Send via Orange Money or MTN MoMo — please include your name as reference.</p>
        </div>

        <div style="text-align:center;margin-bottom:1rem;font-size:.9rem;color:#888;font-weight:600;letter-spacing:.04em;text-transform:uppercase;">or donate online</div>

        <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-primary btn-lg donate-cta-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"/></svg>
            Donate Securely Now
        </a>
        <p style="font-size:.875rem;color:#666;margin-top:1rem;">Powered by Stripe — your payment is secure and encrypted.</p>

        <div class="donate-trust">
            <div class="trust-item">🏛️ <strong>501(c)(3) Nonprofit</strong> — Tax deductible donations</div>
            <div class="trust-item">🔒 <strong>Secure</strong> — Payments processed by Stripe</div>
            <div class="trust-item">💯 <strong>100% to mission</strong> — Your gift goes directly to children</div>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
