<?php

function smarty_function_datesuffix($params, &$smarty)
{
	if (isset($params['day']))
	{		
		return date("S", mktime(0,0,0,1,$params['day'],2006));
	}
}

?>