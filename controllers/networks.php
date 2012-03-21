<?php

require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");
require_once(DB_DIR 		. "facebook.php");


/**
 * Home page controller class
 */
class networks implements IController {
	
	public function __construct() {}
	
	/**
	 * Display home page
	 */
	public function index() {
		$user	= User::get_instance();
	
		$data					= array();
		$data['facebook_url'] 	= $_GET['url'];
		$data['user_id']		= $user->get_user_id();
		
		dbFacebook::create($data);
	}
	
	public function yournetworks() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$pages 	= dbFacebook::get_all();
		
		$view  	= new View();
		$view	->assign('facebook', $pages);
		$result = $view->fetch('networks/yourNetworks.tpl');
		$front->setBody($result);
	}
	
	
}

?>