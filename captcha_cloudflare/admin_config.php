<?php

// Generated e107 Plugin Admin Area 

require_once('../../class2.php');
if (!getperms('P')) 
{
	e107::redirect('admin');
	exit;
}

// e107::lan('turnstile',true);


class turnstile_adminArea extends e_admin_dispatcher
{

	protected $modes = array(	
	
		'main'	=> array(
			'controller' 	=> 'turnstile_ui',
			'path' 			=> null,
			'ui' 			=> 'turnstile_form_ui',
			'uipath' 		=> null
		),
		

	);	
	
	
	protected $adminMenu = array(
			
		'main/prefs' 		=> array('caption'=> LAN_PREFS, 'perm' => 'P'),	

		// 'main/custom'		=> array('caption'=> 'Custom Page', 'perm' => 'P')
	);

	protected $adminMenuAliases = array(
		'main/edit'	=> 'main/list'				
	);	
	
	protected $menuTitle = 'Turnstile Captcha';
}




				
class turnstile_ui extends e_admin_ui
{
			
		protected $pluginTitle		= 'Turnstile Captcha';
		protected $pluginName		= 'turnstile';
	//	protected $eventName		= 'turnstile-'; // remove comment to enable event triggers in admin. 		
		protected $table			= '';
		protected $pid				= '';
		protected $perPage			= 10; 
		protected $batchDelete		= true;
	//	protected $batchCopy		= true;		
	//	protected $sortField		= 'somefield_order';
	//	protected $orderStep		= 10;
	//	protected $tabs				= array('Tabl 1','Tab 2'); // Use 'tab'=>0  OR 'tab'=>1 in the $fields below to enable. 
		
	//	protected $listQry      	= "SELECT * FROM `#tableName` WHERE field != '' "; // Example Custom Query. LEFT JOINS allowed. Should be without any Order or Limit.
	
		protected $listOrder		= ' DESC';
	
		protected $fields 		= NULL;		
		
		protected $fieldpref = array();
		

	//	protected $preftabs        = array('General', 'Other' );
		protected $prefs = array(
			'active'		=> array('title'=> 'Active', 'tab'=>0, 'type'=>'boolean', 'data' => 'int', 'help'=>''),
            'hidefrommembers'	=> array('title'=> 'Hide from Members', 'tab'=>0, 'type'=>'boolean', 'data' => 'int', 'help'=>''),
			'sitekey'		=> array('title'=> 'Site Key', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Your Turnstile site key from Cloudflare', 'writeParms' => array('size'=>'block-level')),
			'secretkey'		=> array('title'=> 'Secret Key', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Your Turnstile secret key from Cloudflare', 'writeParms' => array('size'=>'block-level')),
			'allowed_domains'	=> array('title'=> 'Allowed Domains', 'tab'=>0, 'type'=>'text', 'data' => 'str', 'help'=>'Comma-separated list of allowed domains (e.g., example.com,sub.example.com)', 'writeParms' => array('size'=>'block-level', 'placeholder'=>'example.com,sub.example.com')),
			'enable_domain_validation' => array('title'=> 'Enable Domain Validation', 'tab'=>0, 'type'=>'boolean', 'data' => 'int', 'help'=>'Enable validation of allowed domains', 'default' => 0),
		); 

		public function init()
		{
			// Set drop-down values (if any). 
	
		}

		// ------- Customize Create --------
		
		public function beforeCreate($new_data,$old_data)
		{
			return $new_data;
		}
	
		public function afterCreate($new_data, $old_data, $id)
		{
			// do something
		}

		public function onCreateError($new_data, $old_data)
		{
			// do something		
		}		
		
		
		// ------- Customize Update --------
		
		public function beforeUpdate($new_data, $old_data, $id)
		{
			return $new_data;
		}

		public function afterUpdate($new_data, $old_data, $id)
		{
			// do something	
		}
		
		public function onUpdateError($new_data, $old_data, $id)
		{
			// do something		
		}		
		
			
	/*	
		// optional - a custom page.  
		public function customPage()
		{
			$text = 'Hello World!';
			$otherField  = $this->getController()->getFieldVar('other_field_name');
			return $text;
			
		}
	*/
			
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
