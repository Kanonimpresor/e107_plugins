<?php
/**
 * Diagnostic Plugin - Configuration UI
 * Interfaz de configuración para el plugin diagnostic
 */

require_once("../../class2.php");
if (!defined('e107_INIT')) { exit; }

class diagnostic_config_ui extends e_admin_ui
{
    protected $pluginTitle = 'Diagnóstico';
    protected $pluginName  = 'diagnostic';
    protected $table       = ''; // No usamos tabla directa
    
    protected $prefs = [
        'diagnostic_enabled'   => [
            'title' => 'Activar diagnóstico', 
            'type' => 'boolean', 
            'data' => 'str', 
            'help' => 'Activa o desactiva el escaneo de plugins'
        ],
        'diagnostic_show_logs' => [
            'title' => 'Mostrar logs', 
            'type' => 'boolean', 
            'data' => 'str', 
            'help' => 'Muestra los logs de diagnóstico en el panel'
        ],
        'diagnostic_scan_interval' => [
            'title' => 'Intervalo de escaneo (minutos)', 
            'type' => 'number', 
            'data' => 'int', 
            'help' => 'Frecuencia de escaneo automático en minutos (0 = desactivado)'
        ],
        'diagnostic_email_alerts' => [
            'title' => 'Alertas por email', 
            'type' => 'boolean', 
            'data' => 'str', 
            'help' => 'Enviar alertas por email cuando se detecten problemas'
        ]
    ];

    protected $fields = [
        'diagnostic_enabled'   => [
            'title' => 'Activar diagnóstico', 
            'type' => 'boolean', 
            'data' => 'str'
        ],
        'diagnostic_show_logs' => [
            'title' => 'Mostrar logs', 
            'type' => 'boolean', 
            'data' => 'str'
        ],
        'diagnostic_scan_interval' => [
            'title' => 'Intervalo de escaneo (minutos)', 
            'type' => 'number', 
            'data' => 'int'
        ],
        'diagnostic_email_alerts' => [
            'title' => 'Alertas por email', 
            'type' => 'boolean', 
            'data' => 'str'
        ]
    ];

    protected $fieldpref = [
        'diagnostic_enabled', 
        'diagnostic_show_logs', 
        'diagnostic_scan_interval', 
        'diagnostic_email_alerts'
    ];

    public function init()
    {
        // Establecer valores por defecto si no existen
        $defaults = [
            'diagnostic_enabled' => '1',
            'diagnostic_show_logs' => '1',
            'diagnostic_scan_interval' => '60',
            'diagnostic_email_alerts' => '0'
        ];

        foreach ($defaults as $pref => $value) {
            if (e107::getPref($pref) === null) {
                e107::getConfig()->set($pref, $value);
            }
        }
    }

    public function beforeCreate($new_data, $old_data)
    {
        // Validaciones antes de guardar
        if (isset($new_data['diagnostic_scan_interval']) && $new_data['diagnostic_scan_interval'] < 0) {
            $new_data['diagnostic_scan_interval'] = 0;
        }
        
        return $new_data;
    }

    public function afterUpdate($new_data, $old_data, $id)
    {
        // Acciones después de actualizar la configuración
        e107::getMessage()->addSuccess('Configuración actualizada correctamente');
        
        // Si se desactivó el diagnóstico, limpiar logs si es necesario
        if (isset($new_data['diagnostic_enabled']) && $new_data['diagnostic_enabled'] == '0') {
            // Aquí podrías agregar lógica para limpiar logs o detener procesos
        }
    }
}