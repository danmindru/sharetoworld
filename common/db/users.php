<?php

class dbUsers {
	
	/**
	 * Get users list
	 * 
	 * @return array
	 */
	public static function get_list () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM users
				  ORDER BY user_name ASC";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Get user informations using user_name
	 * 
	 * @param string $user_name
	 * @return array
	 */
	public static function get_by_user_name($user_name) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM users
		                  WHERE `user_name` = '%s'",
		                  $db->db_escape($user_name));
		                  
		 return $db->db_fetch($query);
	}
	
	/**
	 * Get user informations using user id
	 * 
	 * @param int $user_id
	 * @return array
	 */
	public static function get_by_id($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_id` = '%s'",
		                  $db->db_escape($user_id));
		                  
		 return $db->db_fetch($query);
	}
	
	/**
	 * Get user informations using user email address
	 * 
	 * @param string $user_email
	 * @return array
	 */
	public static function get_by_email($user_email) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_email` = '%s'",
		                  $db->db_escape($user_email));
		                  
		 return $db->db_fetch($query);
	}
	
	/**
	 * Create new user
	 * 
	 * @param array $data
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('users', $data);
	}
	
	/**
	 * Return user_name using user id
	 * 
	 * @param int $user_id
	 * @return string|null
	 */
	public static function get_user_name ($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_id` = '%s'",
		                  $db->db_escape($user_id));

		$result = $db->db_fetch($query);
		
		return $result ? $result['user_name'] : null;
	}
	
	/**
	 * Return user id using user_name
	 * 
	 * @param string $user_name
	 * @return int|null
	 */
	public static function get_id ($user_name) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_name` = '%s'",
		                  $db->db_escape($user_name));

		$result = $db->db_fetch($query);
		
		return $result ? $result['user_id'] : null;
	}
	
	/**
	 * Check if an user exist
	 * 
	 * @param string $user_name
	 * @return bool
	 */
	public static function exists($user_name) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_name` = '%s'",
		                  $db->db_escape($user_name));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Check if user_name and password is assigned to an account 
	 * 
	 * @param string $user_name
	 * @param string $password md5 password
	 */
	public static function is_correct_user_and_pass($user_name, $password) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users
		                  WHERE `user_name` = '%s' AND
		                  		`user_password` = '%s'",
		                  $db->db_escape($user_name), 
		                  $db->db_escape($password));
		
		$result = $db->db_query($query);

		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Update last login IP
	 * 
	 * @param int $user_id
	 * @param int $last_login_ip
	 * @return bool
	 */
	public static function update_last_login_ip ($user_id, $last_login_ip) {
		$db = db::get_instance();
		
		$query = sprintf("UPDATE users 
					      SET `user_last_login_ip` = '%s'
		                  WHERE `user_id` = '%s'",
		                  $db->db_escape($last_login_ip), 
		                  $db->db_escape($user_id));
		
		return ($db->db_query($query)) ? true : false;
	}
	
	/**
	 * Update last login timestamp
	 * 
	 * @param int $user_id
	 * @return bool
	 */
	public static function update_last_login_date ($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("UPDATE users 
					      SET `user_last_login_date` = '%s'
		                  WHERE `user_id` = '%s'",
		                  time(), 
		                  $db->db_escape($user_id));
		
		return ($db->db_query($query)) ? true : false;
	}
	
	
	/**
	 * Update user actkey
	 * 
	 * @param int $user_id
	 * @param string $new_actkey
	 * @return bool
	 */
	public static function update_actkey ($user_id, $new_actkey) {
		$db = db::get_instance();
		
		$query = sprintf("UPDATE users 
					      SET `user_activation_code` = '%s'
		                  WHERE `user_id` = '%s'",
		                  $db->db_escape($new_actkey), 
		                  $db->db_escape($user_id));
		
		return ($db->db_query($query)) ? true : false;
	}
	
	/**
	 * Update user password
	 * 
	 * @param int $user_id
	 * @param string $new_password
	 * @return bool
	 */
	public static function update_password ($user_id, $new_password) {
		$db = db::get_instance();
		$query = sprintf("UPDATE users 
					      SET `user_password` = '%s'
		                  WHERE `user_id` = '%s'",
		                  $db->db_escape($new_password), 
		                  $db->db_escape($user_id));
		
		return ($db->db_query($query)) ? true : false;
	}
	
	/**
	 * Update
	 * 
	 * @param int $user_id
	 * @param array $data
	 * @return bool
	 */
	public static function update ($user_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("user_id = '%s'", $db->db_escape($user_id));
		
		$result = $db->db_update('users', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Delete
	 * 
	 * @param int $user_id
	 */
	public static function delete ($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM users 
						  WHERE user_id='%s'",
						  $db->db_escape($user_id));

		return $db->db_query($query);
	}
}	
?>