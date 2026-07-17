<?php
/**
 * Divine Mercy Foundation - Configuration
 * EDIT these values for your server before uploading.
 */

// ============================================================
// Database configuration — UPDATE THESE
// ============================================================
define('DB_HOST', 'localhost');
define('DB_NAME', 'divine_mercy_db');
define('DB_USER', 'your_db_username');   // ← change this
define('DB_PASS', 'your_db_password');   // ← change this
define('DB_CHARSET', 'utf8mb4');

// ============================================================
// Site configuration
// ============================================================
define('SITE_URL', 'https://yourdomain.com');   // ← change this (no trailing slash)
define('UPLOADS_DIR', __DIR__ . '/uploads/');
define('UPLOADS_URL', SITE_URL . '/uploads/');

// ============================================================
// Session security
// ============================================================
define('ADMIN_SESSION_NAME', 'dmf_admin_sess');
define('SESSION_LIFETIME', 7200); // 2 hours

// ============================================================
// Error reporting (set to 0 in production)
// ============================================================
error_reporting(E_ALL);
ini_set('display_errors', 1); // set to 0 in production

// ============================================================
// Timezone
// ============================================================
date_default_timezone_set('America/Chicago');
