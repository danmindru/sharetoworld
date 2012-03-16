<?php

class dbConfig {
	
	/**
	 * Get an row using config key
	 */
	public static function get ($key) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * FROM config
						  WHERE config_key = '%s'",
						  $db->db_escape($key));
		
		return $db->db_fetch($query);
	}
	
	/**
	 * Set new value for specified key
	 */
	public static  function set ($key, $value) {
		$db = db::get_instance();
		
		$data['config_value'] = $value;
		
		$where = "config_key = '" . $db->db_escape($key) . "'";
		
		return $db->db_update('config', $data, $where);
	}
	
	/**
	 * Create new config
	 */
	public static  function create ($key, $value) {
		$db = db::get_instance();
		
		$data['config_key'] = $key;
		$data['config_value'] = $value;
		
		return $db->db_insert('config', $data);
	}
}

?>