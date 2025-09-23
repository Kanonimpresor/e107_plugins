<?php
$turnstileActive = e107::pref('turnstile', 'active');
$turnstileSiteKey = e107::pref('turnstile', 'sitekey');


// Verificar si el plugin está activo
if (e107::pref('turnstile', 'active') && !empty(e107::pref('turnstile', 'sitekey'))) {
    // Solo cargar el script si no se ha cargado ya
    if (!defined('TURNSTILE_SCRIPT_LOADED')) {
        define('TURNSTILE_SCRIPT_LOADED', true);
        e107::js("footer", "https://challenges.cloudflare.com/turnstile/v0/api.js?onload=onloadTurnstileCallback", null, 5);
    }
}
