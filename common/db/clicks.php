<?php

class dbClicks {
	
	/**
	 * Create new click
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('users_clicks', $data);
	}
	
	/**
	 * Get a clicks by user_id
	 * @param int $user_id
	 * 
	 * @return array 
	 */
	public static function get ($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM users_clicks
						  WHERE user_id = '%s'",
						  $db->db_escape($user_id));
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Check if a Facebook Click exists
	 * @param string $facebook_id
	 * @param int $user_id
	 * 
	 * @return bool
	 */
	public static function exists($facebook_id, $user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM users_clicks
		                  WHERE `facebook_id` = '%s' AND `user_id` = '%s'",
		                  $db->db_escape($facebook_id),
						  $db->db_escape($user_id));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
}

?>