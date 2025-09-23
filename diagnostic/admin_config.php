<?php
require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }

require_once(e_PLUGIN."diagnostic/diagnostic_ui.php"); // 👈 Incluye el controlador

class diagnostic_dispatcher extends e_admin_dispatcher
{
    protected $modes = [
        'main' => [
            'controller' => 'diagnostic_ui',
            'path'       => null,
            'ui'         => null,
            'name'       => 'Vista'
        ]
    ];

    protected $adminMenu = [
        'main/panel' => [
            'caption' => 'Diagnóstico',
            'perm'    => 'P',
            'url'     => 'admin_config.php?mode=main'
        ]
    ];

    protected $menuTitle = 'Diagnóstico';
}

