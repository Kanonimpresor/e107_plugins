<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - English Language File (Global)
 *
 */

// Plugin Information
define('LAN_PLUGIN_TURNSTILE_NAME', 'Turnstile CAPTCHA');
define('LAN_PLUGIN_TURNSTILE_DIZ', 'Cloudflare Turnstile CAPTCHA integration for e107');
define('LAN_PLUGIN_TURNSTILE_DESCRIPTION', 'Replaces the default e107 CAPTCHA with Cloudflare Turnstile for better user experience and security.');

// Frontend Messages
define('LAN_TURNSTILE_INVALID_DEFAULT', 'CAPTCHA validation failed. Please try again.');
define('LAN_TURNSTILE_LOADING', 'Loading CAPTCHA...');
define('LAN_TURNSTILE_ERROR_GENERIC', 'An error occurred while verifying the CAPTCHA. Please refresh the page and try again.');
define('LAN_TURNSTILE_EXPIRED', 'CAPTCHA has expired. Please complete it again.');
define('LAN_TURNSTILE_REQUIRED', 'Please complete the CAPTCHA verification.');

// Configuration Messages
define('LAN_TURNSTILE_CONFIG_SAVED', 'Turnstile configuration saved successfully.');
define('LAN_TURNSTILE_CONFIG_ERROR', 'Error saving Turnstile configuration.');
define('LAN_TURNSTILE_KEYS_REQUIRED', 'Both Site Key and Secret Key are required.');
define('LAN_TURNSTILE_INVALID_KEYS', 'Invalid key format. Please check your Turnstile keys.');

// Security Messages
define('LAN_TURNSTILE_SECURITY_VIOLATION', 'Security violation detected.');
define('LAN_TURNSTILE_RATE_LIMIT', 'Too many attempts. Please wait before trying again.');
define('LAN_TURNSTILE_IP_BLOCKED', 'Your IP address has been temporarily blocked due to suspicious activity.');

// Status Messages
define('LAN_TURNSTILE_ENABLED', 'Turnstile CAPTCHA is enabled');
define('LAN_TURNSTILE_DISABLED', 'Turnstile CAPTCHA is disabled');
define('LAN_TURNSTILE_NOT_CONFIGURED', 'Turnstile CAPTCHA is not properly configured');

?>