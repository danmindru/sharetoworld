<?php

class dbRatings {
	
	/**
	 * Add rating
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('ratings', $data);
	}
	
	public static function exists($item_id, $user_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM ratings
		                  WHERE `item_id` = '%s' AND `user_id` = '%s'",
		                  $db->db_escape($item_id),
		                  $db->db_escape($user_id));
		
		$result = $db->db_query($query);		
		return $db->db_num_rows($result) ? true : false;
	}
}

?>