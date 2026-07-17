<?php
/**
 * Divine Mercy Foundation - Configuration
 * EDIT these values for your server before uploading.
 *
 * PREVIEW MODE: if the env var PREVIEW_MODE=1 is set, SQLite is used automatically.
 */

// ============================================================
// Preview / Production switch
// ============================================================
$preview = (getenv('PREVIEW_MODE') === '1');

if ($preview) {
    define('DB_DRIVER',  'sqlite');
    define('DB_PATH',    __DIR__ . '/preview.db');
    // MySQL fields (unused in preview, kept so nothing breaks)
    define('DB_HOST',    '');
    define('DB_NAME',    '');
    define('DB_USER',    '');
    define('DB_PASS',    '');
    define('DB_CHARSET', 'utf8');
} else {
    // ============================================================
    // Database configuration — UPDATE THESE
    // ============================================================
    define('DB_DRIVER',  'mysql');
    define('DB_HOST',    'localhost');
    define('DB_NAME',    'divine_mercy_db');
    define('DB_USER',    'your_db_username');   // ← change this
    define('DB_PASS',    'your_db_password');   // ← change this
    define('DB_CHARSET', 'utf8mb4');
    define('DB_PATH',    '');
}

// ============================================================
// Site configuration
// ============================================================
define('SITE_URL',    $preview ? '' : 'https://yourdomain.com'); // ← change this (no trailing slash)
define('UPLOADS_DIR', __DIR__ . '/uploads/');
define('UPLOADS_URL', SITE_URL . '/uploads/');

// ============================================================
// Session security
// ============================================================
define('ADMIN_SESSION_NAME', 'dmf_admin_sess');
define('SESSION_LIFETIME',   7200); // 2 hours

// ============================================================
// Error reporting (set to 0 in production)
// ============================================================
error_reporting(E_ALL);
ini_set('display_errors', 1); // set to 0 in production

// ============================================================
// Timezone
// ============================================================
date_default_timezone_set('America/Chicago');
