<?php
function smarty_outputfilter_stripquotes($output, &$smarty) 
{ 
	$search = array(chr(145), 
                    chr(146), 
                    chr(147), 
                    chr(148), 
                    chr(151)); 
 
	$replace = array('&lsquo;', 
                 '&rsquo;', 
                 '&ldquo;', 
                 '&rdquo;', 
                 '&mdash;'); 
 
	return str_replace($search, $replace, $output); 
}
?>