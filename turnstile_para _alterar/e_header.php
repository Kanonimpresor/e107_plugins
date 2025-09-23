<?php
require_once(__DIR__ . '/e_preload.php');
require_once(__DIR__ . '/e_domain_check.php');
require_once(__DIR__ . '/e_turnstile_fix.php');

$turnstileActive = e107::pref('turnstile', 'active');
$turnstileSiteKey = e107::pref('turnstile', 'sitekey');

if ($turnstileActive && $turnstileSiteKey)
{
	// Verificar configuración del dominio antes de cargar
	$domainCheck = turnstile_domain_checker::checkDomainConfiguration();
	
	// Solo cargar si estamos en una zona de Cloudflare
	if ($domainCheck['is_cloudflare_zone']) {
		// Obtener estrategia de carga optimizada
		$loadingStrategy = turnstile_preload::getLoadingStrategy();
		
		// Generar preload link si es necesario
		if ($loadingStrategy['preload']) {
			echo turnstile_preload::generatePreloadLink() . "\n";
		}
		
		// Construir atributos del script según la estrategia
		$scriptAttributes = 'defer';
		if ($loadingStrategy['async']) {
			$scriptAttributes = 'async defer';
		}
		
		// Cargar el script de Cloudflare Turnstile de forma optimizada
		e107::js("footer-inline", '<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" ' . $scriptAttributes . '></script>');
		
		// Aplicar fixes para problemas de ubicación embebida
		if (turnstile_embedded_fix::shouldApplyFix()) {
			e107::js("footer-inline", turnstile_embedded_fix::generateCompleteFix());
		}
		
	} else {
		// Log del problema para debugging
		error_log('Turnstile: Dominio no está configurado como zona de Cloudflare - ' . $domainCheck['domain']);
	}
	
	// Agregar JavaScript optimizado para manejo de eventos
	e107::js("footer-inline", '
		window.turnstileScriptLoaded = false;
		window.turnstileScriptError = false;
		
		// Función optimizada para verificar disponibilidad de Turnstile
		function checkTurnstileReady() {
			if (typeof window.turnstile !== "undefined") {
				window.turnstileScriptLoaded = true;
				console.log("Turnstile script loaded successfully");
				// Disparar evento personalizado
				if (document.createEvent) {
					var event = document.createEvent("Event");
					event.initEvent("turnstileScriptReady", true, true);
					document.dispatchEvent(event);
				}
				return true;
			}
			return false;
		}
		
		// Verificación más eficiente del estado de carga
		document.addEventListener("DOMContentLoaded", function() {
			// Verificar inmediatamente si ya está disponible
			if (!checkTurnstileReady()) {
				// Si no está disponible, verificar periódicamente con backoff
				var attempts = 0;
				var maxAttempts = 20; // Máximo 10 segundos
				
				function retryCheck() {
					attempts++;
					if (checkTurnstileReady() || attempts >= maxAttempts) {
						return;
					}
					setTimeout(retryCheck, 500);
				}
				
				setTimeout(retryCheck, 100);
			}
		});
		
		// Prevenir preload innecesario en páginas sin formularios
		if (!document.querySelector("form[action*=\"login\"]") && !document.querySelector(".cf-turnstile")) {
			console.log("Turnstile: No login forms detected, script loaded conditionally");
		}
	');
}
