<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty skill modifier plugin
 *
 * Type:     modifier<br>
 * Name:     skill<br>
 * Purpose:  return skill as 2 digits
 * 
 * @author Robert 
 * @param string
 * @return string
 */
function smarty_modifier_skill($string)
{
    return (int) ($string/100);
}

/* vim: set expandtab: */

?>
