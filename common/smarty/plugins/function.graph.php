<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {graph} function plugin
 *
 * Type:     function<br>
 * Name:     graph<br>
 * Purpose:  display graphs<br>
 * @author FGM Team
 * @param float
 * @param Smarty
 */

function smarty_function_graph ($params, &$smarty) {
	
	//params
	$percent = $params['percent'];
	$color = $params['color'];
	$type = $params['type'];
	$xfromy = $params['xfromy'];
		
	if (empty($percent)) {
		$smarty->_trigger_fatal_error("[graph] param 'percent' cannot be empty ");
		return;
	}
	
	if (isset($type)) {
		if ($type==1) {
			if (isset($color)) {
				if ($color == "blue") { 
					$pb = "pbblue";
					$inpb = "inpbblue"; 
				} elseif ($color == "red") { 
					$pb = "pbred"; 
					$inpb = "inpbred"; 
				} elseif ($color == "green") { 
					$pb = "pbgreen"; 
					$inpb = "inpbgreen"; 
				} elseif ($color == "orange") { 
					$pb = "pborange";
					$inpb = "inpborange"; 
				} else {
					$pb = "pbblack";
					$inpb = "inpbblack"; 
				}
				
				$graphics_bar = "<div class='progressbar $pb'><div class='inpb $inpb' style='width:$percent%;'>&nbsp;$percent%&nbsp;</div></div>";
			} else {
				if ($percent<=60) {
					$graphics_bar = "<div class='progressbar pbgreen'><div class='inpb inpbgreen' style='width:$percent%;'>&nbsp;$percent%&nbsp;</div></div>";
				} elseif ($percent>=60 AND $percent<80) {
					$graphics_bar = "<div class='progressbar pborange'><div class='inpb inpborange' style='width:$percent%;'>&nbsp;$percent%&nbsp;</div></div>";
				} else {
					$graphics_bar = "<div class='progressbar pbred'><div class='inpb inpbred' style='width:$percent%;'>&nbsp;$percent%&nbsp;</div></div>";
				}
			}
		} elseif ($type==2) {
			if (isset($color)) {
				if ($color == "blue") { 
					$cssclass = "blue";
				} elseif ($color == "red") { 
					$cssclass = "red";
				} elseif ($color == "green") { 
					$cssclass = "green";
				} elseif ($color == "orange") { 
					$cssclass = "orange";
				} else {
					$cssclass = "black";
				}
				
				$graphics_bar = "<div class='graph $cssclass' style='width: $percent%;'>$xfromy</div>";
			} else {
				if ($percent<=60) {
					$graphics_bar = "<div class='graph green' style='width: $percent%;'>$xfromy</div>";
				} elseif ($percent>=60 AND $percent<80) {
					$graphics_bar = "<div class='graph orange' style='width: $percent%;'>$xfromy</div>";
				} else {
					$graphics_bar = "<div class='graph red' style='width: $percent%;'>$xfromy</div>";
				}
			}			
		}
	} else {		
		$smarty->_trigger_fatal_error("[graph] param 'type' cannot be empty");
		return;
	}
			
	return $graphics_bar;
}
?>
