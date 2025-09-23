<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Portuguese Language File (Global)
 *
 */

// Plugin Information
define('LAN_PLUGIN_TURNSTILE_NAME', 'Turnstile CAPTCHA');
define('LAN_PLUGIN_TURNSTILE_DIZ', 'Integração do Cloudflare Turnstile CAPTCHA para e107');
define('LAN_PLUGIN_TURNSTILE_DESCRIPTION', 'Substitui o CAPTCHA padrão do e107 pelo Cloudflare Turnstile para melhor experiência do usuário e segurança.');

// Frontend Messages
define('LAN_TURNSTILE_INVALID_DEFAULT', 'A validação do CAPTCHA falhou. Por favor, tente novamente.');
define('LAN_TURNSTILE_LOADING', 'Carregando CAPTCHA...');
define('LAN_TURNSTILE_ERROR_GENERIC', 'Ocorreu um erro ao verificar o CAPTCHA. Por favor, atualize a página e tente novamente.');
define('LAN_TURNSTILE_EXPIRED', 'O CAPTCHA expirou. Por favor, complete-o novamente.');
define('LAN_TURNSTILE_REQUIRED', 'Por favor, complete a verificação do CAPTCHA.');

// Configuration Messages
define('LAN_TURNSTILE_CONFIG_SAVED', 'Configuração do Turnstile salva com sucesso.');
define('LAN_TURNSTILE_CONFIG_ERROR', 'Erro ao salvar a configuração do Turnstile.');
define('LAN_TURNSTILE_KEYS_REQUIRED', 'Tanto a Chave do Site quanto a Chave Secreta são obrigatórias.');
define('LAN_TURNSTILE_INVALID_KEYS', 'Formato de chave inválido. Por favor, verifique suas chaves do Turnstile.');

// Security Messages
define('LAN_TURNSTILE_SECURITY_VIOLATION', 'Violação de segurança detectada.');
define('LAN_TURNSTILE_RATE_LIMIT', 'Muitas tentativas. Por favor, aguarde antes de tentar novamente.');
define('LAN_TURNSTILE_IP_BLOCKED', 'Seu endereço IP foi temporariamente bloqueado devido a atividade suspeita.');

// Status Messages
define('LAN_TURNSTILE_ENABLED', 'Turnstile CAPTCHA está ativado');
define('LAN_TURNSTILE_DISABLED', 'Turnstile CAPTCHA está desativado');
define('LAN_TURNSTILE_NOT_CONFIGURED', 'Turnstile CAPTCHA não está configurado corretamente');

?>