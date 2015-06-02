<?php

	class Database extends DB_Mysql
	{
		const INSERT = 1;
		const UPDATE = 2;
		const DELETE = 3;
		
		//Initializing database authentidction details
    protected $user   = DBUSER;
    protected $pass   = DBPASSWORD;
    protected $dbhost = DBHOST;
    public $dbname = DATABASE;

		public $rowsaffected=0;

		//Contructor
    public function __construct()
    { } 
        
    // Simple insert function
    public function insert($data)
    {
      $data = $this->make_array_safe($data);
      $data = $this->formspecialchars($data);
      $this->ExecuteInsert($this->_tablename, $data);
      $objId = mysql_insert_id();
      //p("Inserted: $objId");
      return $objId;
    } 
    // Simple update function
    public function update($data, $refField)
    {
      $data = $this->make_array_safe($data);
      $data['updated_on'] = date('Y-m-d H:i:s');
      $refField = $this->make_array_safe($refField);
      $this->ExecuteUpdate($this->_tablename, $data, $refField);
      return true;
    }    
    public function delete($refField)
    {		
      $res = $this->ExecuteDelete($this->_tablename, $refField);
      return $res;
    } 			    
		//Executes insert query
		public function ExecuteInsert($tableName,$data)
		{
			$fields = "";
			$values = "";
			$str = "INSERT INTO $tableName ";

			if ($data) {
				foreach($data as $field => $value)
				{
					// commenting out the following two lines - don't need to do this as the individual model methods will use
					// the make safe method
					//$value = str_replace("'","\'",$value);
					//$value = str_replace('"','\"',$value);
					$fields .= "$field,";
					$values .= "\"$value\",";
				}
			}
			$str .= "(".substr($fields,0,-1).")";
			$str .= " VALUES (".substr($values,0,-1).")";

			$recordset=$this->prepare($str)->execute();

			$num=@mysql_insert_id();
			
			return $this->InsertId=$num;
		}

	    //Executes update query
		public function ExecuteUpdate($tableName,$data,$refField)
		{
			$str = "UPDATE $tableName SET ";
			$fvs = "";
			if(!$this->dbh)
			{
				$this->connect();
			}
			if ($data) {
				foreach($data as $field => $value)
				{
					$fvs .= "$field = '" . $value . "', ";
				}
			}
			$str .= substr($fvs,0,-2);

			if(sizeof($refField) > 0)
			{
				$i=0;
				$condition = '';
				if ($refField) {
					foreach($refField as $field => $values)
					{
						$condition.=" $field = '$values'";
						if($i<sizeof($refField)-1)
						$condition.=" and";
						$i++;
					}
				}
				$str.=" WHERE $condition ";
			}
			//print $str;exit;

			$this->prepare($str)->execute();
		}

		//Deletes multiple records
		function ExecuteDelete($table, $data, $print=false)
		{
			$query = " DELETE FROM  ".$table ;
			if(is_array($data)) {
				if(sizeof($data) > 0) {
					$i=0;
					$condition = '';
					if ($data) {
						foreach($data as $field => $values) {
							$condition.=" $field = '$values'";
							if($i<sizeof($data)-1) {
								$condition.=" and";
							}
							$i++;
						}
					}
				}
				$query.=" WHERE $condition ";
			}
			else if($data!="") {
				$condition = " $field = '$values'";
				$query.=" WHERE $condition ";
			} else {
				$condition = "";
				$query.=" $condition ";
			}
			if($print) {
				echo $query;
				exit;
			}
			$this->prepare($query)->execute();
			
			return true;  
		}

		//Executes Select Query
		public function ExecuteSelect($table, $select=NULL, $where=NULL, $offset=NULL, $limit=NULL, $order_bys=NULL, $group_by=NULL)
		{

			if($table)
			{
				$order_string = " ";
				$limit_string = " ";
				$group_string = " ";
				$where_string = '';

				if($select == NULL)
				{
					$select = "*";
				}
				else
				{
					$select = implode(',',$select);
				}

				if(!empty($where))
				{
					foreach($where as $key=>$value)
					{
						$where_string .= ' AND ' . $key. ' = "' . $value . '"';
					}
				}

				if(isset($offset) && !empty($limit))
				{

					$limit_string = ' LIMIT ' . $offset . ',' . $limit;
				}

				if(!empty($order_bys))
				{
					$order_string = ' ORDER BY ';
					foreach($order_bys as $order_by)
					{
						if ($order_by) {
							foreach($order_by as $key=>$value)
							{
								$order_string_sub .= ' ,   '.$key.' '.$value;
							}
						}
						$order_string_sub =substr($order_string_sub, 5);
					}
					$order_string .= $order_string_sub;
				}

				if(!empty($group_by))
				{
					$group_string = ' GROUP BY '. $group_by;
				}

				 $select = 'SELECT '. $select. ' FROM '. $table.' WHERE 1 '. $where_string. ' '. $order_string. ' '. $group_string. ' '. $limit_string;

				$db  = $this->prepare($select)->execute();

				$num=mysql_num_rows($db->result);
				$this->rowsaffected=$num;
				//print_r($this->rowsaffected);

				if (mysql_num_rows($db->result)==0)
				{
					return NULL;
				}
				else
				{
					return $db->fetchall_assoc();
				}
			}
		}
		//Executes Non Query
		public function ExecuteNonQuery($sqlQuery)
		{
			$db=$this->prepare($sqlQuery)->execute();
			$this->rowsaffected = mysql_affected_rows($db->dbh);
		}

		//Executes Select Query
		public function ExecuteSelectQuery($sqlQuery)
		{
		    $db = $this->prepare($sqlQuery)->execute();
			$num=mysql_num_rows($db->result);

			$this->rowsaffected=$num;

			if (mysql_num_rows($db->result)==0)
			{
				return NULL;
			}
			else
			{
				return $db->fetchall_assoc();
			}

		}

		//Executesingle return record of one element
		public function CommonSelect($table, $select=NULL, $where=NULL, $offset=NULL, $limit=NULL, $order_bys=NULL, $group_by=NULL)
		{

			if($table)
			{
				$order_string = " ";
				$limit_string = " ";
				$group_string = " ";
				$where_string = '';

				if($select == NULL)
				{
					$select = "*";
				}
				else
				{
					$select = implode(',',$select);
				}

				if(!empty($where))
				{
					foreach($where as $key=>$value)
					{
						$where_string .= ' AND ' . $key. ' = "' . $value . '"';
					}
				}

				if(isset($offset) && !empty($limit))
				{

					$limit_string = ' LIMIT ' . $offset . ',' . $limit;
				}

				if(!empty($order_bys))
				{
					$order_string = ' ORDER BY ';
					foreach($order_bys as $order_by)
					{
						if ($order_by) {
							foreach($order_by as $key=>$value)
							{
								$order_string_sub .= ' ,   '.$key.' '.$value;
							}
						}
						$order_string_sub =substr($order_string_sub, 5);
					}
					$order_string .= $order_string_sub;
				}

				if(!empty($group_by))
				{
					$group_string = ' GROUP BY '. $group_by;
				}

				$select = 'SELECT '. $select. ' FROM '. $table.' WHERE 1 '. $where_string. ' '. $order_string. ' '. $group_string. ' '. $limit_string;
				$db = $this->prepare($select)->execute();


				if (mysql_num_rows($db->result)==0)
				{
					return NULL;
				}
				else
				{
					return $db->fetch_assoc();
				}
			}
		}

		//Executes Select Query to return only one single value
		public function ExecuteScaler($sqlQuery)
		{
			$db = $this->prepare($sqlQuery)->execute();

			if(mysql_num_rows($db->result)==1)
			{
				$arr= $db->fetch_assoc();
				return array_pop($arr);
			}
			else if (mysql_num_rows($db->result)==0)
			{
				return NULL;
			}
			else
			{
				return $db->fetchall_assoc();
			}
		}

		function CommonGroupSelect($tbl, $sf, $wf, $wv, $ob, $ot, $prn)
		{
			$sql = "SELECT ";
			if(is_array($sf))
			{
				$fields = implode(",", $sf);
			}
			else
			{
				if($sf)
				$fields = $sf;
				else
				$fields = "*";
			}
			if(is_array($wf))
			{
				if(sizeof($wf) > 0)
				{
					$condition = '';
					for($j=0; $j<sizeof($wf); $j++)
					{
						if(strstr($wv[$j],".") && !strstr($wv[$j],"@"))
						$condition.= " $wf[$j] = $wv[$j] ";
						else
						$condition.= " $wf[$j] = '$wv[$j]' ";

						if($j<sizeof($wf)-1)
						$condition .= " and ";
					}
				}
			}
			else
			{
				if($wf)
				$condition = " $wf = '$wv' ";
				else
				$condition ="1";
			}


			$query = $sql.''.$fields." FROM ".$tbl." WHERE ".$condition;
			if($ob)
			{
				$query.=" ORDER BY ".$ob;
			}

			if($ot)
			{
				$query.=" ".$ot;
			}
			if($prn)
			{
				echo $query;
			}

			$result = $this->prepare($query)->execute();
			//$result = @mysql_query($query) or die(mysql_error());
			return $result->fetch_assoc();

		}

	//to join tables
	function ExecuteGroupJoin($table, $selectfield , $condition, $orderby, $groupby, $ads, $lim,$print)
	{
		if(is_array($selectfield))
		{
			$fields = implode(",", $selectfield);
		}
		else
		{
			if($selectfield)
			$fields = $selectfield;
			else
			$fields = "*";
		}

		$query =" SELECT ".$fields." FROM  ".$table ;

		if (!empty($condition))
		{
			$query.=" WHERE $condition";
		}

		if($groupby)
		$query.=" group by ".$groupby;

		if($orderby)
		$query.=" order by ".$orderby." ".$ads;

		if($lim)
		   $query.=" limit ".$lim;

		if($print!="")
		{
 		echo $query;
		}

		$db = $this->prepare($query)->execute();
		$num=mysql_num_rows($db->result);
		$this->rowsaffected=$num;
		if (mysql_num_rows($db->result)==0)
			{
				return NULL;
			}
		else
			{
				return $db->fetchall_assoc();
			}
	}


	function formspecialchars($var)
    {
        if (is_array($var)) {
            $out = array();
            if ($var) {
	            foreach ($var as $key => $v) {
					$out[$key] =$this->formspecialchars($v);
	            }
            }
        } else {
            $out = htmlspecialchars_decode($var);
            $out = htmlspecialchars(stripslashes(trim($out)), ENT_QUOTES,"UTF-8");
        }

        return $out;
    }


	public function executeSingleSelectQuery($sqlQuery)
		{
			$db = $this->prepare($sqlQuery)->execute();

			$recordsCount=mysql_num_rows($db->result);

			if($recordsCount==1)
			{
				return $db->fetch_assoc();
			}
			else if($recordsCount==0)
			{
				return NULL;
			}
			else
			{
				return NULL;
			}

		}

	public function getTableColumns($tableName)
	{
		if (!empty($tableName))
		{
			$query = 'SHOW columns FROM '.$tableName;
			$columns = $this->ExecuteSelectQuery($query);
			$fields = array();
			if (!empty($columns)) {
				foreach ($columns as $column) {
					array_push($fields, $column['Field']);
				}
			}
			return $fields;
		}
	}


}//End Class
?>