<?php
$site_name  = get_setting('site_name', 'Divine Mercy Foundation');
$site_email = get_setting('site_email', 'divinemercyfoundation@gmail.com');
$site_phone = get_setting('site_phone', '');
$donate_url = get_setting('donate_url', '#');
$fb  = get_setting('facebook_url', '');
$ig  = get_setting('instagram_url', '');
$tw  = get_setting('twitter_url', '');
$yt  = get_setting('youtube_url', '');
?>
<footer class="site-footer">
    <!-- Donate CTA band -->
    <div class="footer-cta">
        <div class="container footer-cta-inner">
            <div class="footer-cta-text">
                <h2>Your gift changes a child's life forever.</h2>
                <p>Every donation — big or small — gives a vulnerable child access to education, safety, and hope.</p>
            </div>
            <a href="<?= h($donate_url) ?>" target="_blank" rel="noopener" class="btn btn-white btn-lg">Donate Now</a>
        </div>
    </div>

    <!-- Footer columns -->
    <div class="footer-main">
        <div class="container footer-grid">
            <!-- Brand -->
            <div class="footer-col footer-brand">
                <div class="footer-logo">
                    <img src="/assets/images/logo.png" alt="<?= h($site_name) ?>">
                    <div>
                        <strong>Divine Mercy</strong>
                        <span>Foundation</span>
                    </div>
                </div>
                <p>A faith-based nonprofit bringing hope, education, and opportunity to vulnerable children in Cameroon, South Africa, Kenya, and Tanzania.</p>
                <?php if ($fb || $ig || $tw || $yt): ?>
                <div class="social-links">
                    <?php if ($fb): ?><a href="<?= h($fb) ?>" target="_blank" rel="noopener" aria-label="Facebook"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg></a><?php endif; ?>
                    <?php if ($ig): ?><a href="<?= h($ig) ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="3"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg></a><?php endif; ?>
                    <?php if ($yt): ?><a href="<?= h($yt) ?>" target="_blank" rel="noopener" aria-label="YouTube"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 00-1.95 1.96A29 29 0 001 12a29 29 0 00.46 5.58A2.78 2.78 0 003.41 19.54C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58zM9.75 15.02V8.98L15.5 12l-5.75 3.02z"/></svg></a><?php endif; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="/index.php">Home</a></li>
                    <li><a href="/about.php">About Us</a></li>
                    <li><a href="/programs.php">Our Programs</a></li>
                    <li><a href="/activities.php">Activities &amp; News</a></li>
                    <li><a href="/contact.php">Contact Us</a></li>
                    <li><a href="<?= h($donate_url) ?>" target="_blank" rel="noopener">Donate</a></li>
                </ul>
            </div>

            <!-- Programs -->
            <div class="footer-col">
                <h3>Our Programs</h3>
                <ul>
                    <li><a href="/programs.php#education">Child Education</a></li>
                    <li><a href="/programs.php#protection">Child Protection</a></li>
                    <li><a href="/programs.php#health">Health &amp; Nutrition</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div class="footer-col">
                <h3>Contact Us</h3>
                <ul class="footer-contact-list">
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        <a href="mailto:<?= h($site_email) ?>"><?= h($site_email) ?></a>
                    </li>
                    <li style="align-items:flex-start;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-top:3px;flex-shrink:0;"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 014.49 12 19.79 19.79 0 011.42 3.39a2 2 0 012-2.18H6.4a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L7.53 9.09a16 16 0 006.29 6.29l1.07-1.07a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z"/></svg>
                        <span>
                            <a href="tel:+237656165627">+237 656 165 627</a><br>
                            <a href="tel:+237678670126">+237 678 670 126</a><br>
                            <a href="tel:+237695065969">+237 695 065 969</a>
                        </span>
                    </li>
                    <li style="align-items:center;">
                        <img src="/assets/images/orange-money.svg" alt="Orange Money" style="width:48px;height:24px;object-fit:contain;flex-shrink:0;">
                        <a href="tel:+237658783814">658 783 814</a>
                    </li>
                    <li style="align-items:center;">
                        <img src="/assets/images/mtn-momo.svg" alt="MTN Mobile Money" style="width:48px;height:24px;object-fit:contain;flex-shrink:0;">
                        <a href="tel:+237679141601">679 141 601</a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        Assok | Nkoabang, Yaoundé
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>&copy; <?= date('Y') ?> <?= h($site_name) ?>. All rights reserved. Registered 501(c)(3) Nonprofit.</p>
            <a href="/admin/login.php" class="footer-admin-link">Admin</a>
        </div>
    </div>
</footer>

<script src="/assets/js/main.js"></script>
</body>
</html>
