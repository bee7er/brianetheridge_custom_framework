<?php
function smarty_outputfilter_striptabs($output, &$smarty) 
{ 
	return str_replace("\t", '', $output); 
} 
?>