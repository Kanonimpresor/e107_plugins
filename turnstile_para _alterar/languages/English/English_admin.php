<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - English Language File (Admin)
 *
 */

// Admin Menu Items
define('LAN_TURNSTILE_ADMIN_MENU_MAIN', 'Turnstile Configuration');
define('LAN_TURNSTILE_ADMIN_MENU_CONFIG', 'Settings');
define('LAN_TURNSTILE_ADMIN_MENU_STATS', 'Statistics');
define('LAN_TURNSTILE_ADMIN_MENU_LOGS', 'Security Logs');

// Configuration Labels
define('LAN_TURNSTILE_ADMIN_ENABLE', 'Enable Turnstile');
define('LAN_TURNSTILE_ADMIN_ENABLE_HELP', 'Enable Cloudflare Turnstile CAPTCHA to replace the default e107 CAPTCHA system.');
define('LAN_TURNSTILE_ADMIN_SITEKEY', 'Site Key');
define('LAN_TURNSTILE_ADMIN_SITEKEY_HELP', 'Your Cloudflare Turnstile Site Key (public key).');
define('LAN_TURNSTILE_ADMIN_SECRETKEY', 'Secret Key');
define('LAN_TURNSTILE_ADMIN_SECRETKEY_HELP', 'Your Cloudflare Turnstile Secret Key (private key). Keep this secure!');
define('LAN_TURNSTILE_ADMIN_THEME', 'Theme');
define('LAN_TURNSTILE_ADMIN_THEME_HELP', 'Choose the visual theme for the Turnstile widget.');
define('LAN_TURNSTILE_ADMIN_SIZE', 'Size');
define('LAN_TURNSTILE_ADMIN_SIZE_HELP', 'Select the size of the Turnstile widget.');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS', 'Hide for Members');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS_HELP', 'Hide CAPTCHA for logged-in members.');

// Theme Options
define('LAN_TURNSTILE_THEME_LIGHT', 'Light');
define('LAN_TURNSTILE_THEME_DARK', 'Dark');
define('LAN_TURNSTILE_THEME_AUTO', 'Auto');

// Size Options
define('LAN_TURNSTILE_SIZE_NORMAL', 'Normal');
define('LAN_TURNSTILE_SIZE_COMPACT', 'Compact');

// Buttons
define('LAN_TURNSTILE_ADMIN_SAVE', 'Save Configuration');
define('LAN_TURNSTILE_ADMIN_RESET', 'Reset to Defaults');
define('LAN_TURNSTILE_ADMIN_TEST', 'Test Configuration');

// Status Messages
define('LAN_TURNSTILE_ADMIN_STATUS_OK', 'Configuration is valid and working properly.');
define('LAN_TURNSTILE_ADMIN_STATUS_ERROR', 'Configuration has errors that need to be fixed.');
define('LAN_TURNSTILE_ADMIN_STATUS_WARNING', 'Configuration is working but has warnings.');

// Statistics
define('LAN_TURNSTILE_STATS_TOTAL_VERIFICATIONS', 'Total Verifications');
define('LAN_TURNSTILE_STATS_SUCCESSFUL', 'Successful');
define('LAN_TURNSTILE_STATS_FAILED', 'Failed');
define('LAN_TURNSTILE_STATS_TODAY', 'Today');
define('LAN_TURNSTILE_STATS_THIS_WEEK', 'This Week');
define('LAN_TURNSTILE_STATS_THIS_MONTH', 'This Month');

// Help Text
define('LAN_TURNSTILE_ADMIN_HELP_KEYS', 'To get your Turnstile keys, visit the <a href="https://dash.cloudflare.com/" target="_blank">Cloudflare Dashboard</a> and create a new Turnstile site.');
define('LAN_TURNSTILE_ADMIN_HELP_SETUP', 'For detailed setup instructions, please refer to the plugin documentation.');

?>