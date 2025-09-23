<?php
/**
 * e107 website system
 *
 * Copyright (C) 2008-2024 e107 Inc (e107.org)
 * Released under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * Turnstile Plugin - Admin Configuration
 */

require_once('../../class2.php');

if (!defined('e107_INIT')) { exit; }

// Check admin permissions (modern implementation)
if (!e107::getUser()->checkPluginAdminPerms('turnstile')) {
	e107::redirect('admin');
	exit;
}

// Load language files
e107::lan('turnstile', 'admin', true);
e107::lan('turnstile', 'global', true);

/**
 * Turnstile Admin Configuration Class
 */
class turnstile_adminArea extends e_admin_dispatcher
{
	protected $modes = array(
		'main' => array(
			'controller' => 'turnstile_ui',
			'path' => null,
			'ui' => 'turnstile_form_ui',
			'uipath' => null
		)
	);

	protected $adminMenu = array(
		'main/prefs' => array('caption' => 'Configuration', 'perm' => 'P'),
		'main/stats' => array('caption' => 'Statistics', 'perm' => 'P'),
		'main/logs' => array('caption' => 'Security Logs', 'perm' => 'P'),
		'main/test' => array('caption' => 'Test Configuration', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit' => 'main/prefs'
	);

	protected $menuTitle = 'Turnstile CAPTCHA';
}

/**
 * Turnstile Admin UI Controller
 */
class turnstile_ui extends e_admin_ui
{
			
		protected $pluginTitle = 'Turnstile CAPTCHA';
	protected $pluginName = 'turnstile';
	protected $table = 'turnstile_config';
	protected $pid = 'config_name';
	protected $perPage = 50;
	protected $batchDelete = false;
	protected $sortField = 'config_name';
	protected $orderStep = 10;

	protected $fields = array(
		'checkboxes' => array('title' => '', 'type' => null, 'data' => null, 'width' => '5%', 'thclass' => 'center', 'forced' => '1', 'class' => 'center', 'toggle' => 'e-multiselect'),
		'config_name' => array('title' => 'Setting', 'data' => 'str', 'width' => '30%', 'readonly' => 1),
		'config_value' => array('title' => 'Value', 'type' => 'text', 'data' => 'str', 'width' => '50%'),
		'config_updated' => array('title' => 'Updated', 'type' => 'datestamp', 'data' => 'int', 'width' => '15%', 'readonly' => 1),
		'options' => array('title' => 'Options', 'type' => null, 'data' => null, 'width' => '10%', 'thclass' => 'center last', 'class' => 'center last', 'forced' => '1')
	);

	protected $fieldpref = array('config_name', 'config_value', 'config_updated');

	protected $prefs = array(
		'enable' => array('title' => 'Enable Turnstile', 'tab' => 0, 'type' => 'bool', 'data' => 'int', 'help' => 'Enable Cloudflare Turnstile CAPTCHA to replace the default e107 CAPTCHA system.'),
		'sitekey' => array('title' => 'Site Key', 'tab' => 0, 'type' => 'text', 'data' => 'str', 'help' => 'Your Cloudflare Turnstile Site Key (public key).', 'writeParms' => array('size' => 'block-level', 'placeholder' => '0x4AAAAAAABkMYinukE_NVJb')),
		'secretkey' => array('title' => 'Secret Key', 'tab' => 0, 'type' => 'password', 'data' => 'str', 'help' => 'Your Cloudflare Turnstile Secret Key (private key). Keep this secure!', 'writeParms' => array('size' => 'block-level', 'placeholder' => '0x4AAAAAAABkMYinukE_NVJc')),
		'theme' => array('title' => 'Theme', 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'help' => 'Choose the visual theme for the Turnstile widget.', 'writeParms' => array('optArray' => array('light' => 'Light', 'dark' => 'Dark', 'auto' => 'Auto'))),
		'size' => array('title' => 'Size', 'tab' => 0, 'type' => 'dropdown', 'data' => 'str', 'help' => 'Select the size of the Turnstile widget.', 'writeParms' => array('optArray' => array('normal' => 'Normal', 'compact' => 'Compact'))),
		'hide_members' => array('title' => 'Hide for Members', 'tab' => 0, 'type' => 'bool', 'data' => 'int', 'help' => 'Hide CAPTCHA for logged-in members.'),
		'rate_limit_enabled' => array('title' => 'Enable Rate Limiting', 'tab' => 1, 'type' => 'bool', 'data' => 'int', 'help' => 'Enable automatic rate limiting and IP blocking for failed attempts.'),
		'rate_limit_attempts' => array('title' => 'Max Attempts', 'tab' => 1, 'type' => 'number', 'data' => 'int', 'help' => 'Maximum failed attempts before blocking (default: 5).', 'writeParms' => array('min' => 1, 'max' => 50)),
		'rate_limit_window' => array('title' => 'Time Window (seconds)', 'tab' => 1, 'type' => 'number', 'data' => 'int', 'help' => 'Time window for counting attempts (default: 300 seconds / 5 minutes).', 'writeParms' => array('min' => 60, 'max' => 3600)),
		'block_duration' => array('title' => 'Block Duration (seconds)', 'tab' => 1, 'type' => 'number', 'data' => 'int', 'help' => 'How long to block an IP address (default: 3600 seconds / 1 hour).', 'writeParms' => array('min' => 300, 'max' => 86400))
	);

	protected $preftabs = array('General', 'Security');

	/**
	 * Initialize admin interface
	 */
	public function init()
	{
		// Add CSS and JS if available
		if (file_exists(e_PLUGIN . 'turnstile/css/admin.css')) {
			e107::css('turnstile', 'css/admin.css');
		}
		if (file_exists(e_PLUGIN . 'turnstile/js/admin.js')) {
			e107::js('turnstile', 'js/admin.js');
		}
	}

