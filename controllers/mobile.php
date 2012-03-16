<?php

require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");


/**
 * Home page controller class
 */
class mobile implements IController {
	
	public function __construct() {}
	
	/**
	 * Display home page
	 */
	public function index() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('mobile/index.tpl');
		$front->setBody($result);
	}
}

?>