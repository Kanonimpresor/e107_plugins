<?php
/**
 * Diagnóstico de Turnstile para Producción
 * Script independiente para identificar problemas de configuración
 */

// Configuración básica
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar si estamos en e107
if (file_exists('./class2.php')) {
    require_once('./class2.php');
    $e107_loaded = true;
} else {
    $e107_loaded = false;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnóstico Turnstile - Producción</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .error { background: #ffebee; border-left: 4px solid #f44336; padding: 10px; margin: 10px 0; }
        .warning { background: #fff3e0; border-left: 4px solid #ff9800; padding: 10px; margin: 10px 0; }
        .success { background: #e8f5e8; border-left: 4px solid #4caf50; padding: 10px; margin: 10px 0; }
        .info { background: #e3f2fd; border-left: 4px solid #2196f3; padding: 10px; margin: 10px 0; }
        .section { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        h1, h2 { color: #333; }
        pre { background: #f8f8f8; padding: 10px; border-radius: 4px; overflow-x: auto; }
        .test-result { margin: 10px 0; padding: 8px; border-radius: 4px; }
        .pass { background: #d4edda; color: #155724; }
        .fail { background: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Diagnóstico Turnstile - Producción</h1>
        
        <?php
        require_once(__DIR__ . '/e107_plugins/turnstile/e_cloudflare_zone.php');
        
        // Información del servidor
        echo "<div class='section'>";
        echo "<h2>📊 Información del Servidor</h2>";
        echo "<div class='info'>";
        echo "<strong>Dominio:</strong> " . ($_SERVER['HTTP_HOST'] ?? 'No detectado') . "<br>";
        echo "<strong>IP del Servidor:</strong> " . ($_SERVER['SERVER_ADDR'] ?? 'No detectado') . "<br>";
        echo "<strong>User Agent:</strong> " . ($_SERVER['HTTP_USER_AGENT'] ?? 'No detectado') . "<br>";
        echo "<strong>Protocolo:</strong> " . (isset($_SERVER['HTTPS']) ? 'HTTPS' : 'HTTP') . "<br>";
        echo "</div>";
        echo "</div>";
        
        // Detección de zona Cloudflare (mejorada)
        echo "<div class='section'>";
        echo "<h2>☁️ Detección de Zona Cloudflare</h2>";
        $zoneReport = turnstile_cloudflare_zone::generateReport();
        
        echo "<p><strong>¿Es zona de Cloudflare?:</strong> " . ($zoneReport['is_cloudflare_zone'] ? 'SÍ' : 'NO') . "</p>";
        
        if (!empty($zoneReport['cloudflare_headers'])) {
            echo "<h3>Headers de Cloudflare detectados:</h3>";
            echo "<ul>";
            foreach ($zoneReport['cloudflare_headers'] as $header => $value) {
                echo "<li><strong>$header:</strong> $value</li>";
            }
            echo "</ul>";
        } else {
            echo "<p><em>No se detectaron headers de Cloudflare</em></p>";
        }
        
        // Recomendaciones específicas
        if (!empty($zoneReport['recommendations'])) {
            echo "<h3>Recomendaciones:</h3>";
            echo "<ul>";
            foreach ($zoneReport['recommendations'] as $recommendation) {
                echo "<li>$recommendation</li>";
            }
            echo "</ul>";
        }
        
        if ($zoneReport['is_cloudflare_zone']) {
            echo "<div class='success'><strong>✅ ZONA CLOUDFLARE DETECTADA</strong><br>El sitio está correctamente configurado detrás de Cloudflare.</div>";
        } else {
            echo "<div class='error'><strong>❌ ZONA CLOUDFLARE NO DETECTADA</strong><br>Este es el problema principal. Turnstile requiere que el dominio esté gestionado por Cloudflare.</div>";
        }
        echo "</div>";
        
        // Verificar configuración de e107
        if ($e107_loaded) {
            echo "<div class='section'>";
            echo "<h2>⚙️ Configuración e107 Turnstile</h2>";
            
            try {
                $turnstile_active = e107::pref('turnstile', 'active');
                $turnstile_sitekey = e107::pref('turnstile', 'sitekey');
                $turnstile_secretkey = e107::pref('turnstile', 'secretkey');
                
                echo "<div class='test-result " . ($turnstile_active ? 'pass' : 'fail') . "'>";
                echo ($turnstile_active ? '✅' : '❌') . " Plugin Activo: " . ($turnstile_active ? 'SÍ' : 'NO');
                echo "</div>";
                
                echo "<div class='test-result " . (!empty($turnstile_sitekey) ? 'pass' : 'fail') . "'>";
                echo (!empty($turnstile_sitekey) ? '✅' : '❌') . " Site Key Configurado: " . (!empty($turnstile_sitekey) ? 'SÍ' : 'NO');
                if (!empty($turnstile_sitekey)) {
                    echo "<br><small>Site Key: " . substr($turnstile_sitekey, 0, 10) . "...</small>";
                }
                echo "</div>";
                
                echo "<div class='test-result " . (!empty($turnstile_secretkey) ? 'pass' : 'fail') . "'>";
                echo (!empty($turnstile_secretkey) ? '✅' : '❌') . " Secret Key Configurado: " . (!empty($turnstile_secretkey) ? 'SÍ' : 'NO');
                echo "</div>";
                
                // Validar formato de Site Key
                if (!empty($turnstile_sitekey)) {
                    $valid_format = preg_match('/^0x[a-fA-F0-9]{16}$/', $turnstile_sitekey);
                    echo "<div class='test-result " . ($valid_format ? 'pass' : 'fail') . "'>";
                    echo ($valid_format ? '✅' : '❌') . " Formato Site Key: " . ($valid_format ? 'VÁLIDO' : 'INVÁLIDO');
                    echo "</div>";
                }
                
            } catch (Exception $e) {
                echo "<div class='error'>Error al leer configuración: " . $e->getMessage() . "</div>";
            }
            echo "</div>";
        } else {
            echo "<div class='warning'>⚠️ No se pudo cargar e107. Ejecutar desde el directorio raíz del sitio.</div>";
        }
        
        // Test de conectividad
        echo "<div class='section'>";
        echo "<h2>🌐 Test de Conectividad</h2>";
        
        $start_time = microtime(true);
        $context = stream_context_create(array(
            'http' => array(
                'timeout' => 10,
                'method' => 'GET'
            )
        ));
        
        $response = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/api.js', false, $context);
        $response_time = round((microtime(true) - $start_time) * 1000, 2);
        
        if ($response !== false) {
            echo "<div class='test-result pass'>✅ API Turnstile: Accesible ({$response_time}ms)</div>";
        } else {
            echo "<div class='test-result fail'>❌ API Turnstile: No accesible</div>";
        }
        echo "</div>";
        
        // Recomendaciones
        echo "<div class='section'>";
        echo "<h2>💡 Recomendaciones</h2>";
        
        if (!$is_cloudflare) {
            echo "<div class='error'>";
            echo "<h3>🚨 PROBLEMA CRÍTICO: Dominio no está en Cloudflare</h3>";
            echo "<p><strong>Causa del error:</strong> 'Cannot determine Turnstile's embedded location'</p>";
            echo "<p><strong>Solución:</strong></p>";
            echo "<ol>";
            echo "<li>Ir a <a href='https://dash.cloudflare.com' target='_blank'>Cloudflare Dashboard</a></li>";
            echo "<li>Agregar el dominio como una nueva zona</li>";
            echo "<li>Cambiar los nameservers del dominio a los proporcionados por Cloudflare</li>";
            echo "<li>Esperar a que la zona esté activa (puede tomar hasta 24 horas)</li>";
            echo "<li>Configurar Turnstile en la sección Security > Turnstile</li>";
            echo "</ol>";
            echo "</div>";
        } else {
            echo "<div class='success'>";
            echo "<h3>✅ Zona Cloudflare Detectada</h3>";
            echo "<p>El dominio está correctamente configurado en Cloudflare.</p>";
            echo "</div>";
        }
        
        if ($e107_loaded && !empty($turnstile_sitekey)) {
            $domain = $_SERVER['HTTP_HOST'] ?? 'localhost';
            echo "<div class='info'>";
            echo "<h3>🔑 Verificación de Claves</h3>";
            echo "<p>Asegúrate de que las claves de Turnstile estén configuradas para el dominio: <strong>$domain</strong></p>";
            echo "<p>En Cloudflare Dashboard > Security > Turnstile, verifica que el dominio esté en la lista de dominios permitidos.</p>";
            echo "</div>";
        }
        
        echo "<div class='warning'>";
        echo "<h3>⚠️ Pasos Adicionales</h3>";
        echo "<ul>";
        echo "<li>Verificar que el dominio esté en la lista de dominios permitidos en Turnstile</li>";
        echo "<li>Confirmar que las claves no sean de test si estás en producción</li>";
        echo "<li>Revisar los logs de Cloudflare para errores específicos</li>";
        echo "<li>Probar con un dominio diferente si es necesario</li>";
        echo "</ul>";
        echo "</div>";
        echo "</div>";
        ?>
        
        <div class="section">
            <h2>🔄 Actualizar Diagnóstico</h2>
            <button onclick="location.reload()" style="padding: 10px 20px; background: #2196f3; color: white; border: none; border-radius: 4px; cursor: pointer;">
                Ejecutar Diagnóstico Nuevamente
            </button>
        </div>
    </div>
</body>
</html>