<?php

require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");


/**
 * Home page controller class
 */
class about implements IController {
	
	public function __construct() {}
	
	/**
	 * Display home page
	 */
	public function index() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/index.tpl');
		$front->setBody($result);
	}
	
	public function terms() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/terms.tpl');
		$front->setBody($result);
	}
	
	public function aboutus() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/about-us.tpl');
		$front->setBody($result);
	}
	
	public function policy() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/policy.tpl');
		$front->setBody($result);
	}
	
	public function contact() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/contact.tpl');
		$front->setBody($result);
	}
	
	public function faq() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/faq.tpl');
		$front->setBody($result);
	}

	public function help() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('about/help.tpl');
		$front->setBody($result);
	}
}

?>