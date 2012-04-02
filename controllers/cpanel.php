<?php

require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");
require_once(DB_DIR 		. "levels.php");
require_once(DB_DIR 		. "clicks.php");
require_once(DB_DIR 		. "facebook.php");
require_once(DB_DIR 		. "twitter.php");
require_once(DB_DIR 		. "google.php");


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
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();		
		
		$view  	= new View();
		$result = $view->fetch('index.tpl');
		$front->setBody($result);
	}
	
	public function addFacebook() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
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
				
				//Check if clicks value is smaller than 1
				if ($_POST['facebook_clicks'] < 1) {
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
				
				$level = dbLevels::get($user->get_user_level());
				
				//Check if points per click value is bigger than user's maximum points per click
				if ($_POST['facebook_points_per_click'] > $level['level_points_per_click']) {
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
				$data 								= array();
				$data['user_id'] 					= $user->get_user_id();
				$data['facebook_url']				= $_POST['facebook_url'];
				$data['facebook_points_per_click']	= $_POST['facebook_points_per_click'];
				$data['facebook_requested_clicks']	= $_POST['facebook_clicks'];
				dbFacebook::create($data);
				
				//Get the user's points for the page
				$data					= array();
				$data['user_credits']	= $user->get_user_credits() - ($_POST['facebook_points_per_click'] * $_POST['facebook_clicks']);				
				dbUsers::update($user->get_user_id(), $data);
				
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

	public function facebookLike() {
		$user	= User::get_instance();
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		//Get the liked page
		$page 	= dbFacebook::get_by_id($_GET['ref']); 
		
		if(!dbClicks::exists($page['facebook_id'], $user->get_user_id())) {
			//Increase Page Clicks
			$data						= array();
			$data['facebook_clicks'] 	= $page['facebook_clicks'] + 1;
			 
			if( $data['facebook_clicks'] >= $page['facebook_requested_clicks'] ) {
				//Disable page if it reached requested clicks
				$data['facebook_status'] = 'disabled';
			}
			dbFacebook::update($page['facebook_id'], $data);
			
			//Create user click
			$data					= array();
			$data['facebook_id'] 	= $page['facebook_id'];
			$data['user_id']		= $user->get_user_id();
			$data['click_type']		= 'clicked';
			$data['click_date']		= time();
			dbClicks::create($data);
			
			//Add earned credits to user's credits
			$data					= array();
			$data['user_credits']	= $user->get_user_credits() + $page['facebook_points_per_click'];
			dbUsers::update($user->get_user_id(), $data);
		}
	}

	public function addTwitter() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		if (request_is_post()) {
			//Process new account creation request
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect();
				}
				
				//Check if clicks value is number
				if (!is_numeric($_POST['twitter_clicks'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks value is smaller than 1
				if ($_POST['twitter_clicks'] < 1) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks value is bigger than 100
				if ($_POST['twitter_clicks'] > 100) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if points per click value is number
				if (!is_numeric($_POST['twitter_points_per_click'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				$level = dbLevels::get($user->get_user_level());
				
				//Check if points per click value is bigger than user's level points per click
				if ($_POST['twitter_points_per_click'] > $level['level_points_per_click']) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks * points per click
				if (($_POST['twitter_points_per_click'] * $_POST['twitter_clicks']) > $user->get_user_credits()) {
					flash_error('You have only ' . $user->get_user_credits() . ' credits. Do not cheat! ;)');
					redirect();	
				}
				
				//Check if page is already registered by current user
				if (dbTwitter::exists($_POST['twitter_url'], $user->get_user_id())) {
					flash_error('You already registered this Twitter Account.');
					redirect();					
				}
				
				//Add page to database 
				$data 								= array();
				$data['user_id'] 					= $user->get_user_id();
				$data['twitter_url']				= $_POST['twitter_url'];
				$data['twitter_points_per_follow']	= $_POST['twitter_points_per_click'];
				$data['twitter_requested_follows']	= $_POST['twitter_clicks'];
				dbTwitter::create($data);
				
				//Get the user's points for the page
				$data					= array();
				$data['user_credits']	= $user->get_user_credits() - ($_POST['twitter_points_per_click'] * $_POST['twitter_clicks']);				
				dbUsers::update($user->get_user_id(), $data);
				
				//Display creation confirmation message
				flash_success('Your Twitter Account was successfully registered.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		}
	}

	public function twitterFollow() {
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		//Check if user is loggein
		$user->loggedin_required();
		
		//Get the liked page
		$page 	= dbTwitter::get_by_id($_GET['ref']); 
		
		if(!dbClicks::twitter_exists($page['twitter_id'], $user->get_user_id())) {
			//Increase Page Clicks
			$data						= array();
			$data['twitter_follows'] 	= $page['twitter_follows'] + 1;
			 
			if( $data['twitter_follows'] >= $page['twitter_requested_follows'] ) {
				//Disable page if it reached requested clicks
				$data['twitter_status'] = 'disabled';
			}
			dbTwitter::update($page['twitter_id'], $data);
			
			//Create user click
			$data					= array();
			$data['twitter_id'] 	= $page['twitter_id'];
			$data['user_id']		= $user->get_user_id();
			$data['click_type']		= 'clicked';
			$data['click_date']		= time();
			dbClicks::create($data);
			
			//Add earned credits to user's credits
			$data					= array();
			$data['user_credits']	= $user->get_user_credits() + $page['twitter_points_per_follow'];
			dbUsers::update($user->get_user_id(), $data);
		}
	}

	public function addGoogle() {
		$front 	= FrontController::get_instance();	
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		$user->confirmed_required();
		
		if (request_is_post()) {
			//Process new account creation request
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect();
				}
				
				//Check if clicks value is number
				if (!is_numeric($_POST['google_clicks'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks value is smaller than 1
				if ($_POST['google_clicks'] < 1) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks value is bigger than 100
				if ($_POST['google_clicks'] > 100) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if points per click value is number
				if (!is_numeric($_POST['google_points_per_click'])) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				$level = dbLevels::get($user->get_user_level());
				
				//Check if points per click value is bigger than user's points per click
				if ($_POST['google_points_per_click'] > $level['level_points_per_click']) {
					flash_error('Do not cheat! ;)');
					redirect();	
				}
				
				//Check if clicks * points per click
				if (($_POST['google_points_per_click'] * $_POST['google_clicks']) > $user->get_user_credits()) {
					flash_error('You have only ' . $user->get_user_credits() . ' credits. Do not cheat! ;)');
					redirect();	
				}
				
				//Check if page is already registered by current user
				if (dbGoogle::exists($_POST['google_url'], $user->get_user_id())) {
					flash_error('You already registered this Google Plus Account.');
					redirect();					
				}
				
				//Add page to database 
				$data 								= array();
				$data['user_id'] 					= $user->get_user_id();
				$data['google_url']					= $_POST['google_url'];
				$data['google_points_per_plus']	= $_POST['google_points_per_click'];
				$data['google_requested_plus']	= $_POST['google_clicks'];
				dbGoogle::create($data);
				
				//Get the user's points for the page
				$data					= array();
				$data['user_credits']	= $user->get_user_credits() - ($_POST['google_points_per_click'] * $_POST['google_clicks']);				
				dbUsers::update($user->get_user_id(), $data);
				
				//Display creation confirmation message
				flash_success('Your Google Plus Account was successfully registered.');
				redirect();
				
			} catch (Exception $e) {
				echo "eror";die;
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		}
	}
}
?>