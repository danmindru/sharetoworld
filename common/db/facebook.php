<?php

class dbFacebook {
	
	/**
	 * Create new page
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('facebook_api', $data);
	}
	
	/**
	 * Get a page using id
	 * @param int $facebook_id
	 * 
	 * @return array 
	 */
	public static function get ($facebook_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM facebook_api
						  WHERE facebook_id = '%s'",
						  $db->db_escape($facebook_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get pages
	 * 
	 * @return array
	 */
	public static function get_all () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM facebook_api";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Update
	 * @param int $facebook_id
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function update ($facebook_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("facebook_id = '%s'", $db->db_escape($facebook_id));
		
		$result = $db->db_update('facebook_api', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Check if a page exists
	 * @param string $facebook_url
	 * @param int $user_id
	 * 
	 * @return bool
	 */
	public static function exists($facebook_url, $user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM facebook_api
		                  WHERE `facebook_url` = '%s' AND `user_id` = '%s'",
		                  $db->db_escape($facebook_url),
						  $db->db_escape($user_id));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Delete
	 * @param int $facebook_id
	 */
	public static function delete ($facebook_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM facebook_api 
						  WHERE facebook_id='%s'",
						  $db->db_escape($facebook_id));

		return $db->db_query($query);
	}
}

?>