<?php
/*
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Portuguese Language File (Admin)
 *
 */

// Admin Menu Items
define('LAN_TURNSTILE_ADMIN_MENU_MAIN', 'Configuração do Turnstile');
define('LAN_TURNSTILE_ADMIN_MENU_CONFIG', 'Configurações');
define('LAN_TURNSTILE_ADMIN_MENU_STATS', 'Estatísticas');
define('LAN_TURNSTILE_ADMIN_MENU_LOGS', 'Registros de Segurança');

// Configuration Labels
define('LAN_TURNSTILE_ADMIN_ENABLE', 'Ativar Turnstile');
define('LAN_TURNSTILE_ADMIN_ENABLE_HELP', 'Ativar Cloudflare Turnstile CAPTCHA para substituir o sistema CAPTCHA padrão do e107.');
define('LAN_TURNSTILE_ADMIN_SITEKEY', 'Chave do Site');
define('LAN_TURNSTILE_ADMIN_SITEKEY_HELP', 'Sua Chave de Site do Cloudflare Turnstile (chave pública).');
define('LAN_TURNSTILE_ADMIN_SECRETKEY', 'Chave Secreta');
define('LAN_TURNSTILE_ADMIN_SECRETKEY_HELP', 'Sua Chave Secreta do Cloudflare Turnstile (chave privada). Mantenha-a segura!');
define('LAN_TURNSTILE_ADMIN_THEME', 'Tema');
define('LAN_TURNSTILE_ADMIN_THEME_HELP', 'Escolha o tema visual para o widget do Turnstile.');
define('LAN_TURNSTILE_ADMIN_SIZE', 'Tamanho');
define('LAN_TURNSTILE_ADMIN_SIZE_HELP', 'Selecione o tamanho do widget do Turnstile.');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS', 'Ocultar para Membros');
define('LAN_TURNSTILE_ADMIN_HIDE_MEMBERS_HELP', 'Ocultar CAPTCHA para membros logados.');

// Theme Options
define('LAN_TURNSTILE_THEME_LIGHT', 'Claro');
define('LAN_TURNSTILE_THEME_DARK', 'Escuro');
define('LAN_TURNSTILE_THEME_AUTO', 'Automático');

// Size Options
define('LAN_TURNSTILE_SIZE_NORMAL', 'Normal');
define('LAN_TURNSTILE_SIZE_COMPACT', 'Compacto');

// Buttons
define('LAN_TURNSTILE_ADMIN_SAVE', 'Salvar Configuração');
define('LAN_TURNSTILE_ADMIN_RESET', 'Restaurar Padrões');
define('LAN_TURNSTILE_ADMIN_TEST', 'Testar Configuração');

// Status Messages
define('LAN_TURNSTILE_ADMIN_STATUS_OK', 'A configuração é válida e está funcionando corretamente.');
define('LAN_TURNSTILE_ADMIN_STATUS_ERROR', 'A configuração tem erros que precisam ser corrigidos.');
define('LAN_TURNSTILE_ADMIN_STATUS_WARNING', 'A configuração está funcionando mas tem avisos.');

// Statistics
define('LAN_TURNSTILE_STATS_TOTAL_VERIFICATIONS', 'Verificações Totais');
define('LAN_TURNSTILE_STATS_SUCCESSFUL', 'Bem-sucedidas');
define('LAN_TURNSTILE_STATS_FAILED', 'Falharam');
define('LAN_TURNSTILE_STATS_TODAY', 'Hoje');
define('LAN_TURNSTILE_STATS_THIS_WEEK', 'Esta Semana');
define('LAN_TURNSTILE_STATS_THIS_MONTH', 'Este Mês');

// Help Text
define('LAN_TURNSTILE_ADMIN_HELP_KEYS', 'Para obter suas chaves do Turnstile, visite o <a href="https://dash.cloudflare.com/" target="_blank">Painel do Cloudflare</a> e crie um novo site Turnstile.');
define('LAN_TURNSTILE_ADMIN_HELP_SETUP', 'Para instruções detalhadas de configuração, consulte a documentação do plugin.');

?>