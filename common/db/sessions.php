<?php

class dbSessions {
	/**
	 * Check if a session exist
	 * 
	 * @param string $session_id
	 * @return bool
	 */
	public static function session_exist ($session_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM sessions
		                  WHERE `session_id` = '%s'",
		                  $db->db_escape($session_id));
		
		$result = $db->db_query($query);
		                  
		return $db->db_num_rows($result) ? true : false;
	}
	
	/**
	 * Update an entry
	 * 
	 * @param string $old_session_id
	 * @param string $new_session_id
	 * @param int $user_id
	 * @param int $session_last_visit_time
	 * @return bool
	 */
	public static function update ($old_session_id, $new_session_id, $user_id = 0, $session_last_visit_time) {
		$db = db::get_instance();
		
		$data = array(
			'session_id' => $new_session_id,
			'user_id' => $user_id,
			'session_last_visit' => $session_last_visit_time
		);
		
		$where = "`session_id` = '" . $old_session_id . "'";
		
		return $db->db_update('sessions', $data, $where);
	}
	
	/**
	 * Create newentry
	 * 
	 * @param string $session_id
	 * @param int $user_id
	 * @param int $session_start_time
	 * @param int $session_last_visit_time
	 * @return bool
	 */
	public static function create ($session_id, $user_id = 0, $session_start_time, $session_last_visit_time) {
		$db = db::get_instance();
		
		$data = array(
			'session_id' => $session_id,
			'user_id' => $user_id,
			'session_start' => $session_start_time,
			'session_last_visit' => $session_last_visit_time
		);

		return $db->db_insert('sessions', $data);
	}
	
	/**
	 * Delete old sessions
	 * 
	 * @param int $time Session expiration time
	 * @return bool
	 */
	public static function delete_old_sessions ($time) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM sessions
						  WHERE `session_last_visit` < %s",
						  $db->db_escape($time));
		
		return $db->db_query($query);
	}
	
	/**
	 * Delete specified sessions
	 * 
	 * @param string $session_id
	 * @return bool
	 */
	public static function delete_session ($session_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM sessions
						  WHERE `session_id` = '%s'",
						  $db->db_escape($session_id));
		
		return $db->db_query($query);
	}
	
	/**
	 * Delete all user sessions
	 * 
	 * @param int $user_id
	 * @return bool
	 */
	public static function delete_user_sessions ($user_id) {
		$db = db::get_instance();
		
		$query = sprintf("DELETE FROM sessions
						  WHERE `user_id` = '%s'",
						  $db->db_escape($user_id));
		
		return $db->db_query($query);
	}
	
	/**
	 * Update last visit date
	 * 
	 * @param string $session_id
	 * @param int $session_last_visit_time
	 * @return bool
	 */
	public static function update_session_last_visit ($session_id, $session_last_visit_time) {
		$db = db::get_instance();
		
		$data = array(
			'session_last_visit' => $session_last_visit_time
		);
		
		$where = "`session_id` = '" . $session_id . "'";
		
		return $db->db_update('sessions', $data, $where);
	}
	
	/**
	 * Return user id using username
	 * 
	 * @param string $username
	 * @return int
	 */
	public static function get_user_id_from_session ($session_id) {
		$db = db::get_instance();
		
		$query = sprintf("SELECT * 
		                  FROM sessions
		                  WHERE `session_id` = '%s'",
		                  $db->db_escape($session_id));

		$result = $db->db_fetch($query);
		
		return $result ? $result['user_id'] : null;
	}
}

?>