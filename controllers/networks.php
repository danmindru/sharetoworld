<?php

require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");
require_once(DB_DIR 		. "facebook.php");
require_once(DB_DIR 		. "twitter.php");


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
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		$view  	= new View();
		$result = $view->fetch('networks/index.tpl');
		$front->setBody($result);
	}
	
	public function facebook() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();	
		
		$pages 	= dbFacebook::get_all_for_user($user->get_user_id());
		$count	= count($pages);
		
		if($count == 0) {
			$message = "There are no more links for now. Please check other social networks.";
		} else {
			$message = "";
		}
		
		$view  	= new View();
		$view	->assign('facebook', $pages);
		$view	->assign('count', 	 $count);
		$view	->assign('message',  $message);		
		$result = $view->fetch('networks/facebook.tpl');
		$front->setBody($result);
	}
	
	public function twitter() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		$pages 	= dbTwitter::get_all_for_user($user->get_user_id());
		$count	= count($pages);
		
		if($count == 0) {
			$message = "There are no more links for now. Please check other social networks.";
		} else {
			$message = "";
		}
			
		$view  	= new View();
		$view	->assign('twitter', $pages);
		$view	->assign('count', 	 $count);
		$view	->assign('message',  $message);
		$result = $view->fetch('networks/twitter.tpl');
		$front->setBody($result);
	}
	
	
}

?>