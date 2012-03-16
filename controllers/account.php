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
					throw new Exception('All fields are required.');
				}
				
				$user = array();
				$user = dbUsers::get_by_user_name($_POST['user_name']);
				
				$wp_hasher = new PasswordHash(8, TRUE);
				$check = $wp_hasher->CheckPassword(mysql_real_escape_string($_POST['password']), $user["user_password"]);
				
				if($check == false) {
					flash_error('Invalid combination between username and password');
					redirect();
				}
				
				if ($user['user_type'] == 'None') {
					throw new Exception('Login failed. Account is inactive.');
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
					redirect('');	
				}
				else if (isset($_SERVER['HTTP_REFERER']))
				{
					redirect(get_internal_page($_SERVER['HTTP_REFERER']));
				} else {
					echo "System Error";die;
				}
				
			} catch (Exception $e) {
				redirect('account/login');
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
				redirect('account/create/');
			}
		} else {
			//Display form
			$front = FrontController::get_instance();
			$view  = new View();
			
			$result = $view->fetch('account/register.tpl');
			$front->setBody($result);
		}
	}
	
	public function edit () {
		//Get user instance
		$user = User::get_instance();
		
		if (request_is_post()) {			
			try {
				//Check if all fields are filled
				if (exist_empty_fields($_POST)) {
					throw new Exception('All fields are required.');
				}
				
				
				$images 		= array('image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10');
				$savedImages 	= array();
				
				foreach ($images as $img) {
					//reads the name of the file the user submitted for uploading
				 	$image = $_FILES[$img]['name'];
				 	//if it is not empty
				 	if ($image) 
				 	{
					 	//get the original name of the file from the clients machine
				 		$filename 	= stripslashes($image);
					 	//get the extension of the file in a lower case format
				  		$extension 	= getExtension($filename);
				 		$extension 	= strtolower($extension);
					 	//if it is not a known extension, we will suppose it is an error and will not  upload the file,  
						//otherwise we will do more tests
					 	if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) 
				 		{
							throw new Exception('Unknown image type.');
				 		}
				 		else
				 		{
							 //get the size of the image in bytes
							 //$_FILES[$img]['tmp_name'] is the temporary filename of the file
							 //in which the uploaded file was stored on the server
							 $size = filesize($_FILES[$img]['tmp_name']);
				
							//compare the size with the maxim size we defined and print error if bigger
							if ($size > MAX_SIZE*1024)
							{
								throw new Exception('You have exceeded the size limit!');
							}
				
							//we will give an unique name, for example the time in unix time format
							$rand 		= rand(0, 1000000);
							$image_name = $rand . time().'.'.$extension;
							//the new name will be containing the full path where will be stored (images folder)
							$newname	= ROOT_DIR . "static/images/uploads/" . $image_name;
							
							//we verify if the image has been uploaded, and print error instead
							$copied = copy($_FILES[$img]['tmp_name'], $newname);
							
							if (!$copied) 
							{
								throw new Exception('Copy unsuccessfull!');
							}
							
							//Add watermark
							$logo = URL_STATIC . 'images/logo.png';
							watermark($newname, $logo, $newname);
							
							//Create thumbnail
							$thumb_address = ROOT_DIR . "static/images/uploads/thumbs/" . $image_name;
							redimensionare_poza($newname, $thumb_address, 100, 90, 60);

							//Create profile-thumbnail
							$destination = ROOT_DIR . "static/images/uploads/profile/" . $image_name;
							profile_picture($newname, 140, 105, $destination);
							
							//Add name to profile-thumbnail
							$spacer = ROOT_DIR . "static/images/name.jpg";
							write_name($destination, $spacer, $_POST['name'], $destination);
							
							$savedImages[] = $image_name;
				 		}
				 	}
				}
				
				//Get user id
				$user_id = $user->get_user_id();
				
				$profileImage = 0;
				
				//Add images
				foreach ($savedImages as $image) {
					$data = array();
					$data['user_id'] 	= $user_id;
					$data['image_name'] = $image;
					if($profileImage == 0) {
						$profileImage = dbUsersImages::create($data);	
					} else {
						dbUsersImages::create($data);
					}
				}
				
				if(dbUsersProfile::exists($user_id)) {
					$data = array();
					$data['profile_name'] 			= $_POST['name'];
					$data['profile_type'] 			= $_POST['type'];
					$data['profile_age'] 			= $_POST['age'];
					$data['profile_measurements'] 	= $_POST['measurements'];
					$data['profile_hours'] 			= $_POST['hours'];
					$data['profile_height'] 		= $_POST['height'];
					$data['profile_weight'] 		= $_POST['weight'];
					$data['profile_sector'] 		= $_POST['sector'];
					$data['profile_attention'] 		= $_POST['attention'];
					$data['profile_smoking'] 		= $_POST['smoking'];
					$data['profile_phone'] 			= $_POST['phone'];
					$data['profile_price'] 			= $_POST['price'];
					$data['profile_approved'] 		= 0;
					dbUsersProfile::update($user_id, $data);	
				} else {
					$data = array();
					$data['user_id'] 				= $user_id;
					$data['profile_name'] 			= $_POST['name'];
					$data['profile_type'] 			= $_POST['type'];
					$data['profile_age'] 			= $_POST['age'];
					$data['profile_measurements'] 	= $_POST['measurements'];
					$data['profile_hours'] 			= $_POST['hours'];
					$data['profile_height'] 		= $_POST['height'];
					$data['profile_weight'] 		= $_POST['weight'];
					$data['profile_sector'] 		= $_POST['sector'];
					$data['profile_attention'] 		= $_POST['attention'];
					$data['profile_smoking'] 		= $_POST['smoking'];
					$data['profile_phone'] 			= $_POST['phone'];
					$data['profile_price'] 			= $_POST['price'];
					$data['image_id'] 				= $profileImage;
					$data['profile_approved'] 		= 0;
					dbUsersProfile::create($data);
				}
				
				//Display confirmation message
				flash_success('Your profile was updated.');
				redirect('account/edit/');
				
			} catch (Exception $e) {
				//Flash error message if an error eccured
				flash_error($e->getMessage());
				redirect('account/edit/');
			}
		} else {
			//Display form
			$front	= FrontController::get_instance();
			$view  	= new View();
			
			$user_id = $user->get_user_id();
			if(dbUsersProfile::exists($user_id)) {
				$profile = dbUsersProfile::get_by_id($user_id);
				
				$view->assign('profile', $profile);
			}
			
			$result = $view->fetch('account/edit.tpl');
			$front->setBody($result);
		}
	}
}

?>