<?php

class dbGoogle {
	
	/**
	 * Create new page
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('google_api', $data);
	}
	
	/**
	 * Get a page using id
	 * @param int $google_id
	 * 
	 * @return array 
	 */
	public static function get ($google_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM google_api
						  WHERE google_id = '%s'",
						  $db->db_escape($google_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get a page using id
	 * @param int $google_id
	 * 
	 * @return array 
	 */
	public static function get_by_id ($google_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM google_api
						  WHERE google_id = '%s'",
						  $db->db_escape($google_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get pages
	 * 
	 * @return array
	 */
	public static function get_all () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM google_api";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Get pages
	 * 
	 * @return array
	 */
	public static function get_all_for_user ($user_id) {
		$db = db::get_instance();
		
		$db = db::get_instance();
		
		$query = sprintf("	SELECT * 
							FROM google_api 
							WHERE google_id NOT IN (
								SELECT google_id 
								FROM users_clicks 
								WHERE users_clicks.user_id = '%s') 	
							AND google_status != 'disabled' ORDER BY google_points_per_plus DESC LIMIT 6",
						$db->db_escape($user_id));	
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Update
	 * @param int $google_id
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function update ($google_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("google_id = '%s'", $db->db_escape($google_id));
		
		$result = $db->db_update('google_api', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Check if a page exists
	 * @param string $google_url
	 * @param int $user_id
	 * 
	 * @return bool
	 */
	public static function exists($google_url, $user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM google_api
		                  WHERE `google_url` = '%s' AND `user_id` = '%s'",
		                  $db->db_escape($google_url),
						  $db->db_escape($user_id));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Delete
	 * @param int $google_id
	 */
	public static function delete ($google_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM google_api 
						  WHERE google_id='%s'",
						  $db->db_escape($google_id));

		return $db->db_query($query);
	}
}

?>