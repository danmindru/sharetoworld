<?php

/**
 * MySQL Database functions
 * 
 * Compatible with:
 * MySQL 3.23+
 * MySQL 4.0+
 * MySQL 4.1+
 * MySQL 5.0+
 * 
 */
class MySQL extends db {

	/**
	 * MySQL server version
	 * 
	 * @access protected
	 * @var string
	 */
	protected $_mysql_version = null;
	
	/**
	 * MySQL database connection
	 */
	protected $_connection_id = null;
	
	/**
	 * Create a sql connection
	 * 
	 * @return boolean
	 * @access public
	 */
	public function db_connect () {
		$this->persistency = DB_KEEP_ALIVE;
		$this->dbuser = DB_USER;
		$this->dbhost = DB_HOST . ((DB_PORT) ? ':' . DB_PORT : '');
		$this->dbname = DB_NAME;
		$dbpass = DB_PASS;

		$this->sql_layer = 'mysql';
		
		$this->_connection_id = ($this->persistency) ? @mysql_pconnect($this->dbhost, $this->dbuser, $dbpass) : @mysql_connect($this->dbhost, $this->dbuser, $dbpass);

		if ($this->_connection_id && $this->dbname != '') {
			
			if (@mysql_select_db($this->dbname, $this->_connection_id)) {
				
				$this->mysql_version = mysql_get_server_info($this->_connection_id);

				return true;
			}
		}

		return $this->db_error('');
	}
	
	/**
	 * Information about server
	 * 
	 * @return string
	 * @access public
	 */
	public function db_server_info () {	
		return 'MySQL ' . $this->mysql_version;
	}
	
	/**
	 * SQL query
	 * 
	 * @param string $query
	 * @return integer|boolean Query id on success | false on error
	 * @access public
	 */
	public function db_query ($query) {
		
		if ($query == '') {
			return false;
		}
		
		$this->_last_query = $query;
		
		if (($query_result = mysql_query($query, $this->_connection_id)) === false) {
			$this->db_error($query);
		}

		return ($query_result) ? $query_result : false;
	}
	
	/**
	 * Nurmber of affected rows
	 * 
	 * @return integer|boolean
	 * @access public
	 */
	public function db_affected_rows() {
		return ($this->_connection_id) ? @mysql_affected_rows($this->_connection_id) : false;
	}
	
	/**
	 * Fetch row
	 * 
	 * @param integer $result
	 * @return array|boolean
	 * @access public
	 */
	public function db_fetch_assoc($result) {
		return ($result !== false) ? @mysql_fetch_assoc($result) : false;
	}

	/**
	 * Free sql result
	 * 
	 * @param integereger $result
	 * @return boolean
	 * @access public
	 */
	public function db_free_result ($result) {
		if ($result !== false) {
			return @mysql_free_result($result);
		}

		return false;
	}

	/**
	 * Get the ID generated from the previous INSERT operation
	 * 
	 * @return integer|boolean
	 * @access public
	 */
	public function db_insert_id() {
		return ($this->_connection_id) ? @mysql_insert_id($this->_connection_id) : false;
	}
	
	/**
	 * Return number of rows
	 * 
	 * @param integer $result
	 * @return integer|boolean
	 * @access public
	 */
	public function db_num_rows($result) {
		return ($result) ? @mysql_num_rows($result) : false;
	}
	
	/**
	 * Return an escaped string
	 * 
	 * @param string $string
	 * @return string|boolean
	 * @access public
	 */
	public function db_escape($string) {
		if (!$this->_connection_id) {
			return @mysql_real_escape_string($string);
		}
		
		return @mysql_real_escape_string($string, $this->_connection_id);
	}
	
	/**
	 * Seek to given row number
	 * 
	 * @param int $row_num
	 * @param int $result
	 * @return boolean
	 * @access public
	 */
	public function  db_row_seek($row_num = 0, $result) {
		return ($result !== false) ? @mysql_data_seek($result, $row_num) : false;
	}
	
	/**
	 * Informations about sql error
	 * 
	 * @return array
	 * @access protected
	 */
	protected function _db_error() {
		if (!$this->_connection_id) {
			return array(
				'message'	=> @mysql_error(),
				'code'		=> @mysql_errno()
			);
		} else {
			return array(
				'message'	=> @mysql_error($this->_connection_id),
				'code'		=> @mysql_errno($this->_connection_id)
			);
		}
	}
	
	/**
	* Close sql connection
	* 
	* @return boolean
	* @access protected
	*/
	public function db_close() {
		return @mysql_close($this->_connection_id);
	}
	
}

?>