	/**
	 * Handle statistics page
	 */
	public function statsPage()
	{
		$db = e107::getDb();
		$tp = e107::getParser();

		// Get statistics
		$stats = $this->getStatistics();

		$text = "
		<div class='row'>
			<div class='col-md-3'>
				<div class='panel panel-default'>
					<div class='panel-body text-center'>
						<h3 class='text-success'>" . number_format($stats['total_attempts']) . "</h3>
						<p>Total Attempts</p>
					</div>
				</div>
			</div>
			<div class='col-md-3'>
				<div class='panel panel-default'>
					<div class='panel-body text-center'>
						<h3 class='text-success'>" . number_format($stats['successful_attempts']) . "</h3>
						<p>Successful</p>
					</div>
				</div>
			</div>
			<div class='col-md-3'>
				<div class='panel panel-default'>
					<div class='panel-body text-center'>
						<h3 class='text-danger'>" . number_format($stats['failed_attempts']) . "</h3>
						<p>Failed</p>
					</div>
				</div>
			</div>
			<div class='col-md-3'>
				<div class='panel panel-default'>
					<div class='panel-body text-center'>
						<h3 class='text-warning'>" . number_format($stats['blocked_ips']) . "</h3>
						<p>Blocked IPs</p>
					</div>
				</div>
			</div>
		</div>

		<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>Recent Activity (Last 24 Hours)</h3>
			</div>
			<div class='panel-body'>
				" . $this->getRecentActivityTable() . "
			</div>
		</div>";

		return $text;
	}

	/**
	 * Handle logs page
	 */
	public function logsPage()
	{
		$db = e107::getDb();
		$tp = e107::getParser();

		$text = "<div class='panel panel-default'>
			<div class='panel-heading'>
				<h3 class='panel-title'>Security Logs</h3>
			</div>
			<div class='panel-body'>
				<table class='table table-striped'>
					<thead>
						<tr>
							<th>Time</th>
							<th>IP Address</th>
							<th>Event</th>
							<th>Details</th>
						</tr>
					</thead>
					<tbody>";

		// Get recent security events from e107 logs
		if ($db->select('generic', '*', "gen_type = 'TURNSTILE_SECURITY' OR gen_type = 'TURNSTILE_ERROR' ORDER BY gen_datestamp DESC LIMIT 100")) {
			while ($row = $db->fetch()) {
				$text .= "<tr>
					<td>" . e107::getDate()->convert_date($row['gen_datestamp'], 'short') . "</td>
					<td>" . $tp->toHTML($row['gen_ip']) . "</td>
					<td><span class='label label-warning'>" . $tp->toHTML($row['gen_type']) . "</span></td>
					<td>" . $tp->toHTML($row['gen_data']) . "</td>
				</tr>";
			}
		} else {
			$text .= "<tr><td colspan='4' class='text-center'>No security events found</td></tr>";
		}

		$text .= "</tbody></table>
			</div>
		</div>";

		return $text;
	}

	/**
	 * Get plugin statistics
	 */
	private function getStatistics()
	{
		$db = e107::getDb();
		$currentTime = time();
		$dayAgo = $currentTime - 86400;

		$stats = array(
			'total_attempts' => 0,
			'successful_attempts' => 0,
			'failed_attempts' => 0,
			'blocked_ips' => 0,
			'recent_attempts' => 0
		);

		// Check if tables exist before querying
		if ($db->isTable('turnstile_attempts')) {
			$stats['total_attempts'] = $db->count('turnstile_attempts');
			$stats['successful_attempts'] = $db->count('turnstile_attempts', '(*)', 'attempt_success = 1');
			$stats['failed_attempts'] = $db->count('turnstile_attempts', '(*)', 'attempt_success = 0');
			$stats['recent_attempts'] = $db->count('turnstile_attempts', '(*)', "attempt_time > {$dayAgo}");
		}

		if ($db->isTable('turnstile_blocks')) {
			$stats['blocked_ips'] = $db->count('turnstile_blocks', '(*)', 'block_active = 1');
		}

		return $stats;
	}

	/**
	 * Get recent activity table
	 */
	private function getRecentActivityTable()
	{
		$db = e107::getDb();
		$tp = e107::getParser();
		$currentTime = time();
		$dayAgo = $currentTime - 86400;

		$text = "<table class='table table-striped'>
			<thead>
				<tr>
					<th>IP Address</th>
					<th>Time</th>
					<th>Result</th>
					<th>User Agent</th>
				</tr>
			</thead>
			<tbody>";

		if ($db->isTable('turnstile_attempts') && $db->select('turnstile_attempts', '*', "attempt_time > {$dayAgo} ORDER BY attempt_time DESC LIMIT 50")) {
			while ($row = $db->fetch()) {
				$status = $row['attempt_success'] ? 
					"<span class='label label-success'>Success</span>" : 
					"<span class='label label-danger'>Failed</span>";
				
				$text .= "<tr>
					<td>" . $tp->toHTML($row['attempt_ip']) . "</td>
					<td>" . e107::getDate()->convert_date($row['attempt_time'], 'short') . "</td>
					<td>{$status}</td>
					<td>" . $tp->text_truncate($tp->toHTML($row['attempt_user_agent']), 50) . "</td>
				</tr>";
			}
		} else {
			$text .= "<tr><td colspan='4' class='text-center'>No recent activity</td></tr>";
		}

		$text .= "</tbody></table>";

		return $text;
	}
			
}
				


class turnstile_form_ui extends e_admin_form_ui
{

}		
		
		
new turnstile_adminArea();

require_once(e_ADMIN."auth.php");
e107::getAdminUI()->runPage();

require_once(e_ADMIN."footer.php");
exit;

?>
