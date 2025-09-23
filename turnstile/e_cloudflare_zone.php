<?php
/**
 * Cloudflare Zone Detection and Configuration Helper
 * Detecta si el sitio está ejecutándose en una zona de Cloudflare
 */

class turnstile_cloudflare_zone {
    
    /**
     * Detecta si el sitio actual está ejecutándose en una zona de Cloudflare
     * @return array Información sobre la zona de Cloudflare
     */
    public static function detectCloudflareZone() {
        $result = [
            'is_cloudflare_zone' => false,
            'cf_ray' => null,
            'cf_connecting_ip' => null,
            'cf_ipcountry' => null,
            'cf_visitor' => null,
            'domain' => $_SERVER['HTTP_HOST'] ?? 'unknown',
            'recommendations' => []
        ];
        
        // Verificar headers de Cloudflare
        $cloudflareHeaders = [
            'CF-RAY' => 'cf_ray',
            'CF-Connecting-IP' => 'cf_connecting_ip',
            'CF-IPCountry' => 'cf_ipcountry',
            'CF-Visitor' => 'cf_visitor'
        ];
        
        $cfHeadersFound = 0;
        foreach ($cloudflareHeaders as $header => $key) {
            if (isset($_SERVER['HTTP_' . str_replace('-', '_', strtoupper($header))])) {
                $result[$key] = $_SERVER['HTTP_' . str_replace('-', '_', strtoupper($header))];
                $cfHeadersFound++;
            }
        }
        
        // Si encontramos headers de Cloudflare, probablemente estamos en una zona CF
        if ($cfHeadersFound >= 2) {
            $result['is_cloudflare_zone'] = true;
        }
        
        // Verificaciones adicionales
        if (!$result['is_cloudflare_zone']) {
            // Verificar si el servidor tiene características de Cloudflare
            $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
            if (stripos($serverSoftware, 'cloudflare') !== false) {
                $result['is_cloudflare_zone'] = true;
            }
            
            // Verificar mediante DNS (solo si no estamos en localhost)
            if (!self::isLocalhost()) {
                $dnsCheck = self::checkDNSForCloudflare($result['domain']);
                if ($dnsCheck) {
                    $result['is_cloudflare_zone'] = true;
                }
            }
        }
        
        // Generar recomendaciones
        if (!$result['is_cloudflare_zone']) {
            $result['recommendations'][] = 'El dominio no parece estar configurado como zona de Cloudflare';
            $result['recommendations'][] = 'Verifica que el dominio esté añadido a tu cuenta de Cloudflare';
            $result['recommendations'][] = 'Asegúrate de que los DNS apunten a los servidores de Cloudflare';
            
            if (self::isLocalhost()) {
                $result['recommendations'][] = 'Entorno local detectado - Turnstile puede no funcionar correctamente';
            }
        }
        
        return $result;
    }
    
    /**
     * Verifica si estamos en un entorno local
     * @return bool
     */
    private static function isLocalhost() {
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $localHosts = ['localhost', '127.0.0.1', '::1'];
        
        foreach ($localHosts as $localHost) {
            if (stripos($host, $localHost) !== false) {
                return true;
            }
        }
        
        // Verificar IPs privadas
        if (filter_var($host, FILTER_VALIDATE_IP)) {
            return !filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE);
        }
        
        return false;
    }
    
    /**
     * Verifica DNS para detectar Cloudflare
     * @param string $domain
     * @return bool
     */
    private static function checkDNSForCloudflare($domain) {
        try {
            // Obtener registros A del dominio
            $records = dns_get_record($domain, DNS_A);
            
            if (!$records) {
                return false;
            }
            
            // Rangos de IP conocidos de Cloudflare
            $cloudflareRanges = [
                '173.245.48.0/20',
                '103.21.244.0/22',
                '103.22.200.0/22',
                '103.31.4.0/22',
                '141.101.64.0/18',
                '108.162.192.0/18',
                '190.93.240.0/20',
                '188.114.96.0/20',
                '197.234.240.0/22',
                '198.41.128.0/17',
                '162.158.0.0/15',
                '104.16.0.0/13',
                '104.24.0.0/14',
                '172.64.0.0/13',
                '131.0.72.0/22'
            ];
            
            foreach ($records as $record) {
                $ip = $record['ip'];
                foreach ($cloudflareRanges as $range) {
                    if (self::ipInRange($ip, $range)) {
                        return true;
                    }
                }
            }
            
        } catch (Exception $e) {
            // Error en la verificación DNS
            return false;
        }
        
        return false;
    }
    
    /**
     * Verifica si una IP está en un rango CIDR
     * @param string $ip
     * @param string $range
     * @return bool
     */
    private static function ipInRange($ip, $range) {
        list($subnet, $bits) = explode('/', $range);
        $ip = ip2long($ip);
        $subnet = ip2long($subnet);
        $mask = -1 << (32 - $bits);
        $subnet &= $mask;
        return ($ip & $mask) == $subnet;
    }
    
    /**
     * Genera un reporte completo del estado de Cloudflare
     * @return array
     */
    public static function generateReport() {
        $zoneInfo = self::detectCloudflareZone();
        
        $report = [
            'timestamp' => date('Y-m-d H:i:s'),
            'domain' => $zoneInfo['domain'],
            'is_cloudflare_zone' => $zoneInfo['is_cloudflare_zone'],
            'cloudflare_headers' => [],
            'server_info' => [
                'software' => $_SERVER['SERVER_SOFTWARE'] ?? 'unknown',
                'remote_addr' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
                'http_host' => $_SERVER['HTTP_HOST'] ?? 'unknown'
            ],
            'recommendations' => $zoneInfo['recommendations']
        ];
        
        // Recopilar todos los headers de Cloudflare
        foreach ($_SERVER as $key => $value) {
            if (stripos($key, 'HTTP_CF_') === 0) {
                $headerName = str_replace('HTTP_CF_', 'CF-', $key);
                $headerName = str_replace('_', '-', $headerName);
                $report['cloudflare_headers'][$headerName] = $value;
            }
        }
        
        return $report;
    }
}