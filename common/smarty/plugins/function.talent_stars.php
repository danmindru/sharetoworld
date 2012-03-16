<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {talent_stars} function plugin
 *
 * Type:     function<br>
 * Name:     talent_stars<br>
 * Purpose:  display talent stars<br>
 * @author FGM Team
 * @param int
 * @param Smarty
 */

function smarty_function_talent_stars ($params, &$smarty) {
	
	//params
	$stars = $params['stars'];
	
	$stars_code = "";
	for($x=1; $x<=$stars; $x++){
		$stars_code .= "<img src='".URL_STATIC."images/full_star.png' alt='Star' title='Star' />";
	}
	
	$half = substr($params['stars'], 2);
	
	if($half != ""){
		$stars_code .= "<img src='".URL_STATIC."images/half_star.png' alt='Half star' title='Half star' />";
	}
	
	return $stars_code;
}
?>
