<?php 
/**
 * Smarty shared plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Function: plist
 * Purpose:  Used to print an array of strings as a list
 * Usage string: {$fooArray|plist}
 * Usage array: {$fooArray|plist}
 * @author BEE
 * @param array
 * @return string
 */
function smarty_modifier_plist($strAry)
{
	$outstr = '';
	if (is_array($strAry) && count($strAry)) {
		$separator = '';
		foreach ($strAry as $str) {
			$outstr .= ($separator.$str);
		}
		$separator = ', ';
	} else {
		$outstr = print_r($strAry, true);
	}
	return $outstr;
} 