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
class account implements IController {
	
	/**
	 * Login page
	 */
	public function login () {
		
		//Get user instance
		$user = User::get_instance();
		
		//Check if user is logged out
		$user->loggedout_required();
		
		if (request_is_post()) {
			//Form submited. Process login request
			try {
					
				//Check if fields are empty
				if ($_POST['user_name'] == '' || $_POST['password'] == '') {
					flash_error('All fields are required');
					redirect('');
				}
				
				$user = array();
				$user = dbUsers::get_by_user_name($_POST['user_name']);
				
				$wp_hasher = new PasswordHash(8, TRUE);
				$check = $wp_hasher->CheckPassword(mysql_real_escape_string($_POST['password']), $user["user_password"]);
				
				if($check == false) {
					flash_warning('Invalid combination between username and password');
					redirect('');
				}
				
				if ($user['user_type'] == 'None') {
					flash_error('Login failed. Account is inactive.');
					redirect('');
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
					redirect('');	
				}
				else if (isset($_SERVER['HTTP_REFERER']))
				{
					flash_success('Welcome back!');
					redirect('');
				} else {
					echo "System Error";die;
				}
				
			} catch (Exception $e) {
				redirect('');
			}			
		} else 	{
			$front = FrontController::get_instance();
			$view  = new View();
	
			//Get source url to redirect back after login
			if (isset($_SERVER['HTTP_REFERER'])) {
				$_SESSION['login_referer'] = get_internal_page($_SERVER['HTTP_REFERER']);
			} else {
				$_SESSION['login_referer'] = '';
			}
			
			//Display login form
			$result = $view->fetch('account/login.tpl');
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
		redirect();
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
					flash_warning('All fields are required.');
					redirect();
				}
				
				//Check if password entered matches
				if ($_POST['password'] != $_POST['passwordagain']) {
					flash_error('Passwords does not match.');
					redirect();
				}
				
				//Check if email address is valid
				if (!is_valid_email($_POST['email'])) {
					flash_error('Email address is invalid.');
					redirect();
				}
				
				if($_POST['terms'] != "terms") {
					flash_error('You must accept the Terms and Conditions.');
					redirect();
				}
				
				//Check if username already exist
				if (dbUsers::exists($_POST['user_name'])) {
					flash_error('Username is already registered.');
					redirect();					
				}
			
				//Check if email already exist
				if (!is_null(dbUsers::get_by_email($_POST['email']))) {
					flash_warning('Email address is already used by another account');
					redirect();			
				}
			
				//Create account
				$wp_hasher 	= new PasswordHash(8, TRUE);
				$password 	= $wp_hasher->HashPassword($_POST['password']);
				
				$user['user_type'] 					= 'User';
				$user['user_name'] 					= $_POST['user_name'];
				$user['user_password'] 				= $password;
				$user['user_email'] 				= $_POST['email'];
				$user['user_country'] 				= $_POST['country'];
				$user['user_confirmation_code'] 	= md5(time()) . '{' .rand(0,6666) . '}' . md5($_POST['email']);
				$user['user_register_ip'] 			= get_user_ip();
				
				//Create user account
				dbUsers::create($user);
				
				$to      = $_POST['email'];
				$subject = 'Share To World - Account Activation';
				$message = 'Your Activation Code is:' . $user["user_confirmation_code"] . '. You will have to enter it when you login for the first time.';
				$headers = 'From: noreply@sharetoworld.com' . "\r\n" . 'Reply-To: webmaster@sharetoworld.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				
				mail($to, $subject, $message, $headers);
				
				//Display account creation confirmation message
				flash_success('Your account was created. You may login.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		}
	}
	
	/**
	 * Profile page
	 */
	public function profile () {
		
		if (request_is_post()) {
			//Process new account creation request
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect();
				}
				
				$user['user_first_name'] 			= $_POST['firstname'];
				$user['user_last_name'] 			= $_POST['lastname'];
				$user['user_website'] 				= $_POST['website'];
				$user['user_confirmation_code'] 	= $_POST['confirmation_code'];
				
				//Update user' account
				dbUsers::update($user);
				
				//Display account creation confirmation message
				flash_success('Your profile was created.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		} else {
			$front = FrontController::get_instance();
	
			$view  	= new View();
			$result = $view->fetch('account/profile.tpl');
			$front->setBody($result);
		}
	}
}

?>