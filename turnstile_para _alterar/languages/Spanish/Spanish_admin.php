<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Spanish Language File (Admin)
 *
 */

// Admin Menu Items
define('LAN_TURNSTILE_ADMIN_MENU_MAIN', 'Configuración de Turnstile');
define('LAN_TURNSTILE_ADMIN_MENU_CONFIG', 'Configuración');
define('LAN_TURNSTILE_ADMIN_MENU_STATS', 'Estadísticas');
define('LAN_TURNSTILE_ADMIN_MENU_LOGS', 'Registros de Seguridad');

// Configuration Labels
define('LAN_TURNSTILE_ADMIN_ENABLE', 'Habilitar Turnstile');
define('LAN_TURNSTILE_ADMIN_ENABLE_HELP', 'Habilitar Cloudflare Turnstile CAPTCHA para reemplazar el sistema CAPTCHA predeterminado de e107.');
define('LAN_TURNSTILE_ADMIN_SITEKEY', 'Clave del Sitio');
define('LAN_TURNSTILE_ADMIN_SITEKEY_HELP', 'Su Clave de Sitio de Cloudflare Turnstile (clave pública).');
define('LAN_TURNSTILE_ADMIN_SECRETKEY', 'Clave Secreta');
define('LAN_TURNSTILE_ADMIN_SECRETKEY_HELP', 'Su Clave Secreta de Cloudflare Turnstile (clave privada). ¡Manténgala segura!');
define('LAN_TURNSTILE_ADMIN_THEME', 'Tema');
define('LAN_TURNSTILE_ADMIN_THEME_HELP', 'Elija el tema visual para el widget de Turnstile.');
define('LAN_TURNSTILE_ADMIN_SIZE', 'Tamaño');
define('LAN_TURNSTILE_ADMIN_SIZE_HELP', 'Seleccione el tamaño del widget de Turnstile.');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS', 'Ocultar para Miembros');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS_HELP', 'Ocultar CAPTCHA para miembros conectados.');

// Theme Options
define('LAN_TURNSTILE_THEME_LIGHT', 'Claro');
define('LAN_TURNSTILE_THEME_DARK', 'Oscuro');
define('LAN_TURNSTILE_THEME_AUTO', 'Automático');

// Size Options
define('LAN_TURNSTILE_SIZE_NORMAL', 'Normal');
define('LAN_TURNSTILE_SIZE_COMPACT', 'Compacto');

// Buttons
define('LAN_TURNSTILE_ADMIN_SAVE', 'Guardar Configuración');
define('LAN_TURNSTILE_ADMIN_RESET', 'Restablecer a Valores Predeterminados');
define('LAN_TURNSTILE_ADMIN_TEST', 'Probar Configuración');

// Status Messages
define('LAN_TURNSTILE_ADMIN_STATUS_OK', 'La configuración es válida y funciona correctamente.');
define('LAN_TURNSTILE_ADMIN_STATUS_ERROR', 'La configuración tiene errores que necesitan ser corregidos.');
define('LAN_TURNSTILE_ADMIN_STATUS_WARNING', 'La configuración funciona pero tiene advertencias.');

// Statistics
define('LAN_TURNSTILE_STATS_TOTAL_VERIFICATIONS', 'Verificaciones Totales');
define('LAN_TURNSTILE_STATS_SUCCESSFUL', 'Exitosas');
define('LAN_TURNSTILE_STATS_FAILED', 'Fallidas');
define('LAN_TURNSTILE_STATS_TODAY', 'Hoy');
define('LAN_TURNSTILE_STATS_THIS_WEEK', 'Esta Semana');
define('LAN_TURNSTILE_STATS_THIS_MONTH', 'Este Mes');

// Help Text
define('LAN_TURNSTILE_ADMIN_HELP_KEYS', 'Para obtener sus claves de Turnstile, visite el <a href="https://dash.cloudflare.com/" target="_blank">Panel de Cloudflare</a> y cree un nuevo sitio Turnstile.');
define('LAN_TURNSTILE_ADMIN_HELP_SETUP', 'Para instrucciones detalladas de configuración, consulte la documentación del plugin.');

?>