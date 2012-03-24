<?php

class dbTwitter {
	
	/**
	 * Create new page
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('twitter_api', $data);
	}
	
	/**
	 * Get a page using id
	 * @param int $twitter_id
	 * 
	 * @return array 
	 */
	public static function get ($twitter_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM twitter_api
						  WHERE twitter_id = '%s'",
						  $db->db_escape($twitter_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get a page using id
	 * @param int $twitter_id
	 * 
	 * @return array 
	 */
	public static function get_by_id ($twitter_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM twitter_api
						  WHERE twitter_id = '%s'",
						  $db->db_escape($twitter_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get pages
	 * 
	 * @return array
	 */
	public static function get_all () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM twitter_api";
		
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
							FROM twitter_api 
							WHERE twitter_id NOT IN (
								SELECT twitter_id 
								FROM users_clicks 
								WHERE users_clicks.user_id = '%s') 	
							AND twitter_status != 'disabled' ORDER BY twitter_points_per_follow DESC LIMIT 6",
						$db->db_escape($user_id));	
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Update
	 * @param int $twitter_id
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function update ($twitter_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("twitter_id = '%s'", $db->db_escape($twitter_id));
		
		$result = $db->db_update('twitter_api', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Check if a page exists
	 * @param string $twitter_url
	 * @param int $user_id
	 * 
	 * @return bool
	 */
	public static function exists($twitter_url, $user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM twitter_api
		                  WHERE `twitter_url` = '%s' AND `user_id` = '%s'",
		                  $db->db_escape($twitter_url),
						  $db->db_escape($user_id));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Delete
	 * @param int $twitter_id
	 */
	public static function delete ($twitter_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM twitter_api 
						  WHERE twitter_id='%s'",
						  $db->db_escape($twitter_id));

		return $db->db_query($query);
	}
}

?>