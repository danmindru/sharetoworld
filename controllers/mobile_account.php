<?php

require_once(FUNCTIONS_DIR 	. 'recaptcha.php');
require_once(FUNCTIONS_DIR 	. 'validate.php');
require_once(FUNCTIONS_DIR 	. 'email.php');
require_once(COMMON_DIR 	. "class-phpass.php");
require_once(DB_DIR 		. "sessions.php");
require_once(DB_DIR 		. "users.php");

/**
 * Time after that new recovery request is permited
 * 
 * Default: two days
 */
define('NEW_RECOVERY_ALLOW_TIME', 2 * 24 * 3600);


/**
 * This class/controller manage users
 */
class mobile_account implements IController {
	
	/**
	 * Login page
	 */
	public function login () {
		
		//Get user instance
		$user = User::get_instance();
		
		//Check if user is logged out
		$user->loggedout_required('mobile/');
		
		if (request_is_post()) {
			//Form submited. Process login request
			try {
					
				//Check if fields are empty
				if ($_POST['user_name'] == '' || $_POST['password'] == '') {
					flash_error('All fields are required');
					redirect('mobile_account/login/');
				}
				
				$user = array();
				$user = dbUsers::get_by_user_name($_POST['user_name']);
				
				$wp_hasher = new PasswordHash(8, TRUE);
				$check = $wp_hasher->CheckPassword(mysql_real_escape_string($_POST['password']), $user["user_password"]);
				
				if($check == false) {
					flash_warning('Invalid combination between username and password');
					redirect('mobile_account/login/');
				}
				
				if ($user['user_type'] == 'None') {
					flash_error('Login failed. Account is inactive.');
					redirect('mobile_account/login/');
				}
				
				//Delete session
				dbSessions::delete_session(session_id());
					
				//Generate new session id
				session_regenerate_id();
					
				//Update informations about user in sessions table
				dbSessions::create(session_id(), $user['user_id'], time(), time());
				
				//Update last login IP and last login time
				dbUsers::update_last_login_ip($user['user_id'], get_user_ip());
				dbUsers::update_last_login_date($user['user_id']);
				
				//Redirect user to homepage
				if (isset($_SESSION['login_referer']))
				{
					flash_success('Welcome back!');
					redirect('mobile/');	
				}
				else if (isset($_SERVER['HTTP_REFERER']))
				{
					flash_success('Welcome back!');
					redirect('mobile/');
				} else {
					echo "System Error";die;
				}
				
			} catch (Exception $e) {
				redirect('mobile_account/login');
			}			
		} else 	{
			$front = FrontController::get_instance();
			$view  = new View();
			
			//Display login form
			$result = $view->fetch('mobile/account/login.tpl');
			$front->setBody($result);
		}
	}
	
	/**
	 * Logout
	 */
	public function logout () {
		
		//Delete session
		dbSessions::delete_session(session_id());
		
		//Generate new session id
		session_regenerate_id();
			
		//Update informations about user in sessions table
		dbSessions::create(session_id(), 0, time(), time());
		
		//Redirect user to homepage
		redirect('mobile/');
	}
	
	/**
	 * Register page
	 */
	public function create () {
		
		if (request_is_post()) {
			//Process new account creation request
			
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					throw new Exception('All fields are required.');
				}
				
				//Check if password entered matches
				if ($_POST['password'] != $_POST['passwordagain']) {
					throw new Exception('Passwords does not match.');
				}
				
				//Check if email address is valid
				if (!is_valid_email($_POST['email'])) {
					throw new Exception('Email address is invalid.');
				}
				
				//Check if username already exist
				if (dbUsers::exists($_POST['user_name'])) {
					throw new Exception('Username is already registered.');
				}
			
				//Check if email already exist
				if (!is_null(dbUsers::get_by_email($_POST['email']))) {
					throw new Exception('Email address is already used by another account');
				}
			
				//Create account
				$wp_hasher 	= new PasswordHash(8, TRUE);
				$password 	= $wp_hasher->HashPassword($_POST['password']);
				
				$user['user_type'] 			= 'User';
				$user['user_name'] 			= $_POST['user_name'];
				$user['user_password'] 		= $password;
				$user['user_email'] 		= $_POST['email'];
				$user['user_register_ip'] 	= get_user_ip();
				
				//Create user account
				dbUsers::create($user);
				
				//Display account creation confirmation message
				flash_success('Your account was created. You may login.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect('mobile_account/create/');
			}
		} else {
			//Display form
			$front = FrontController::get_instance();
			$view  = new View();
			
			$result = $view->fetch('mobile/account/register.tpl');
			$front->setBody($result);
		}
	}
}

?>