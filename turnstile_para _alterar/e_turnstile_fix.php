<?php
/**
 * Turnstile Embedded Location Fix
 * Resuelve el error "Cannot determine Turnstile's embedded location"
 */

class turnstile_embedded_fix {
    
    /**
     * Genera el JavaScript necesario para resolver problemas de ubicación embebida
     * @return string
     */
    public static function generateEmbeddedLocationFix() {
        $js = "
        <script>
        // Fix para 'Cannot determine Turnstile's embedded location'
        (function() {
            // Asegurar que el script se ejecute después de que Turnstile esté disponible
            function waitForTurnstile(callback, maxAttempts = 50) {
                let attempts = 0;
                
                function check() {
                    attempts++;
                    if (window.turnstile && typeof window.turnstile.render === 'function') {
                        callback();
                    } else if (attempts < maxAttempts) {
                        setTimeout(check, 100);
                    } else {
                        console.warn('Turnstile no se cargó después de ' + maxAttempts + ' intentos');
                    }
                }
                
                check();
            }
            
            // Configurar el entorno para Turnstile
            function setupTurnstileEnvironment() {
                // Verificar que estamos en el dominio correcto
                const currentDomain = window.location.hostname;
                
                // Configurar variables globales necesarias para Turnstile
                if (!window.turnstileConfig) {
                    window.turnstileConfig = {
                        domain: currentDomain,
                        embedded: true,
                        ready: false
                    };
                }
                
                // Interceptar errores de Turnstile para debugging
                const originalError = console.error;
                console.error = function(...args) {
                    const message = args.join(' ');
                    if (message.includes('Turnstile') || message.includes('embedded location')) {
                        console.warn('Turnstile Error Intercepted:', message);
                        console.warn('Current domain:', currentDomain);
                        console.warn('User agent:', navigator.userAgent);
                        
                        // Intentar reinicializar Turnstile
                        if (window.turnstile && window.turnstile.reset) {
                            setTimeout(() => {
                                try {
                                    window.turnstile.reset();
                                } catch (e) {
                                    console.warn('Error al reinicializar Turnstile:', e);
                                }
                            }, 1000);
                        }
                    }
                    originalError.apply(console, args);
                };
            }
            
            // Ejecutar cuando el DOM esté listo
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', setupTurnstileEnvironment);
            } else {
                setupTurnstileEnvironment();
            }
            
            // Configurar Turnstile cuando esté disponible
            waitForTurnstile(function() {
                console.log('Turnstile cargado correctamente');
                window.turnstileConfig.ready = true;
                
                // Disparar evento personalizado
                const event = new CustomEvent('turnstileReady', {
                    detail: { domain: window.location.hostname }
                });
                document.dispatchEvent(event);
            });
            
        })();
        </script>";
        
        return $js;
    }
    
    /**
     * Genera configuración específica para resolver problemas de cookies de terceros
     * @return string
     */
    public static function generateThirdPartyCookieFix() {
        $js = "
        <script>
        // Fix para problemas de cookies de terceros en Microsoft Edge
        (function() {
            // Detectar Microsoft Edge
            const isEdge = /Edg/.test(navigator.userAgent);
            
            if (isEdge) {
                console.log('Microsoft Edge detectado - Aplicando fix para cookies de terceros');
                
                // Configurar SameSite para cookies de Turnstile
                document.addEventListener('turnstileReady', function() {
                    if (window.turnstile) {
                        // Configuración específica para Edge
                        const originalRender = window.turnstile.render;
                        window.turnstile.render = function(element, options) {
                            options = options || {};
                            options.theme = options.theme || 'light';
                            options.size = options.size || 'normal';
                            
                            // Configuración adicional para Edge
                            options['edge-compat'] = true;
                            
                            return originalRender.call(this, element, options);
                        };
                    }
                });
            }
        })();
        </script>";
        
        return $js;
    }
    
    /**
     * Genera el fix completo para todos los problemas identificados
     * @return string
     */
    public static function generateCompleteFix() {
        $embeddedFix = self::generateEmbeddedLocationFix();
        $cookieFix = self::generateThirdPartyCookieFix();
        
        return $embeddedFix . "\n" . $cookieFix;
    }
    
    /**
     * Verifica si el fix debe aplicarse basado en el entorno
     * @return bool
     */
    public static function shouldApplyFix() {
        // Aplicar el fix solo si:
        // 1. Estamos en producción (no localhost)
        // 2. Turnstile está activo
        // 3. Tenemos configuración válida
        
        $host = $_SERVER['HTTP_HOST'] ?? '';
        $isLocalhost = (strpos($host, 'localhost') !== false || strpos($host, '127.0.0.1') !== false);
        
        if ($isLocalhost) {
            return false; // No aplicar en desarrollo local
        }
        
        $turnstileActive = e107::pref('turnstile', 'active');
        $siteKey = e107::pref('turnstile', 'sitekey');
        
        return ($turnstileActive && !empty($siteKey));
    }
}