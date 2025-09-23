<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2012 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Preload Handler
 * Maneja la carga condicional de recursos de Cloudflare Turnstile
 */

if (!defined('e107_INIT')) { exit; }

class turnstile_preload
{
    /**
     * Determina si se debe precargar el script de Turnstile
     * @return bool
     */
    public static function shouldPreload()
    {
        // No precargar en páginas de administración
        if (strpos(e_SELF, e_ADMIN) !== false) {
            return false;
        }
        
        // No precargar si el plugin no está activo
        if (!e107::pref('turnstile', 'active')) {
            return false;
        }
        
        // No precargar si no hay site key configurado
        if (!e107::pref('turnstile', 'sitekey')) {
            return false;
        }
        
        // Precargar solo en páginas con formularios de login
        $currentPage = basename(e_SELF);
        $loginPages = array('login.php', 'signup.php', 'fpw.php', 'contact.php');
        
        if (in_array($currentPage, $loginPages)) {
            return true;
        }
        
        // Verificar si hay formularios en la página actual
        if (isset($_POST) && !empty($_POST)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * Genera el preload link apropiado
     * @return string
     */
    public static function generatePreloadLink()
    {
        if (!self::shouldPreload()) {
            return '';
        }
        
        return '<link rel="preload" href="https://challenges.cloudflare.com/turnstile/v0/api.js" as="script" crossorigin="anonymous">';
    }
    
    /**
     * Optimiza la carga del script según el contexto
     * @return array
     */
    public static function getLoadingStrategy()
    {
        $strategy = array(
            'preload' => false,
            'async' => false,
            'defer' => true,
            'conditional' => true
        );
        
        // En páginas de login, usar preload
        $currentPage = basename(e_SELF);
        if (in_array($currentPage, array('login.php', 'signup.php'))) {
            $strategy['preload'] = true;
            $strategy['async'] = true;
        }
        
        return $strategy;
    }
}