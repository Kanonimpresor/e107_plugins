<?php
/**
 * Turnstile Plugin - Event Handler
 * 
 * This file handles events for the Turnstile CAPTCHA plugin
 * Intercepts login attempts to validate Turnstile CAPTCHA
 */

if (!defined('e107_INIT')) { exit; }

class turnstile_event
{
    /**
     * Event triggered before user login validation
     * This is where we validate the Turnstile CAPTCHA for admin login
     * 
     * @param array $data - contains username and other login data
     * @return mixed - false to abort login, true to continue
     */
    function preuserlogin($data)
    {
        // Only check Turnstile for admin login attempts
        if (!defined('e_ADMIN') || !e_ADMIN) {
            return true; // Allow non-admin logins to proceed normally
        }
        
        // Check if Turnstile plugin is enabled
        $turnstileEnabled = e107::pref('turnstile', 'active');
        if (!$turnstileEnabled) {
            return true; // Plugin disabled, allow login
        }
        
        // Check if we're in a POST request (actual login attempt)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return true; // Not a login attempt
        }
        
        // Check if this is an admin login form submission
        if (empty($_POST['authsubmit'])) {
            return true; // Not an admin login form
        }
        
        // Validate Turnstile CAPTCHA
        if (class_exists('e107turnstile')) {
            $turnstile = new e107turnstile();
            
            // Call verify with the required parameters (code, other)
            // For Turnstile, these parameters are not used but required by e107 interface
            $isValid = $turnstile->verify('', '');
            
            if (!$isValid) {
                // CAPTCHA validation failed
                e107::getMessage()->addError('CAPTCHA verification failed. Please try again.');
                e107::getLog()->add('TURNSTILE_LOGIN_FAIL', 'Admin login blocked - CAPTCHA verification failed for user: ' . $data, E_LOG_WARNING);
                return false; // Abort login
            }
            
            // CAPTCHA validation successful
            e107::getLog()->add('TURNSTILE_LOGIN_SUCCESS', 'Admin login CAPTCHA verified for user: ' . $data, E_LOG_INFORMATIVE);
        }
        
        return true; // Allow login to proceed
    }
    
    /**
     * Event triggered after successful user login
     * Log successful admin logins with Turnstile verification
     * 
     * @param array $data - user data
     */
    function user_login($data)
    {
        // Only log admin logins
        if (defined('e_ADMIN') && e_ADMIN && e107::pref('turnstile', 'enable')) {
            e107::getLog()->add('TURNSTILE_ADMIN_LOGIN', 'Admin login successful with Turnstile verification: ' . $data['user_name'], E_LOG_INFORMATIVE);
        }
    }
}