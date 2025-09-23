<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2012 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile CAPTCHA Plugin for e107
 */

if (!defined('e107_INIT')) { exit; }

/**
 * Configuración de URLs para el plugin Turnstile
 * Este archivo define las rutas y configuraciones de URL para el plugin
 */

// No se necesitan URLs personalizadas para este plugin ya que es un sistema de CAPTCHA
// que se integra con los formularios existentes de e107
$e_plugin['turnstile'] = array(
    'name'        => 'Turnstile CAPTCHA',
    'version'     => '1.0.0',
    'author'      => 'Tu Nombre',
    'url'         => 'https://tusitio.com',
    'compatible'  => '2.3.0+',
    'description' => 'Integración de Cloudflare Turnstile CAPTCHA para e107',
    'icon'        => 'fa-shield-alt',
    'category'    => 'security',
    'prefs'       => array(
        'turnstile_prefs' => array(
            'title'       => 'Preferencias de Turnstile',
            'description' => 'Configuración del plugin Turnstile CAPTCHA',
            'type'        => 'main',
            'permission'  => 'P',
            'data'        => 'array',
        ),
    ),
);

// No se definen rutas personalizadas ya que el plugin se integra con las existentes
// de e107 a través de los hooks y sobreescritura de métodos

// Fin del archivo
