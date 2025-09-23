<?php
/**
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Setup Class
 */

if (!defined('e107_INIT')) { exit; }

/**
 * Setup class for Turnstile plugin
 * Handles installation, upgrade and uninstall procedures
 */
class turnstile_setup
{
	/**
	 * Plugin installation - executed before creating database tables
	 * @return bool - true on success, false on failure
	 */
	function install_pre()
	{
		// Check PHP requirements
		if (version_compare(PHP_VERSION, '7.4.0', '<')) {
			e107::getMessage()->addError('Turnstile plugin requires PHP 7.4.0 or higher. Current version: ' . PHP_VERSION);
			return false;
		}

		// Check required PHP extensions
		$requiredExtensions = array('curl', 'json');
		foreach ($requiredExtensions as $ext) {
			if (!extension_loaded($ext)) {
				e107::getMessage()->addError('Turnstile plugin requires PHP extension: ' . $ext);
				return false;
			}
		}

		// Log installation start
		e107::getLog()->add('TURNSTILE_INSTALL', 'Starting Turnstile plugin installation', E_LOG_INFORMATIVE);
		
		return true;
	}

	/**
	 * Plugin installation - executed after creating database tables
	 * @return bool - true on success, false on failure
	 */
	function install_post()
	{
		// Set default configuration values
		$defaultConfig = array(
			'sitekey' => '',
			'secretkey' => '',
			'theme' => 'light',
			'size' => 'normal',
			'hide_members' => 0,
			'rate_limit_enabled' => 1,
			'rate_limit_attempts' => 5,
			'rate_limit_window' => 300,
			'block_duration' => 3600,
			'cleanup_enabled' => 1,
			'cleanup_days' => 30
		);

		// Save configuration to e107 preferences
		foreach ($defaultConfig as $key => $value) {
			e107::getConfig()->set('turnstile', $key, $value);
		}
		e107::getConfig()->save();

		// Insert initial configuration into database
		$db = e107::getDb();
		$currentTime = time();
		
		foreach ($defaultConfig as $name => $value) {
			$configData = array(
				'config_name' => $name,
				'config_value' => $value,
				'config_updated' => $currentTime
			);
			$db->insert('turnstile_config', $configData);
		}

		// Create admin menu link
		e107::getMessage()->addSuccess('Turnstile plugin installed successfully. Please configure your Cloudflare Turnstile keys in the admin panel.');
		
		// Log successful installation
		e107::getLog()->add('TURNSTILE_INSTALL', 'Turnstile plugin installation completed successfully', E_LOG_INFORMATIVE);
		
		return true;
	}

	/**
	 * Plugin upgrade handler
	 * @param string $previous_version - previous plugin version
	 * @param string $current_version - current plugin version
	 * @return bool - true on success, false on failure
	 */
	function upgrade($previous_version, $current_version)
	{
		$db = e107::getDb();
		
		// Log upgrade start
		e107::getLog()->add('TURNSTILE_UPGRADE', 
			"Upgrading Turnstile plugin from {$previous_version} to {$current_version}", 
			E_LOG_INFORMATIVE);

		// Version-specific upgrade procedures
		if (version_compare($previous_version, '1.1.0', '<')) {
			// Add new configuration options introduced in v1.1.0
			$newConfigs = array(
				'cleanup_enabled' => 1,
				'cleanup_days' => 30
			);

			foreach ($newConfigs as $name => $value) {
				// Check if config already exists
				if (!$db->select('turnstile_config', 'config_name', "config_name = '{$name}'")) {
					$configData = array(
						'config_name' => $name,
						'config_value' => $value,
						'config_updated' => time()
					);
					$db->insert('turnstile_config', $configData);
					
					// Also update e107 preferences
					e107::getConfig()->set('turnstile', $name, $value);
				}
			}
		}

		if (version_compare($previous_version, '1.2.0', '<')) {
			// Add indexes for better performance (if not exists)
			$indexes = array(
				'ALTER TABLE ' . MPREFIX . 'turnstile_attempts ADD INDEX idx_ip_success (attempt_ip, attempt_success)',
				'ALTER TABLE ' . MPREFIX . 'turnstile_blocks ADD INDEX idx_ip_time (block_ip, block_start)'
			);

			foreach ($indexes as $sql) {
				try {
					$db->gen($sql);
				} catch (Exception $e) {
					// Index might already exist, continue
					e107::getLog()->add('TURNSTILE_UPGRADE', 'Index creation skipped: ' . $e->getMessage(), E_LOG_INFORMATIVE);
				}
			}
		}

		// Save updated configuration
		e107::getConfig()->save();
		
		// Log successful upgrade
		e107::getLog()->add('TURNSTILE_UPGRADE', 
			"Turnstile plugin upgrade completed successfully to version {$current_version}", 
			E_LOG_INFORMATIVE);
		
		return true;
	}

	/**
	 * Plugin uninstallation
	 * @return bool - true on success, false on failure
	 */
	function uninstall()
	{
		// Log uninstall start
		e107::getLog()->add('TURNSTILE_UNINSTALL', 'Starting Turnstile plugin uninstallation', E_LOG_INFORMATIVE);

		// Remove plugin preferences
		$configKeys = array(
			'sitekey', 'secretkey', 'theme', 'size', 'hide_members',
			'rate_limit_enabled', 'rate_limit_attempts', 'rate_limit_window',
			'block_duration', 'cleanup_enabled', 'cleanup_days'
		);

		foreach ($configKeys as $key) {
			e107::getConfig()->remove('turnstile', $key);
		}
		e107::getConfig()->save();

		// Database tables will be automatically dropped by e107 core
		// based on the plugin.xml configuration

		// Log successful uninstall
		e107::getLog()->add('TURNSTILE_UNINSTALL', 'Turnstile plugin uninstalled successfully', E_LOG_INFORMATIVE);
		
		e107::getMessage()->addSuccess('Turnstile plugin has been uninstalled successfully.');
		
		return true;
	}

	/**
	 * Check if plugin requirements are met
	 * @return array - array of requirement check results
	 */
	function check_requirements()
	{
		$requirements = array();

		// PHP Version
		$requirements['php_version'] = array(
			'name' => 'PHP Version',
			'required' => '7.4.0',
			'current' => PHP_VERSION,
			'status' => version_compare(PHP_VERSION, '7.4.0', '>=')
		);

		// Required extensions
		$extensions = array('curl', 'json');
		foreach ($extensions as $ext) {
			$requirements['ext_' . $ext] = array(
				'name' => 'PHP Extension: ' . $ext,
				'required' => 'Enabled',
				'current' => extension_loaded($ext) ? 'Enabled' : 'Disabled',
				'status' => extension_loaded($ext)
			);
		}

		// Database connection
		$requirements['database'] = array(
			'name' => 'Database Connection',
			'required' => 'Available',
			'current' => e107::getDb() ? 'Available' : 'Not Available',
			'status' => (bool) e107::getDb()
		);

		return $requirements;
	}
}