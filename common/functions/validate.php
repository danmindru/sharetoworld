<?php

/**
 * Check if field is empty
 * 
 * @param mixed $var
 * @return bool
 */
function is_empty ($var) {
	
	if (!isset($var) || is_null($var) || $var == '') {
		return true;	
	}
	
	return false;
}

/**
 * Check if exists an empty field in aray given
 * 
 * @param array $data
 * @return bool
 */
function exist_empty_fields ($data) {
	
	foreach ($data as $field) {
		if (is_empty($field)) {
			return true;
		}
	}
	
	return false;
}

/**
 * Check if email address is valid
 * 
 * @param $email
 * @return bool
 */
function is_valid_email ($email) {
	
	if (!preg_match("/^[a-z0-9_\-]+(\.[_a-z0-9\-]+)*@([_a-z0-9\-]+\.)+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)$/", $email))
	{
			return false;
	}
	
	return true;
}

?>