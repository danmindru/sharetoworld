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
		$front 	= FrontController::get_instance();
		
		$view  	= new View();
		$result = $view->fetch('networks/index.tpl');
		$front->setBody($result);
	}
	
	public function yournetworks() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		
		$pages 	= dbFacebook::get_all_for_user($user->get_user_id());
		
		$view  	= new View();
		$view	->assign('facebook', $pages);
		$result = $view->fetch('networks/yourNetworks.tpl');
		$front->setBody($result);
	}
	
	public function twitter() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		
		$pages 	= dbFacebook::get_all_for_user($user->get_user_id());
		
		$view  	= new View();
		$view	->assign('facebook', $pages);
		$result = $view->fetch('networks/twitter.tpl');
		$front->setBody($result);
	}
	
	
}

?>