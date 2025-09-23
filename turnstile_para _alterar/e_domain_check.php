<?php
/*
 * e107 website system
 * Turnstile Plugin - Domain and Cloudflare Zone Checker
 */

if (!defined('e107_INIT')) { exit; }

class turnstile_domain_checker
{
    public static function checkDomainConfiguration() {
        require_once(__DIR__ . '/e_cloudflare_zone.php');
        $zoneInfo = turnstile_cloudflare_zone::detectCloudflareZone();

        $turnstile_active = e107::pref('turnstile', 'active');
        $site_key = e107::pref('turnstile', 'sitekey');
        $site_key_valid = self::validateSiteKey($site_key);

        return [
            'domain' => $zoneInfo['domain'],
            'is_cloudflare_zone' => $zoneInfo['is_cloudflare_zone'],
            'has_cf_headers' => !empty($zoneInfo['cf_ray']),
            'cf_ray' => $zoneInfo['cf_ray'],
            'turnstile_configured' => $turnstile_active && !empty($site_key),
            'site_key_valid' => $site_key_valid,
            'recommendations' => $zoneInfo['recommendations']
        ];
    }

    public static function getCurrentDomain() {
        return $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
    }

    public static function isCloudflareZone() {
        $cloudflareHeaders = [
            'HTTP_CF_RAY',
            'HTTP_CF_CONNECTING_IP',
            'HTTP_CF_IPCOUNTRY',
            'HTTP_CF_VISITOR'
        ];
        foreach ($cloudflareHeaders as $header) {
            if (isset($_SERVER[$header])) return true;
        }
        return false;
    }

    public static function validateSiteKey($siteKey) {
        return preg_match('/^0x[a-zA-Z0-9]{20,}$/', $siteKey);
    }

    public static function generateRecommendations($results) {
        $recommendations = [];

        if (!$results['is_cloudflare_zone']) {
            $recommendations[] = 'CRÍTICO: El sitio no está configurado como zona de Cloudflare.';
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

    public static function generateDiagnosticReport() {
        $results = self::checkDomainConfiguration();
        $report = "=== DIAGNÓSTICO TURNSTILE ===\n";
        $report .= "Dominio: " . $results['domain'] . "\n";
        $report .= "Zona Cloudflare: " . ($results['is_cloudflare_zone'] ? 'SÍ' : 'NO') . "\n";
        $report .= "Turnstile Configurado: " . ($results['turnstile_configured'] ? 'SÍ' : 'NO') . "\n";
        $report .= "Site Key Válido: " . ($results['site_key_valid'] ? 'SÍ' : 'NO') . "\n";

        if (!empty($results['recommendations'])) {
            $report .= "\n=== RECOMENDACIONES ===\n";
            foreach ($results['recommendations'] as $r) {
                $report .= "- " . $r . "\n";
            }
        }

        return $report;
    }

    public static function testTurnstileConnectivity() {
        $results = [
            'api_reachable' => false,
            'response_time' => 0,
            'error' => null
        ];

        $start_time = microtime(true);
        $context = stream_context_create([
            'http' => ['timeout' => 10, 'method' => 'GET']
        ]);
        $response = @file_get_contents('https://challenges.cloudflare.com/turnstile/v0/api.js', false, $context);
        $results['response_time'] = round((microtime(true) - $start_time) * 1000, 2);
        $results['api_reachable'] = $response !== false;
        if (!$results['api_reachable']) {
            $results['error'] = 'No se pudo conectar con la API de Turnstile';
        }

        return $results;
    }
}