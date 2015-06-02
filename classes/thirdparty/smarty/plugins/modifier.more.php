<?php 
/**
 * Smarty shared plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Function: more
 * Purpose:  Used to display a portion of a string with an ellipsis if it is longer
 * Usage string: {$string|more}
 * @author BEE
 * @param string
 * @param int
 * @return string
 */
function smarty_modifier_more($str, $len)
{
	$outstr = '';
	if ($str && $str != '') {
		$outstr = Utils::more($str, $len);
	}
	return $outstr;
} 