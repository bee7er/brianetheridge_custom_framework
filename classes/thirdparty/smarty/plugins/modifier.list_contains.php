<?php 
/**
 * Smarty shared plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Function: smarty_list_contains
 * Purpose:  Used to find a string in a space separated string.
 * Here we convert spaces to '*' and then search for a starred pattern, so that we end 
 * up with an exact match.
 * @author BEE
 * @param string
 * @return string
 */
function smarty_modifier_list_contains($string, $find)
{
   $count = 0;
   if( is_string($string) && !empty($string) )
   {
   		$string = strtolower($string);
   		$string = str_replace(' ', '*', $string);
   		$string = ('*'.$string.'*');
   		$find = strtolower($find);
   		$find = ('*'.$find.'*');
		$count = substr_count($string, $find);
   }
   return $count;
}

/* vim: set expandtab: */ 