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
				
				if ($user['user_type'] == 'none') {
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
				
				
				//Redirect user to profile page if it is not created
				if ($user['user_type'] == 'unconfirmed') {
					flash_info('Please complete your profile before using our services');
					redirect('account/profile');
				}
				
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
		
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		
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
		$user   = User::get_instance();	
		
		$user->loggedout_required();
		
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
				
				$data								= array();
				$data['user_type'] 					= 'Unconfirmed';
				$data['user_name'] 					= $_POST['user_name'];
				$data['user_password'] 				= $password;
				$data['user_email'] 				= $_POST['email'];
				$data['user_country'] 				= $_POST['country'];
				$data['user_confirmation_code'] 	= md5(time()) . '' .rand(0,666) . '';
				$data['user_register_ip'] 			= get_user_ip();
				
				//Create user account
				dbUsers::create($data);
				
				$to      = $_POST['email'];
				$subject = 'Share To World - Account Activation';
				$message = 'Hello ' . $data["user_name"] . ',' . "\r\n" . '' . "\r\n" . 'Welcome to the Share To World Community - a free service that connects people via social networks.' . "\r\n" . 'We hope you will have a great experience on our website. '. "\r\n" . ''. "\r\n" . 'Your Activation Code is: ' . $data["user_confirmation_code"] . ' ' . "\r\n" . 'Please enter the code when you login for the first time.' . "\r\n" . '' . "\r\n" . 'Best regards,' . "\r\n" . 'Share To World Team' . "\r\n" . 'http://www.sharetoworld.com';
				$headers = 'From: noreply@sharetoworld.com' . "\r\n" . 'Reply-To: webmaster@sharetoworld.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
				
				mail($to, $subject, $message, $headers);
				
				//Display account creation confirmation message
				flash_success('Your account was created. Check your email for your activation code.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		}
	}
	
	/**
	 * Reset Password page
	 */
	public function resetPassword () {
		$user   = User::get_instance();	
		
		$user->loggedout_required();
		
		if (request_is_post()) {
			//Process password reset
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect('account/resetPassword');
				}
				
				//Check if email address is valid
				if (!is_valid_email($_POST['email'])) {
					flash_error('Email address is invalid.');
					redirect('account/resetPassword');
				}

				
				$info 		= dbUsers::get_by_email($_POST['email']);
				
				if($info['user_email'] == $_POST['email']) {
					
					$new_password 	= generate_string(8);
					$wp_hasher 		= new PasswordHash(8, TRUE);
					$password 		= $wp_hasher->HashPassword($new_password);
					
					$data								= array();
					$data['user_password'] 				= $password;
					
					//Update user password
					dbUsers::update($info['user_id'], $data);
					
					$to      = $_POST['email'];
					$subject = 'Share To World - New Password was set';
					$message = 'Hello ' . $info["user_name"] . ',' . "\r\n" . '' . "\r\n" . 'Your new password is: ' . $new_password . '' . "\r\n" . '' . "\r\n" . 'You can now login on our website using this password. '. "\r\n" . '' . "\r\n" . 'Best regards,' . "\r\n" . 'Share To World Team' . "\r\n" . 'http://www.sharetoworld.com';
					$headers = 'From: noreply@sharetoworld.com' . "\r\n" . 'Reply-To: webmaster@sharetoworld.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					
					mail($to, $subject, $message, $headers);
					
					flash_success('Your password was reseted. Please check your email.');
					redirect();
					
				} else {
					flash_error('Email address is registered.');
					redirect('account/resetPassword');
				}
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		} else {
			$front 	= FrontController::get_instance();
			$user	= User::get_instance(); 
	
			$view  	= new View();
			$result = $view->fetch('account/resetPassword.tpl');
			$front->setBody($result);
		}
	}

	/**
	 * Change Password page
	 */
	public function changePassword () {
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		
		if (request_is_post()) {
			//Process password change
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					flash_warning('All fields are required.');
					redirect('account/changePassword');
				}
				
				//Check if password entered matches
				if ($_POST['password'] != $_POST['passwordagain']) {
					flash_error('Passwords does not match.');
					redirect('account/changePassword');
				}
				
				$info 			= dbUsers::get_by_id($user->get_user_id()); 
				
				$wp_hasher 		= new PasswordHash(8, TRUE);
				$password 		= $wp_hasher->HashPassword($_POST['password']);
					
				$data								= array();
				$data['user_password'] 				= $password;
					
				//Update user password
				dbUsers::update($info['user_id'], $data);
					
				$to      = $_POST['email'];
				$subject = 'Share To World - Your new password';
				$message = 'Hello ' . $info["user_name"] . ',' . "\r\n" . '' . "\r\n" . 'Your new password is: ' . $_POST['password'] . '' . "\r\n" . '' . "\r\n" . 'You can now login on our website using this password. '. "\r\n" . '' . "\r\n" . 'Best regards,' . "\r\n" . 'Share To World Team' . "\r\n" . 'http://www.sharetoworld.com';
				$headers = 'From: noreply@sharetoworld.com' . "\r\n" . 'Reply-To: webmaster@sharetoworld.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					
				mail($to, $subject, $message, $headers);
					
				flash_success('Your password was changed. Please check your email.');
				redirect();
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		} else {
			$front 	= FrontController::get_instance();
			$user	= User::get_instance(); 
	
			$view  	= new View();
			$result = $view->fetch('account/changePassword.tpl');
			$front->setBody($result);
		}
	}
	
	/**
	 * Profile page
	 */
	public function profile () {
		$user   = User::get_instance();	
		
		$user->loggedin_required();
		
		if (request_is_post()) {
			//Process new account creation request
			try {
				//Check if all fields are filled
				if (!isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['confirmation_code'])) {
					flash_warning('All fields are required. [Note: Website field is optional]');
					redirect('account/profile');
				}
				
				$info = dbUsers::get_by_id($user->get_user_id());
				
				if (mysql_real_escape_string($_POST['confirmation_code']) != $info['user_confirmation_code']) {
					flash_error('Invalid activation code. Please try again.');
					redirect('account/profile');
				}
				
				$data								= array();
				$data['user_first_name'] 			= $_POST['firstname'];
				$data['user_last_name'] 			= $_POST['lastname'];
				$data['user_website'] 				= $_POST['website'];
				$data['user_confirmation_entered'] 	= $_POST['confirmation_code'];
				$data['user_type']					= 'user';
				
				//Update user' account
				dbUsers::update($user->get_user_id(), $data);
				
				//Display account creation confirmation message
				flash_success('Your profile was updated.');
				redirect();
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect();
			}
		} else {
			$front 	= FrontController::get_instance();
			$user	= User::get_instance(); 
	
			$view  	= new View();
			$result = $view->fetch('account/profile.tpl');
			$front->setBody($result);
		}
	}
}

?>