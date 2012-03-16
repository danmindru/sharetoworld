<?php

require_once(FGM_DB_DIR . 'countries.php');
require_once(FGM_DB_DIR . 'nationalities.php');

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {flag} function plugin
 * Examples:
 *  - Display romania flag {flag country_code=ro country_name=Romanian}
 *  - Display romanian nationality flag {flag country_code=ro nationality_name=Romanian}
 *
 *
 * Type:     function<br>
 * Name:     flag<br>
 * Purpose:  display country or nationality flag<br>
 * @author FGM Team
 * @param int
 * @param Smarty
 */

function smarty_function_flag ($params, &$smarty) {
	
	$country_code = $params['country_code'];
	$country_name = $params['country_name'];
	$nationality_name = $params['nationality_name'];
		
	if (!empty($country_code)) {
		$image_flag = FGM_URL_STATIC . 'images/flag/'. $country_code .'.png';
		if (!empty($country_name)) {
			$flag_image = '<img src="' . $image_flag . '" alt="'. $country_name .'" title="'. $country_name .'" />';
		} else if (!empty($nationality_name)) {
			$flag_image = '<img src="' . $image_flag . '" alt="'. $nationality_name .'" title="'. $nationality_name .'" />';
		} else {
			$flag_image = '<img src="'. FGM_URL_STATIC .'images/flag/no_flag.png" alt="No flag" title="No flag" />';
		}
	} else {
		$flag_image = '<img src="'. FGM_URL_STATIC .'images/flag/no_flag.png" alt="No flag" title="No flag" />';
	}
		
	return $flag_image;
}
?>
