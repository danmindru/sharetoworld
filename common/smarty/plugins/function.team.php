<?php

require_once(FGM_DB_DIR . 'teams.php');

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty {team} function plugin
 *
 * Type:     function<br>
 * Name:     Team Name<br>
 * Purpose:  display team name<br>
 * @author FGM Team
 * @param int
 * @param Smarty
 */

function smarty_function_team ($params, &$smarty) {
	
	//params
	$team_id = $params['team_id'];
			
	if (empty($team_id)) {
		$smarty->_trigger_fatal_error("[team] param 'team_id' cannot be empty ");
		return;
	} else {
		$team = dbTeams::get_team_by_id($team_id);
	}
	
	return $team['team_name'];
}
?>
