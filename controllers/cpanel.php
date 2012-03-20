<?php

require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");
require_once(DB_DIR 		. "facebook.php");


/**
 * Home page controller class
 */
class cpanel implements IController {
	
	public function __construct() {}
	
	/**
	 * Display home page
	 */
	public function index() {
		$front 	= FrontController::get_instance();		
		
		$view  	= new View();
		$result = $view->fetch('index.tpl');
		$front->setBody($result);
	}
	
	public function addFacebook() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		if (request_is_post()) {
			//Process new account creation request
			
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect();
				}
				
				//Check if clicks value is number
				if (!is_numeric($_POST['facebook_clicks'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks value is bigger than 100
				if ($_POST['facebook_clicks'] > 100) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if points per click value is number
				if (!is_numeric($_POST['facebook_points_per_click'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if points per click value is bigger than 10
				if ($_POST['facebook_points_per_click'] > 10) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks * points per click
				if (($_POST['facebook_points_per_click'] * $_POST['facebook_clicks']) > $user->get_user_credits()) {
					flash_error('You have only ' . $user->get_user_credits() . ' credits. Do not cheat! ;)');
					redirect();	
				}
				
				//Check if page is already registered by current user
				if (dbFacebook::exists($_POST['facebook_url'], $user->get_user_id())) {
					flash_error('You already registered this Facebook Page.');
					redirect();					
				}
				
				//Add page to database 
				$data 					= array();
				$data['user_id'] 		= $user->get_user_id();
				$data['facebook_url']	= $_POST['facebook_url'];
				dbFacebook::create($data);
				
				//Display creation confirmation message
				flash_success('Your Facebook page was successfully registered.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		}
	}
}

?>