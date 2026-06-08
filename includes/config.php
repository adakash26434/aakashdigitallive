<?php
// ══════════════════════════════════════════════════════════════
// Site Configuration for cPanel Hosting
// IMPORTANT: Edit DB_HOST / DB_NAME / DB_USER / DB_PASS / SITE_URL below.
// ══════════════════════════════════════════════════════════════

// ── Auto-load local dev config (optional) ────────────────
// Place a local-only `dev-config.php` next to this file to override
// DB credentials (and other settings) during development. This file
// is NOT tracked by default and avoids committing secrets to git.
if (file_exists(__DIR__ . '/dev-config.php')) {
    require_once __DIR__ . '/dev-config.php';
}

// ── Database (fill in your cPanel MySQL details) ──────────────
// DB_PASS must be set in dev-config.php (local) or directly here for production.
// Never commit your real password to git.
if (!defined('DB_HOST'))    define('DB_HOST',    'localhost');
if (!defined('DB_NAME'))    define('DB_NAME',    'your_database_name');
if (!defined('DB_USER'))    define('DB_USER',    'your_database_user');
if (!defined('DB_PASS'))    define('DB_PASS',    '');          // <-- set your real password here on the server
if (!defined('DB_CHARSET')) define('DB_CHARSET', 'utf8mb4');

// ── Site URL (no trailing slash) ──────────────────────────────
// Root install:      define('SITE_URL', 'https://yourdomain.com');
// Subfolder install: define('SITE_URL', 'https://yourdomain.com/sahakari');
if (!defined('SITE_URL')) define('SITE_URL', 'https://example.com');

// ── Site Identity ─────────────────────────────────────────────
define('SITE_NAME', 'Company');

// ── File Uploads ──────────────────────────────────────────────
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
if (!defined('UPLOAD_URL')) define('UPLOAD_URL', SITE_URL . '/uploads/');

// ── Session Security ──────────────────────────────────────────
// OPTION A (Recommended): Set APP_SECRET in cPanel → PHP Env Vars
// OPTION B (Simple):      Set APP_SECRET_KEY directly below (line marked ★)
//
// To generate a strong key, run in terminal:
//   php -r "echo bin2hex(random_bytes(32));"
// OR use any 40+ character random string.
//
// ★ PASTE YOUR KEY HERE (replace the empty string):
define('APP_SECRET_KEY', '');   // <-- paste your key between the quotes

if (!defined('SESSION_SECRET')) {
    // Try environment variable first (cPanel PHP Env Vars)
    $__appSecret = getenv('APP_SECRET');

    // Fallback to the hardcoded key above
    if (!$__appSecret && defined('APP_SECRET_KEY') && APP_SECRET_KEY !== '') {
        $__appSecret = APP_SECRET_KEY;
    }

    if (!$__appSecret) {
        error_log('[config.php] FATAL: APP_SECRET is not configured. Set APP_SECRET_KEY in config.php or APP_SECRET in cPanel PHP Env Vars.');
        http_response_code(500);
        echo '<!DOCTYPE html><html><head><meta charset="utf-8"><title>Setup Required</title>
        <style>body{font-family:sans-serif;max-width:600px;margin:4rem auto;padding:1rem;background:#f8fafc;}
        h2{color:#dc2626;}code{background:#f1f5f9;padding:.2em .5em;border-radius:.25em;font-size:.9em;}
        .box{background:#fff;border:1px solid #e2e8f0;border-radius:.5em;padding:1.5rem;margin-top:1rem;}
        </style></head><body>
        <h2>⚙️ Setup Required: APP_SECRET not configured</h2>
        <div class="box">
        <p><strong>Fix (easiest):</strong> Open <code>includes/config.php</code> and paste your key on the line with <code>APP_SECRET_KEY</code>.</p>
        <p><strong>Your generated key (copy this):</strong><br>
        <code>' . bin2hex(random_bytes(32)) . '</code></p>
        <p style="font-size:.85em;color:#64748b;">Or set <code>APP_SECRET</code> as a PHP Environment Variable in cPanel.</p>
        </div></body></html>';
        exit;
    }
    define('SESSION_SECRET', $__appSecret);
    unset($__appSecret);
}

// ── Production safety ─────────────────────────────────────────
// Suppress error output in production; errors go to server error_log only.
if (getenv('APP_ENV') !== 'development') {
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
    ini_set('log_errors', '1');
}

// ── PHP Settings ──────────────────────────────────────────────
ini_set('session.cookie_httponly', 1);
ini_set('session.use_strict_mode', 1);
date_default_timezone_set('Asia/Kathmandu');

// Start session early (lang.php needs it)
if (session_status() === PHP_SESSION_NONE) {
    $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
             || ($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https'
             || ($_SERVER['SERVER_PORT'] ?? 80) == 443;
    session_set_cookie_params([
        'lifetime' => 86400 * 7,
        'path'     => '/',
        'httponly' => true,
        'secure'   => $isHttps,
        'samesite' => 'Lax',
    ]);
    session_start();
}

// Auto-load language helpers so isNepali(), __() and cms() work everywhere
// (must come after session_start so lang detection can read $_SESSION['lang'])
require_once __DIR__ . '/lang.php';
