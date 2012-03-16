<?php

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {pagination} function plugin
 *
 * Type:     function<br>
 * Name:     pagination<br>
 * Purpose:  display available page numbers<br>
 * @author FGM Team
 * @param int
 * @param Smarty
 */

function smarty_function_pagination ($params, &$smarty) {
	$pgn = $params['pgn'];
	$url = $params['url'];

	//Build html code
	$html = "";
	
	//Before and after current page
	$baacp = 4;
	
	$first = ($pgn['pn']>$baacp) ? $pgn['pn']-$baacp : 1;
	$last = ($pgn['pn']>$pgn['tpn']-$baacp) ? $pgn['tpn'] : $pgn['pn']+$baacp;
	
	if ($pgn['pn'] > $baacp) {
		$html .= '<a href="' . $url . 'page/' . 1 . '">&lt;&lt;&nbsp; First</a> ';	
	}
	
	if ($pgn['pn'] == 1) {
		$html .= '<span id="inactive">&lt;&nbsp; Previous</span> ';
	} else {
		$html .= '<a href="' . $url . 'page/' . ($pgn['pn']-1) . '">&lt;&nbsp; Previous</a> ';		
	}
	
	for ($i=$first; $i<=$last; $i++) {
		if ($pgn['pn'] == $i) {
			$html .= '<span id="current">' . $i . '</span> ';			
		} else {
			$html .= '<a href="' . $url . 'page/' . $i . '">' . $i . '</a> ';
		}
	}
	
	if ($pgn['pn'] == $pgn['tpn']) {
		$html .= '<span id="inactive">Next &nbsp;&gt;</span> ';
	} else {
		$html .= '<a href="' . $url . 'page/' . ($pgn['pn']+1) . '">Next &nbsp;&gt;</a> ';		
	}
	
	if ($pgn['pn'] < $pgn['tpn']-$baacp+1) {
		$html .= '<a href="' . $url . 'page/' . $pgn['tpn'] . '">Last &nbsp;&gt;&gt;</a> ';	
	}
	
	if ($pgn['tpn'] != 0) {
		return $html;
	}
}
?>
