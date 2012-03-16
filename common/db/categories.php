<?php

class dbCategories {
	
	/**
	 * Create new category
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function create($data) {
		$db = db::get_instance();
		
		return $db->db_insert('categories', $data);
	}
	
	/**
	 * Get a category using id
	 * @param int $category_id
	 * 
	 * @return array 
	 */
	public static function get ($category_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM categories
						  WHERE category_id = '%s'",
						  $db->db_escape($category_id));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Get categories
	 * 
	 * @return array
	 */
	public static function get_all () {
		$db = db::get_instance();
		
		$query = "SELECT * FROM categories";
		
		return $db->db_fetch_all($query);
	}
	
	/**
	 * Update
	 * @param int $category_id
	 * @param array $data
	 * 
	 * @return bool
	 */
	public static function update ($category_id, $data) {
		$db = db::get_instance();
		
		$where = sprintf("category_id = '%s'", $db->db_escape($category_id));
		
		$result = $db->db_update('categories', $data, $where);
		
		return ($result) ? true : false;		
	}
	
	/**
	 * Check if a category exists
	 * @param string $category_name
	 * 
	 * @return bool
	 */
	public static function exists($category_name) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM categories
		                  WHERE `category_name` = '%s'",
		                  $db->db_escape($category_name));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Delete
	 * @param int $category_id
	 */
	public static function delete ($category_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM categories 
						  WHERE category_id='%s'",
						  $db->db_escape($category_id));

		return $db->db_query($query);
	}
}

?>