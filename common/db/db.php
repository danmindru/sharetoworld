<?php

require_once(ROOT_DIR . "common/db/mysql.php");


/**
 * Database functions for all databas types
 */
class db {
	
	/**
	 * Database instance
	 * 
	 * @var db
	 */
	protected static $_instance;
	
	/**
	 * Last query
	 * 
	 * @var string
	 */
	protected $_last_query;
	
	/**
	 * db class constructor
	 * 
	 * @var db
	 */
	protected function __construct() {
		$this->db_connect();
	}
	
	/**
	 * Return database instance
	 * 
	 * @return db
	 */
	public static function get_instance() {
		
		switch(DB_TYPE) {
			case 'mysql':
				if ( !(self::$_instance instanceof MySQL)) {
        	        self::$_instance = new MySQL();
				}
				break;
			default: 
				die('Unknown database type');
        }

        
        
        return self::$_instance;

	}
	
	/**
	 * This function is invoked if an sql error occur
	 */
	protected function db_error() {
		if (DEVELOPEMENT_MODE || DEBUG_MODE) {
			//get error message
			$error = $this->_db_error();
			
			//display last issued query
			echo 'Last query: ' . $this->_last_query . '<br/>';
			
			//display error code
			echo 'Error code: ' . $error['code'] . '<br/>';
			
			//display error message
			echo 'Error message: ' . $error['message'];
		} else {
			//display an error message
			echo 'Database error. If error persists please contact website administrator.';	
		}
		
		//Intrereupt code execution
		die;
	}
	
	/**
	 * Executes query, fetches all result rows
	 *
	 * @param string $query
	 * @return array
	 */
	public function db_fetch_all($query) {
        $result = $this->db_query($query);
	    if ($result) {
	        $buffer = array();
	        while ($row = $this->db_fetch_assoc($result)) {
	            $buffer[] = $row;
	        }
	        $this->db_free_result($result);
	        return $buffer;
	    } else {
	        return null;
	    }
    }
    
    /**
     * Executes query, fetches first row
     *
     * @param string $query
     * @return array
     */
	public function db_fetch($query) {
        $result = $this->db_query($query);
        if ($result) {
	        $row = $this->db_fetch_assoc($result);
	        $this->db_free_result($result);
	        
	        if ($row === false)
	        {
	        	return null;
	        }
	        
            return $row;
	    } else {
	        return null;
	    }
    }
    
    /**
     * Insert 
     * 
     * @param $table
     * @param $fields
     * @return unknown_type
     */
    public function db_insert ($table, $data) {

		foreach ($data as $key => $value)
		{
			$data[$key] = $this->db_escape($value);
		}
    	
    	$query  = "INSERT INTO " . $table . " (`";
    	$query .= implode('`, `', array_keys($data));
    	$query .= "`) VALUES ('";
    	$query .= implode("', '", array_values($data));
    	$query .= "')";
    	
    	return $this->db_query($query);
    }
	
	/**
	 * Used to update a table entries that respect a condiion given using arguments
	 * 
	 * @param string $table
	 * @param array $data
	 * @param string $where
	 */
	function db_update($table, $data, $where = null) {
	    $query = "UPDATE `" . $table . "` SET ";
	    
	    $first = true;
	    
	    foreach ($data as $key => $value) {
	        if (!$first) {
	            $query .= ', ';
	        }
	        
	        $first = false;
	
	        if (is_null($value)) {
	            $value = 'NULL';
	        }
	        else {
	            $value = $this->db_escape($value);
	        }
	        $query .= "`" . $this->db_escape($key) . "` = '" . $value . "'";
	    }
	    
	    //WHERE clause
	    if (!is_null($where)) {
	        $query .= " WHERE " . $where;
	    }
	
	    $this->db_query($query);
	
	    return $this->db_affected_rows();
	}
	
	/**
	 * Used to delete an inserted row in table entries that respect a condiion given using arguments
	 * 
	 * @param string $table
	 * @param array $data
	 * @param string $where
	 */
		
	function db_delete($table, $where) {
	    $query = "DELETE FROM `" . $table . "` WHERE ".$where;  	    
	
	    if(!$query) return true;
	    
	    $this->db_query($query);
	
	    return $this->db_affected_rows();
	}	
	
}



?>