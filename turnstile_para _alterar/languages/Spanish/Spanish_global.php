<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Spanish Language File (Global)
 *
 */

// Plugin Information
define('LAN_PLUGIN_TURNSTILE_NAME', 'Turnstile CAPTCHA');
define('LAN_PLUGIN_TURNSTILE_DIZ', 'Integración de Cloudflare Turnstile CAPTCHA para e107');
define('LAN_PLUGIN_TURNSTILE_DESCRIPTION', 'Reemplaza el CAPTCHA predeterminado de e107 con Cloudflare Turnstile para una mejor experiencia de usuario y seguridad.');

// Frontend Messages
define('LAN_TURNSTILE_INVALID_DEFAULT', 'La validación del CAPTCHA falló. Por favor, inténtelo de nuevo.');
define('LAN_TURNSTILE_LOADING', 'Cargando CAPTCHA...');
define('LAN_TURNSTILE_ERROR_GENERIC', 'Ocurrió un error al verificar el CAPTCHA. Por favor, actualice la página e inténtelo de nuevo.');
define('LAN_TURNSTILE_EXPIRED', 'El CAPTCHA ha expirado. Por favor, complételo de nuevo.');
define('LAN_TURNSTILE_REQUIRED', 'Por favor, complete la verificación del CAPTCHA.');

// Configuration Messages
define('LAN_TURNSTILE_CONFIG_SAVED', 'Configuración de Turnstile guardada exitosamente.');
define('LAN_TURNSTILE_CONFIG_ERROR', 'Error al guardar la configuración de Turnstile.');
define('LAN_TURNSTILE_KEYS_REQUIRED', 'Se requieren tanto la Clave del Sitio como la Clave Secreta.');
define('LAN_TURNSTILE_INVALID_KEYS', 'Formato de clave inválido. Por favor, verifique sus claves de Turnstile.');

// Security Messages
define('LAN_TURNSTILE_SECURITY_VIOLATION', 'Violación de seguridad detectada.');
define('LAN_TURNSTILE_RATE_LIMIT', 'Demasiados intentos. Por favor, espere antes de intentar de nuevo.');
define('LAN_TURNSTILE_IP_BLOCKED', 'Su dirección IP ha sido bloqueada temporalmente debido a actividad sospechosa.');

// Status Messages
define('LAN_TURNSTILE_ENABLED', 'Turnstile CAPTCHA está habilitado');
define('LAN_TURNSTILE_DISABLED', 'Turnstile CAPTCHA está deshabilitado');
define('LAN_TURNSTILE_NOT_CONFIGURED', 'Turnstile CAPTCHA no está configurado correctamente');

?>