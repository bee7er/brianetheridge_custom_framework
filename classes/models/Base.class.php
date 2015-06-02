<?php
/*
   This class is for handling requests of all type of data that are 
   not related to any master table
 */
class Base
{
	private static function ExecuteSelectQuery($sqlQuery)
	{
		$db = new Database();
		$records = $db->ExecuteSelectQuery($sqlQuery);
		return $records;
	}

}
