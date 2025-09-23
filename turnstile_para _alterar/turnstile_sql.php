<?php
/**
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Database Structure
 * 
 * IMPORTANTE: No incluir prefijo de tabla e107_
 * El sistema lo añadirá automáticamente
 */

$sql = "
/**
 * Tabla para registrar intentos de verificación CAPTCHA
 * Utilizada para rate limiting y estadísticas de seguridad
 */
CREATE TABLE turnstile_attempts (
    attempt_id int(10) NOT NULL AUTO_INCREMENT,
    attempt_ip varchar(45) NOT NULL,
    attempt_time int(10) NOT NULL,
    attempt_success tinyint(1) NOT NULL DEFAULT 0,
    attempt_user_agent varchar(255),
    attempt_user_id int(10) DEFAULT 0,
    PRIMARY KEY (attempt_id),
    KEY idx_ip_time (attempt_ip, attempt_time),
    KEY idx_success (attempt_success),
    KEY idx_time (attempt_time),
    KEY idx_user (attempt_user_id)
);

/**
 * Tabla para configuración del plugin
 * Almacena configuraciones específicas del plugin
 */
CREATE TABLE turnstile_config (
    config_name varchar(100) NOT NULL,
    config_value text,
    config_updated int(10) NOT NULL,
    PRIMARY KEY (config_name)
);

/**
 * Tabla para bloqueos temporales de IP
 * Utilizada para gestionar bloqueos automáticos por rate limiting
 */
CREATE TABLE turnstile_blocks (
    block_id int(10) NOT NULL AUTO_INCREMENT,
    block_ip varchar(45) NOT NULL,
    block_start int(10) NOT NULL,
    block_end int(10) NOT NULL,
    block_reason varchar(255),
    block_attempts int(5) DEFAULT 0,
    block_active tinyint(1) DEFAULT 1,
    PRIMARY KEY (block_id),
    UNIQUE KEY idx_ip_active (block_ip, block_active),
    KEY idx_end_time (block_end),
    KEY idx_active (block_active)
);
";
?>