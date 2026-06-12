<?php
/**
 * Database Schema Migrations
 * Run this to update table structures for new features
 */

function runDbMigrations() {
    try {
        // Migration 1: Add team category field
        $result = execute("SHOW COLUMNS FROM team_members LIKE 'category'");
        if (empty($result)) {
            execute("ALTER TABLE team_members ADD COLUMN category TEXT DEFAULT 'management' AFTER is_leadership");
        }
    } catch (\Throwable $e) {
        // Column might already exist or SQLite (which doesn't support ALTER)
    }

    try {
        // Migration 2: Seed company_name + developer attribution if not exist
        $check = queryOne("SELECT id FROM site_settings WHERE setting_key=?", ['company_name']);
        if (!$check) {
            saveSetting('company_name', defined('SITE_NAME') ? SITE_NAME : 'Company');
            saveSetting('developed_by_name', defined('SITE_NAME') ? SITE_NAME : 'Company');
            saveSetting('developed_by_url', '');
        }
    } catch (\Throwable $e) {
        // site_settings might not be available
    }

    try {
        // Migration 3: Add client_code column to users table (signup flow)
        $result = query("SHOW COLUMNS FROM users LIKE 'client_code'");
        if (empty($result)) {
            execute("ALTER TABLE users ADD COLUMN client_code VARCHAR(50) NULL AFTER org_name");
        }
    } catch (\Throwable $e) { error_log('[db-migrations] ' . $e->getMessage()); }

}

// Auto-run on page load if needed (optional)
// Call this from config.php or run manually when needed
