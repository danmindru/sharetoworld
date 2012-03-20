<?php
require_once(DB_DIR . "sessions.php");
require_once(DB_DIR . "users.php");

class User implements ArrayAccess {
	/**
	 * User class instance
	 *
	 * @var User
	 */
    protected static $_instance;
    
    /**
     * All informations about user
     * 
     * @var bool
     */
    protected $_user;
    
    /**
     * Class constructor
     * 
     * @return User
     */
    protected function __construct() {
    	//Start session
    	$this->session_start();
    }
    
	/**
	 * Return User instance
	 * If not exisst reate one
	 *
	 * @return User
	 */
    public static function get_instance() {
        if ( ! (self::$_instance instanceof self) ) {
            self::$_instance = new self();
        }
        
        return self::$_instance;
    }
    
	/**
	 * Start session
	 */
	protected function session_start () {
		//Set sessions parameters
		session_set_cookie_params(SESSION_LIFETIME_SECONDS, URL_PREFIX, COOKIE_DOMAIN);
		
		//Start session
		session_start();
		
		//Delete old sessions from database
		dbSessions::delete_old_sessions(time() - SESSION_LIFETIME_SECONDS);
		
		//Check if user have an opened session in database
		//If does not exist create
		if (!dbSessions::session_exist(session_id())) {
			session_regenerate_id();
			dbSessions::create(session_id(), 0, time(), time());
		}
		
		//Check if user is logged in
		if (($user['id'] = dbSessions::get_user_id_from_session(session_id())) != 0) {
			//Set that user is logged in
			$user['is_loggedin'] 	= true;
			
			//get user by id
			$info 					= dbUsers::get_by_id($user['id']);
			$user['user_name'] 		= $info['user_name'];
			$user['user_credits'] 	= $info['user_credits'];
			
			if($info['user_type'] == 'administrator') {
				$user['is_admin'] = true;	
			} else if ($info['user_type'] == 'moderator') {
				$user['is_moderator'] = true;	
			}
					
		} else {
			//Set that user is not loged in
			//User id = 0
			$user['is_loggedin'] = false;
			$user['is_admin'] = false;
			$user['is_moderator'] = false;
		}
		
		//Save new informations in class global variable
		$this->_user = $user;
	}
	
    /**
     * Check if user is logged in
     * 
     * @return bool
     */
    public function is_loggedin () {
    	return $this->_user['is_loggedin'];
    }
    
    /**
     * Check if user is administrator
     * 
     * @return bool
     */
    public function is_admin () {
    	return $this->_user['is_admin'];
    }
    
    /**
     * Check if user is moderator
     * 
     * @return bool
     */
    public function is_moderator () {
    	return $this->_user['is_moderator'];
    }
    
    /**
     * Return all available informations about user
     * 
     * @return array
     */
    public function get_all_info () {
    	return $this->_user;
    }
    
    /**
     * Return user id
     * 
     * @return int
     */
	public function get_user_id () {
    	return $this->_user['id'];
    }

	/**
     * Return user credits
     * 
     * @return int
     */
	public function get_user_credits () {
    	return $this->_user['user_credits'];
    }
   
  
	/**
     * Check if user is loged in
     * If not redirect login page
     */
    public function loggedin_required () {
		if (!$this->is_loggedin()) {
			flash_error('Pentru a avea acces trebuie sa te autentifici!');
			redirect('account/login');
		}	
    }
    
	/**
     * Check if user is logged out
     * If not redirect home page
     */
    public function loggedout_required ($url = '') {
		if ($this->is_loggedin()) {
			flash_error('Access denied!');
			redirect($url);
		}	
    }
    
	/**
     * Check if id is mine
     * If not redirect home page
     */
    public function id_is_mine ($id) {
		if ($this->get_user_id() != $id){
			flash_error('Access denied!');
			redirect('');
		}	
    }
	    
	 /**
     * Check if user is administrator
     * If not redirect to homepage and display an error message
     */
    public function admin_required () {
		if (!$this->is_loggedin() || !$this->is_admin()) {
			flash_error('Access denied');
			redirect();
		}	
    }
   	 
	 /**
     * Check if user is moderator
     * If not redirect to homepage and display an error message
     */
    public function moderator_required () {
		if (!$this->is_loggedin() || (!$this->is_moderator() && !$this->is_admin())) {
			flash_error('Access denied');
			redirect();
		}	
    }
    
	 /**
     * Set array value
     * 
     * @param $offset
     * @param $value
     */
	public function offsetSet($offset, $value) {
		$this->_user[$offset] = $value;
	}
	
	/**
	 * Return an array entry
	 * 
	 * @param string $offset
	 */
	public function offsetGet($offset) {
		return $this->_user[$offset];
	}
	
	/**
	 * Check if an index ixists
	 * 
	 * @param string $offset
	 */
	public function offsetExists($offset) {
		return array_key_exists($offset, $this->_user);
	}
	
	/**
	 * Unset an index from string
	 * 
	 * @param string $offset
	 */
	public function offsetUnset($offset) {
		unset($this->_user[$offset]);
	}
}

?>