<?php

require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");
require_once(DB_DIR 		. "facebook.php");
require_once(DB_DIR 		. "twitter.php");


/**
 * Home page controller class
 */
class pages implements IController {
	
	public function __construct() {}
	
	/**
	 * Display home page
	 */
	public function index() {
		$front 	= FrontController::get_instance();
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		$view  	= new View();
		$result = $view->fetch('pages/index.tpl');
		$front->setBody($result);
	}
}

?>