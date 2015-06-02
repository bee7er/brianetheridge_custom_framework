<?php

function smarty_function_img($params, &$smarty)
{
	if (isset($params['name']))
	{
		return "<img src='/images/common/" . $params['name'] . "' />";	
	}
}

?>