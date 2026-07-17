<?php
$page_title = 'Contact Us';
$meta_desc  = 'Get in touch with Divine Mercy Foundation. We would love to hear from you.';
require_once 'includes/header.php';
require_once 'includes/functions.php';

session_name(ADMIN_SESSION_NAME);
session_start();

$success = false;
$errors  = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $errors[] = 'Invalid form submission. Please try again.';
    } else {
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');

        if (!$name)                       $errors[] = 'Please enter your name.';
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';
        if (!$message)                    $errors[] = 'Please enter your message.';

        if (!$errors) {
            $pdo = get_db();
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            $success = true;
        }
    }
}
?>

<section class="page-hero">
    <div class="container">
        <div class="breadcrumb"><a href="/index.php">Home</a> <span>/</span> Contact</div>
        <h1>Contact Us</h1>
        <p>We'd love to hear from you — whether you want to volunteer, partner with us, or simply learn more.</p>
    </div>
</section>

<section class="section section-white">
    <div class="container contact-layout">

        <!-- Info column -->
        <div class="contact-info">
            <h2>Get In Touch</h2>
            <p>Have a question, want to volunteer, or interested in partnering with us? Reach out — we read every message.</p>

            <div class="contact-cards">
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <div>
                        <strong>Email</strong>
                        <a href="mailto:<?= h(get_setting('site_email')) ?>"><?= h(get_setting('site_email')) ?></a>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </div>
                    <div>
                        <strong>Headquarters</strong>
                        <span>Texas, USA (Registered Nonprofit)</span>
                    </div>
                </div>
                <div class="contact-card">
                    <div class="contact-card-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <div>
                        <strong>Response Time</strong>
                        <span>Within 2–3 business days</span>
                    </div>
                </div>
            </div>

            <div class="contact-regions">
                <h3>Active Regions</h3>
                <div class="region-list">
                    <span class="region-tag">🇨🇲 Yaoundé, Cameroon</span>
                    <span class="region-tag">🇿🇦 Durban, South Africa</span>
                    <span class="region-tag">🇰🇪 Kenya</span>
                    <span class="region-tag">🇹🇿 Tanzania</span>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="contact-form-wrap">
            <?php if ($success): ?>
            <div class="form-success">
                <div class="form-success-icon">✓</div>
                <h3>Message Sent!</h3>
                <p>Thank you for reaching out. We'll get back to you within 2–3 business days.</p>
                <a href="/contact.php" class="btn btn-primary" style="margin-top:1.5rem;">Send Another</a>
            </div>
            <?php else: ?>
            <?php if ($errors): ?>
            <div class="alert alert-error">
                <?php foreach ($errors as $e): ?><p><?= h($e) ?></p><?php endforeach; ?>
            </div>
            <?php endif; ?>
            <form method="post" action="/contact.php" class="contact-form">
                <?= csrf_field() ?>
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" value="<?= h($_POST['name'] ?? '') ?>" required placeholder="Your full name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" value="<?= h($_POST['email'] ?? '') ?>" required placeholder="your@email.com">
                    </div>
                </div>
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" value="<?= h($_POST['subject'] ?? '') ?>" placeholder="How can we help?">
                </div>
                <div class="form-group">
                    <label for="message">Message <span class="required">*</span></label>
                    <textarea id="message" name="message" rows="6" required placeholder="Your message..."><?= h($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-full">Send Message</button>
            </form>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
