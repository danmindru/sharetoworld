<?php

class dbItems {
	
	/**
	 * Create new item
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('items', $data);
	}
	
	/**
	 * Get an item using id
	 * @param int $item_id
	 * 
	 * @return array 
	 */
	public static function get ($item_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM items
						  INNER JOIN categories ON items.category_id = categories.category_id
						  WHERE item_id = '%s'",
						  $db->db_escape($item_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get items
	 * 
	 * @return array
	 */
	public static function get_all () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM items
				  INNER JOIN categories ON items.category_id = categories.category_id";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Update
	 * @param int $item_id
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function update ($item_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("item_id = '%s'", $db->db_escape($item_id));
		
		$result = $db->db_update('items', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Check if an item exists
	 * @param string $item_name
	 * 
	 * @return bool
	 */
	public static function exists($item_name) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM items
		                  WHERE `item_name` = '%s'",
		                  $db->db_escape($item_name));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Delete
	 * @param int $item_id
	 */
	public static function delete ($item_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM items 
						  WHERE item_id='%s'",
						  $db->db_escape($item_id));

		return $db->db_query($query);
	}
}

?>