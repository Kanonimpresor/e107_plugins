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

// Define log levels if not already defined
if (!defined('E_LOG_NOTICE')) define('E_LOG_NOTICE', 1);
if (!defined('E_LOG_WARNING')) define('E_LOG_WARNING', 2);
if (!defined('E_LOG_FATAL')) define('E_LOG_FATAL', 3);

$turnstileActive = e107::pref('turnstile', 'active');
$turnstileSiteKey = e107::pref('turnstile', 'sitekey');
$turnstileSecretKey = e107::pref('turnstile', 'secretkey');
 
if($turnstileActive)
{ 	
	class e107turnstile 
	{
		public function __construct()
	    {
	    	e107::lan('turnstile', false, true);
	  	}
	    
		/**
		 * Blank function used as a placeholder
		 * @return string Empty string
		 */
		static function blank()
		{
			return '';
		}
	 
		/**
		 * Generate the Turnstile widget HTML
		 * @return string HTML for the Turnstile widget
		 */
		static function input()
		{
			// Obtener el dominio actual
			$domain = strtolower($_SERVER['HTTP_HOST'] ?? 'localhost');
			$isLocal = in_array($domain, ['localhost', '127.0.0.1', '::1']);
			
 			$siteKey = e107::pref('turnstile', 'sitekey');
			
			// En entorno local, manejar de manera especial
			if ($isLocal) {
				// Si no hay clave o es la predeterminada, mostrar un mensaje y no cargar el captcha
				if (empty($siteKey) || $siteKey === 'Your Site Key') {
					e107::getLog()->add('TURNSTILE_DEBUG', [
						'message' => 'Modo desarrollo local sin claves de Turnstile configuradas',
						'domain' => $domain
					], E_LOG_NOTICE, 'Turnstile');
					// Mostrar un mensaje en modo desarrollo
					return '<div class="alert alert-info">Modo desarrollo: CAPTCHA desactivado localmente</div>';
				}
				
				// Si hay clave configurada, forzar el modo de prueba
				$testMode = ' data-callback="javascript:document.getElementById(\'cf-turnstile-response\').value=\'test-token\'"';
				$testMode .= ' data-action="test"';
			} else {
				// En producción, mostrar error si no hay clave configurada
				if (empty($siteKey) || $siteKey === 'Your Site Key') {
					e107::getMessage()->addError('Turnstile Site Key no está configurado. Por favor, contacte con el administrador del sitio.');
					return '';
				}
				$testMode = '';
			}
			
			// Añadir el script de Turnstile solo si hay una clave configurada
			if (!empty($siteKey) && $siteKey !== 'Your Site Key') {
				$js = "<script src='https://challenges.cloudflare.com/turnstile/v0/api.js' async defer></script>";
				e107::js('footer', $js, 'jquery', 5);
			}
			
			// Generar el HTML del widget
			if ($isLocal && !empty($testMode)) {
				// En local, forzar el modo de prueba
				$html = "<div class='cf-turnstile' data-sitekey='{$siteKey}' data-theme='auto'{$testMode}></div>";
				$html .= "<script>document.addEventListener('DOMContentLoaded', function() { 
					document.getElementById('cf-turnstile-response').value = 'test-token';
				});</script>";
			} else {
				// En producción, comportamiento normal
				$html = "<div class='cf-turnstile' data-sitekey='{$siteKey}' data-theme='auto'></div>";
			};
			
			return $html;
		}
		
		/**
		 * Generate hidden input fields for the form
		 * @return string HTML for hidden inputs
		 */
		static function hiddeninput()
		{   
			// Obtener el dominio actual
			$domain = strtolower($_SERVER['HTTP_HOST'] ?? 'localhost');
			$isLocal = in_array($domain, ['localhost', '127.0.0.1', '::1']);
			
			// Si estamos en local y no hay claves configuradas, no es necesario el CAPTCHA
			$siteKey = e107::pref('turnstile', 'sitekey');
			if ($isLocal && (empty($siteKey) || $siteKey === 'Your Site Key')) {
				// Retornar un campo oculto con un valor por defecto para pasar la validación
				$frm = e107::getForm();
				return $frm->hidden('cf-turnstile-response', 'bypass-local-dev', ['id' => 'cf-turnstile-response']);
			}
			
			$frm = e107::getForm();
			$html = $frm->hidden('cf-turnstile-response', '', ['id' => 'cf-turnstile-response']);
			$html .= $frm->hidden('cf-turnstile-verified', '0', ['id' => 'cf-turnstile-verified']);
			
			// Add JavaScript to update the hidden field when verification is complete
			$js = "
			<script>
				document.addEventListener('DOMContentLoaded', function() {
					var turnstileWidget = document.querySelector('.cf-turnstile');
					if (turnstileWidget) {
						var form = turnstileWidget.closest('form');
						if (form) {
							form.addEventListener('submit', function(e) {
								var response = document.getElementById('cf-turnstile-response');
								if (!response || !response.value) {
									e.preventDefault();
									alert('Por favor, complete la verificación CAPTCHA.');
									return false;
								}
							});
						}
					}
				});
			</script>";
			
			e107::js('footer', $js, 'jquery', 10);
			
			return $html;
		}

		/**
		 * Validate the domain against allowed domains list
		 * @param string $domain The domain to validate
		 * @return bool True if domain is valid, false otherwise
		 */
		static function validateDomain($domain) {
			// Always allow localhost and 127.0.0.1 for development
			$localDomains = ['localhost', '127.0.0.1', '::1'];
			if (in_array(strtolower($domain), $localDomains)) {
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'Acceso local permitido',
					'domain' => $domain
				), E_LOG_NOTICE, 'Turnstile');
				return true;
			}

			// Skip validation if domain validation is disabled
			if (!e107::pref('turnstile', 'enable_domain_validation', 0)) {
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'La validación de dominio está desactivada',
					'domain' => $domain
				), E_LOG_NOTICE, 'Turnstile');
				return true;
			}

			// Get allowed domains from settings
			$allowedDomains = e107::pref('turnstile', 'allowed_domains', '');
			
			// If no domains are set, allow all
			if (empty($allowedDomains)) {
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'No hay dominios en la lista blanca, permitiendo todos',
					'domain' => $domain
				), E_LOG_NOTICE, 'Turnstile');
				return true;
			}

			// Convert to array and trim whitespace
			$allowedDomains = array_map('trim', explode(',', $allowedDomains));
			
			// Normalize domain (remove www. and convert to lowercase)
			$normalizedDomain = strtolower(preg_replace('/^www\./i', '', $domain));
			
			// Check if the domain is in the allowed list
			foreach ($allowedDomains as $allowedDomain) {
				// Normalize allowed domain
				$allowedDomain = strtolower(trim($allowedDomain));
				$allowedDomain = preg_replace('/^www\./i', '', $allowedDomain);
				
				// Check for exact match or wildcard subdomains
				if ($normalizedDomain === $allowedDomain) {
					e107::getLog()->add('TURNSTILE_DEBUG', array(
						'message' => 'Dominio coincidente exacto',
						'domain' => $domain,
						'allowed_domain' => $allowedDomain
					), E_LOG_NOTICE, 'Turnstile');
					return true;
				}
				
				// Support for wildcard subdomains (e.g., *.example.com)
				if (strpos($allowedDomain, '*') === 0) {
					$pattern = '/^' . str_replace('\*', '.*', preg_quote(substr($allowedDomain, 1), '/')) . '$/i';
					if (preg_match($pattern, $normalizedDomain)) {
						e107::getLog()->add('TURNSTILE_DEBUG', array(
							'message' => 'Dominio coincide con patrón comodín',
							'domain' => $domain,
							'pattern' => $pattern
						), E_LOG_NOTICE, 'Turnstile');
						return true;
					}
				}
				
				// Check for subdomain match (e.g., sub.example.com matches example.com)
				if (strpos($normalizedDomain, $allowedDomain) !== false) {
					// Verify it's a valid subdomain match (not just a partial match)
					$suffix = substr($normalizedDomain, -strlen($allowedDomain));
					if ($suffix === $allowedDomain) {
						e107::getLog()->add('TURNSTILE_DEBUG', array(
							'message' => 'Subdominio coincidente',
							'domain' => $domain,
							'allowed_domain' => $allowedDomain
						), E_LOG_NOTICE, 'Turnstile');
						return true;
					}
				}
			}
			
			// Log the validation failure with detailed information
			e107::getLog()->add('TURNSTILE_DOMAIN_VALIDATION', array(
				'message' => 'Error de validación de dominio',
				'domain' => $domain,
				'normalized_domain' => $normalizedDomain,
				'allowed_domains' => $allowedDomains,
				'http_host' => $_SERVER['HTTP_HOST'] ?? '',
				'server_name' => $_SERVER['SERVER_NAME'] ?? '',
				'request_uri' => $_SERVER['REQUEST_URI'] ?? ''
			), E_LOG_WARNING, 'Turnstile');
			
			return false;
		}
		
		/**
		 * Get the main domain from a hostname (e.g., sub.example.com -> example.com)
	 * @param string $domain The domain to process
	 * @return string The main domain
	 */
	static function getMainDomain($domain) {
		$domain = strtolower(trim($domain));
		$domain = str_replace('www.', '', $domain);
		
		$parts = explode('.', $domain);
		if (count($parts) > 2) {
			$domain = $parts[count($parts)-2] . '.' . $parts[count($parts)-1];
		}
		
		return $domain;
	}
		
		/**
		 * Verify the Turnstile token with Cloudflare's API
		 * @param string $token The token to verify
		* @return array Response from the API
		*/
	static function verifyTurnstileToken($token) 
	{
		$secretKey = e107::pref('turnstile', 'secretkey');
		$ip = e107::getIPHandler()->getIP();
		
		// Validate token format before sending to API
		if (!preg_match('/^[a-zA-Z0-9_-]+$/', $token)) {
			return ['success' => false, 'error-codes' => ['invalid-token-format']];
		}
		
		$url = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
		$data = [
			'secret' => $secretKey,
			'response' => $token,
			'remoteip' => $ip,
		];

		$options = [
			'http' => [
				'header' => "Content-type: application/x-www-form-urlencoded\r\n",
				'method' => 'POST',
				'content' => http_build_query($data),
				'timeout' => 5, // 5 seconds timeout
			],
		];

		try {
			$context = stream_context_create($options);
			$result = @file_get_contents($url, false, $context);
			
			if ($result === FALSE) {
				throw new Exception('Failed to connect to Turnstile API');
			}
			
			$response = json_decode($result, true);
			
			// Log the API response for debugging
			e107::getLog()->add('TURNSTILE_API_RESPONSE', array(
				'response' => $response,
				'ip' => $ip
			), E_LOG_NOTICE, 'Turnstile');
			
			return $response;
			
		} catch (Exception $e) {
			e107::getLog()->add('TURNSTILE_API_ERROR', array(
				'message' => $e->getMessage(),
				'ip' => $ip
			), E_LOG_FATAL, 'Turnstile');
			
			return [
				'success' => false,
				'error-codes' => ['api-error'],
				'error' => $e->getMessage()
			];
		}
	}
		
		/**
		 * Verify the CAPTCHA response
		 * @param string $code Not used (kept for compatibility)
		 * @param mixed $other Additional data (not used)
		 * @return bool|string True if verification passed, error message if failed
		 */
		static function verify($code, $other)
		{
			try {
				// Obtener el dominio actual
				$domain = strtolower($_SERVER['HTTP_HOST'] ?? 'localhost');
				$isLocal = in_array($domain, ['localhost', '127.0.0.1', '::1']);
				$siteKey = e107::pref('turnstile', 'sitekey');
				
				// En entorno local, manejar de manera especial
				if ($isLocal) {
					// Si no hay clave configurada, aceptar cualquier token
					if (empty($siteKey) || $siteKey === 'Your Site Key') {
						e107::getLog()->add('TURNSTILE_DEBUG', [
							'message' => 'Modo desarrollo local - validación de CAPTCHA desactivada',
							'domain' => $domain
						], E_LOG_NOTICE, 'Turnstile');
						return true;
					}
					
					// Si hay clave configurada, aceptar tokens de prueba
					$token = $_POST['cf-turnstile-response'] ?? '';
					if ($token === 'test-token' || $token === 'bypass-local-dev') {
						e107::getLog()->add('TURNSTILE_DEBUG', [
							'message' => 'Token de prueba aceptado en modo desarrollo',
							'token' => $token
						], E_LOG_NOTICE, 'Turnstile');
						return true;
					}
				}
				
				// Only process POST requests
				if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
					e107::getLog()->add('TURNSTILE_DEBUG', array(
						'message' => 'No es una petición POST',
						'method' => $_SERVER['REQUEST_METHOD']
					), E_LOG_WARNING, 'Turnstile');
					return 'Método de petición inválido. Por favor, inténtelo de nuevo.';
				}

				// Get the token from POST data
				$token = $_POST['cf-turnstile-response'] ?? '';
				
				// Basic token validation
				if (empty($token)) {
					e107::getLog()->add('TURNSTILE_MISSING_TOKEN', array(
						'ip' => e107::getIPHandler()->getIP(),
						'post_data' => array_keys($_POST)
					), E_LOG_WARNING, 'Turnstile');
					return 'Error de verificación CAPTCHA. Por favor, complete el desafío CAPTCHA.';
				}

				// Get the domain from the request
				$domain = $_SERVER['HTTP_HOST'] ?? ($_SERVER['SERVER_NAME'] ?? 'unknown');
				
				// Normalize the domain (remove port if present)
				$domain = strtolower(trim($domain));
				if (strpos($domain, ':') !== false) {
					$domain = substr($domain, 0, strpos($domain, ':'));
				}
				
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'Iniciando verificación',
					'domain' => $domain,
					'token_length' => strlen($token),
					'http_host' => $_SERVER['HTTP_HOST'] ?? '',
					'server_name' => $_SERVER['SERVER_NAME'] ?? '',
					'request_uri' => $_SERVER['REQUEST_URI'] ?? ''
				), E_LOG_NOTICE, 'Turnstile');
				
				// Validate domain if enabled
				$domainValidation = self::validateDomain($domain);
				if ($domainValidation !== true) {
					e107::getLog()->add('TURNSTILE_INVALID_DOMAIN', array(
						'message' => 'Dominio no permitido para la verificación CAPTCHA',
						'domain' => $domain,
						'ip' => e107::getIPHandler()->getIP(),
						'request_uri' => $_SERVER['REQUEST_URI'] ?? '',
						'http_host' => $_SERVER['HTTP_HOST'] ?? '',
						'server_name' => $_SERVER['SERVER_NAME'] ?? '',
						'allowed_domains' => e107::pref('turnstile', 'allowed_domains', '')
					), E_LOG_WARNING, 'Turnstile');
					return 'Error de configuración del dominio. Por favor, contacte al administrador del sitio.';
				}

				// Verify the token with Cloudflare
				$response = self::verifyTurnstileToken($token);
				
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'Respuesta de la API',
					'response' => $response,
					'domain' => $domain,
					'http_host' => $_SERVER['HTTP_HOST'] ?? '',
					'server_name' => $_SERVER['SERVER_NAME'] ?? ''
				), E_LOG_NOTICE, 'Turnstile');

				// Check if verification was successful
				if (!empty($response['success']) && $response['success'] === true) {
					// Additional validation: Check if the hostname matches the expected domain
					if (!empty($response['hostname'])) {
						$hostname = strtolower($response['hostname']);
						$expectedDomains = array_map('trim', explode(',', e107::pref('turnstile', 'allowed_domains', '')));
						
						// Add the current domain to the list of expected domains
						if (!in_array($domain, $expectedDomains)) {
							$expectedDomains[] = $domain;
						}
						
						$hostnameValid = false;
						foreach ($expectedDomains as $expected) {
							$expected = strtolower(trim($expected));
							$expected = preg_replace('/^www\./i', '', $expected);
							
							// Check for exact match or subdomain
							if ($hostname === $expected || 
								str_ends_with($hostname, '.' . $expected) || 
								$hostname === 'www.' . $expected) {
								$hostnameValid = true;
								break;
							}
						}
						
						if (!$hostnameValid) {
							e107::getLog()->add('TURNSTILE_HOSTNAME_MISMATCH', array(
								'message' => 'El hostname no coincide con los dominios permitidos',
								'hostname' => $hostname,
								'expected_domains' => $expectedDomains,
								'domain' => $domain,
								'http_host' => $_SERVER['HTTP_HOST'] ?? '',
								'server_name' => $_SERVER['SERVER_NAME'] ?? ''
							), E_LOG_WARNING, 'Turnstile');
							
							// Si estamos en modo desarrollo, permitir continuar
							if ($isLocal) {
								e107::getLog()->add('TURNSTILE_DEBUG', array(
									'message' => 'Modo desarrollo: ignorando discrepancia de hostname',
									'hostname' => $hostname,
									'expected_domains' => $expectedDomains
								), E_LOG_NOTICE, 'Turnstile');
								return true;
							}
							
							return 'Error de configuración del dominio. Por favor, contacte al administrador del sitio.';
						}
					}
					
					return true;
				}

				// If verification failed, log the error and return an error message
				$errorMessage = !empty($response['error-codes']) ? self::getErrorMessage($response['error-codes']) : 'Error desconocido';
				
				e107::getLog()->add('TURNSTILE_VERIFICATION_FAILED', array(
					'message' => 'Error en la verificación CAPTCHA',
					'error_codes' => !empty($response['error-codes']) ? $response['error-codes'] : [],
					'error_message' => $errorMessage,
					'domain' => $domain,
					'ip' => e107::getIPHandler()->getIP(),
					'token' => substr($token, 0, 10) . '...' // Log only first 10 chars of token
				), E_LOG_WARNING, 'Turnstile');
				
				return $errorMessage;
			} catch (Exception $e) {
				e107::getLog()->add('TURNSTILE_EXCEPTION', array(
					'message' => $e->getMessage(),
					'trace' => $e->getTraceAsString(),
					'domain' => $domain ?? 'unknown',
					'ip' => e107::getIPHandler()->getIP()
				), E_LOG_FATAL, 'Turnstile');
				
				// In production, return a generic error message
				return 'Error en el servidor. Por favor, inténtelo de nuevo más tarde.';
			}
		}
		
		/**
		 * Get user-friendly error message based on error codes
		 * @param array $errorCodes Array of error codes from Turnstile API
		 * @return string User-friendly error message
		 */
		static function getErrorMessage($errorCodes) {
			$messages = [
				'missing-input-secret' => 'The secret key was not provided.',
				'invalid-input-secret' => 'The secret key is invalid or malformed.',
				'missing-input-response' => 'The response token was not provided.',
				'invalid-input-response' => 'The response token is invalid or malformed.',
				'bad-request' => 'The request was rejected because it was malformed.',
				'timeout-or-duplicate' => 'The response token has already been validated or has expired.',
				'internal-error' => 'An internal error occurred while validating the response.',
				'unknown-error' => 'An unknown error occurred. Please try again.'
			];
			
			// If we have specific error codes, return the first one we have a message for
			foreach ($errorCodes as $code) {
				if (isset($messages[$code])) {
					return 'CAPTCHA verification failed: ' . $messages[$code];
				}
			}
			
			// Default message if no specific code matched
			return 'CAPTCHA verification failed. Please try again.';
		}

		/**
		 * Handle invalid CAPTCHA responses
		 * @param mixed $rec_num Not used (kept for compatibility)
		 * @param mixed $checkstr Not used (kept for compatibility)
		 * @return string|bool Error message if check fails, false if check passes
		 */
		static function invalid($rec_num, $checkstr)
		{
			e107::getLog()->add('TURNSTILE_DEBUG', array(
				'message' => 'Invalid CAPTCHA check triggered',
				'rec_num' => $rec_num,
				'checkstr' => $checkstr,
				'post_data' => $_POST ?? []
			), E_LOG_NOTICE, 'Turnstile');
			
			$verification = self::verify($rec_num, $checkstr);
			
			if ($verification === true) {
				// Verification passed
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'CAPTCHA verification passed in invalid()',
					'ip' => e107::getIPHandler()->getIP()
				), E_LOG_NOTICE, 'Turnstile');
				return false;
			} else {
				// Verification failed - return the error message
				$errorMsg = is_string($verification) ? $verification : 'You did not pass the robot test.';
				
				e107::getLog()->add('TURNSTILE_DEBUG', array(
					'message' => 'CAPTCHA verification failed in invalid()',
					'error' => $errorMsg,
					'ip' => e107::getIPHandler()->getIP()
				), E_LOG_WARNING, 'Turnstile');
				
				// Return the error message to be displayed to the user
				return $errorMsg;
			}
		}
		  
	}
	/* remove original captcha */
	//if ($user_func = e107::getOverride()->check($this,'r_image'))
	e107::getOverride()->replace('secure_image::r_image',     'e107turnstile::input');
	e107::getOverride()->replace('secure_image::renderInput', 'e107turnstile::hiddeninput');
	e107::getOverride()->replace('secure_image::invalidCode', 'e107turnstile::invalid');
	e107::getOverride()->replace('secure_image::renderLabel', 'e107turnstile::blank');
	e107::getOverride()->replace('secure_image::verify_code', 'e107turnstile::verify');
	 
	
}
