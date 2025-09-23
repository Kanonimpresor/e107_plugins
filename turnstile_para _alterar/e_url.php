<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - URL Handler
 */

if (!defined('e107_INIT')) { exit; }

/**
 * URL handler for Turnstile plugin
 * This file is required by e107 core to prevent URL loading errors
 */
class turnstile_url
{
    /**
     * URL configuration array
     * Define URL patterns for the plugin (if any)
     */
    function config() 
    {
        $config = array();
        
        // No custom URLs needed for Turnstile plugin
        // This is just to satisfy e107's URL handler requirements
        
        return $config;
    }
}