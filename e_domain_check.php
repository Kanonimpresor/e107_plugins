<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2012 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Domain and Cloudflare Zone Checker
 * Diagnóstico para problemas de configuración en producción
 */

if (!defined('e107_INIT')) { exit; }

class turnstile_domain_checker
{
    /**
     * Verifica si el dominio actual está configurado correctamente en Cloudflare
     * @return array
     */
    public static function checkDomainConfiguration() {
        require_once(__DIR__ . '/e_cloudflare_zone.php');
        
        // Usar la clase especializada para detección de zona
        $zoneInfo = turnstile_cloudflare_zone::detectCloudflareZone();
        
        $result = [
            'domain' => $zoneInfo['domain'],
            'is_cloudflare_zone' => $zoneInfo['is_cloudflare_zone'],
            'has_cf_headers' => !empty($zoneInfo['cf_ray']),
            'cf_ray' => $zoneInfo['cf_ray'],
            'recommendations' => $zoneInfo['recommendations']
        ];
        
        return $result;
    }
    
    /**
     * Obtiene el dominio actual
     * @return string
     */
    public static function getCurrentDomain()
    {
        $domain = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
        return $domain;
    }
    
    /**
     * Verifica si el sitio está detrás de Cloudflare
     * @return bool
     */
    public static function isCloudflareZone()
    {
        // Verificar headers de Cloudflare
        $cloudflareHeaders = array(
            'HTTP_CF_RAY',
            'HTTP_CF_CONNECTING_IP',
            'HTTP_CF_IPCOUNTRY',
            'HTTP_CF_VISITOR'
        );
        
        foreach ($cloudflareHeaders as $header) {
            if (isset($_SERVER[$header])) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Valida el formato del Site Key
     * @param string $siteKey
     * @return bool
     */
    public static function validateSiteKey($siteKey)
    {
        // Los Site Keys de Turnstile tienen un formato específico
        // Formato: 0x[16 caracteres hexadecimales]
        return preg_match('/^0x[a-fA-F0-9]{16}$/', $siteKey);
    }
    
    /**
     * Genera recomendaciones basadas en el diagnóstico
     * @param array $results
     * @return array
     */
    public static function generateRecommendations($results)
    {
        $recommendations = array();
        
        if (!$results['is_cloudflare_zone']) {
            $recommendations[] = 'CRÍTICO: El sitio no está configurado como zona de Cloudflare. Turnstile requiere que el dominio esté gestionado por Cloudflare.';
            $recommendations[] = 'Solución: Configurar el dominio en Cloudflare Dashboard y actualizar los nameservers.';
        }
        
        if (!$results['turnstile_configured']) {
            $recommendations[] = 'Configurar Site Key y Secret Key en el panel de administración del plugin.';
        }
        
        if (!$results['site_key_valid'] && $results['turnstile_configured']) {
            $recommendations[] = 'El Site Key no tiene el formato correcto. Verificar en Cloudflare Dashboard.';
        }
        
        if ($results['domain'] === 'localhost' || strpos($results['domain'], '127.0.0.1') !== false) {
            $recommendations[] = 'Detectado entorno local. Usar claves de test para desarrollo local.';
        }
        
        return $recommendations;
    }
    
    /**
     * Genera un reporte completo de diagnóstico
     * @return string
     */
    public static function generateDiagnosticReport()
    {
        $results = self::checkDomainConfiguration();
        
        $report = "=== DIAGNÓSTICO TURNSTILE ===\n";
        $report .= "Dominio: " . $results['domain'] . "\n";
        $report .= "Zona Cloudflare: " . ($results['is_cloudflare_zone'] ? 'SÍ' : 'NO') . "\n";
        $report .= "Turnstile Configurado: " . ($results['turnstile_configured'] ? 'SÍ' : 'NO') . "\n";
        $report .= "Site Key Válido: " . ($results['site_key_valid'] ? 'SÍ' : 'NO') . "\n";
        
        if (!empty($results['errors'])) {
            $report .= "\n=== ERRORES ===\n";
            foreach ($results['errors'] as $error) {
                $report .= "- " . $error . "\n";
            }
        }
        
        if (!empty($results['recommendations'])) {
            $report .= "\n=== RECOMENDACIONES ===\n";
            foreach ($results['recommendations'] as $recommendation) {
                $report .= "- " . $recommendation . "\n";
            }
        }
        
        return $report;
    }
    
    /**
     * Verifica la conectividad con Cloudflare Turnstile API
     * @return array
     */
    public static function testTurnstileConnectivity()
    {
        $results = array(
            'api_reachable' => false,
            'response_time' => 0,
            'error' => null
        );
        
        $start_time = microtime(true);
        
        // Intentar conectar con la API de Turnstile
        $context = stream_context_create(array(
            'http' => array(
                'timeout' => 10,
                'method' => 'GET'
            )
        ));
        
        $response = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/api.js', false, $context);
        
        $results['response_time'] = round((microtime(true) - $start_time) * 1000, 2);
        
        if ($response !== false) {
            $results['api_reachable'] = true;
        } else {
            $results['error'] = 'No se pudo conectar con la API de Turnstile';
        }
        
        return $results;
    }
}