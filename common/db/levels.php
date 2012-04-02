<?php

class dbLevels {
	
	/**
	 * Get levels list
	 * 
	 * @return array
	 */
	public static function get_list () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM levels
				  ORDER BY level_id ASC";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Create new level
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('levels', $data);
	}
	
	/**
	 * Get a level by id
	 * @param int $level_id
	 * 
	 * @return array 
	 */
	public static function get ($level_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM levels
						  WHERE level_id = '%s'",
						  $db->db_escape($level_id));
		
		return $db->db_fetch($query);
	}
}
?>