<?php
/**
 * Resource class
 * @author etheridgeb
 *
 */
class Resource extends Database implements Paginateable
{
	const RESOURCE_ALL = false;
    const RESOURCE_ACTIVE = 'active';
	const RESOURCE_INACTIVE = 'inactive';

    public static $statusList = array('active'=>self::RESOURCE_ACTIVE, 'inactive'=>self::RESOURCE_INACTIVE);
    
	const RESOURCE_TYPE_ALL = false;
    const RESOURCE_TYPE_IMAGE = 'image';
    const RESOURCE_TYPE_PAGE = 'page';
	const RESOURCE_TYPE_VIDEO = 'video';

    public static $typeList = array('image'=>self::RESOURCE_TYPE_IMAGE, 'page'=>self::RESOURCE_TYPE_PAGE, 'video'=>self::RESOURCE_TYPE_VIDEO);
    
	private $_tablename="resource";

	public function __construct() {
		parent::__construct();
	}

	public function getTableName() {
		return $this->_tablename;
	}

    public function getRowCount($condition) {
        $query = "SELECT count(*) FROM resource WHERE 1 $condition";
        return $this->ExecuteScaler($query);
    }

    public function getResultSet($condition, $start=null, $limit=null) {
        $query = "SELECT * FROM resource WHERE 1 $condition ";
        $limitStr = '';
        if ($limit) {
            $limitStr = "LIMIT $start, $limit";
        }
        $query .= "ORDER BY seq, name $limitStr";
//        pr($query);
        return $this->ExecuteSelectQuery($query);
    }

    public function getSearchCondition($pattern, $fromDate=null, $toDate=null) {
        return '';
    }

    public function getResourceById($resourceId, $status=self::RESOURCE_ACTIVE)
	{
		$resourceId = $this->make_safe($resourceId);
        $condition = '';
        if ($status) {
            $condition = " AND status='".self::RESOURCE_ACTIVE."'";
        }        
		$query = "SELECT * FROM resource WHERE 1 AND id='$resourceId' $condition";
//		pr($query);
		$record = $this->ExecuteSelectQuery($query);
		if ($record) {
			return $record[0];
		}
		return null;
	}

	public function getResourceList($status=self::RESOURCE_ACTIVE)
	{
        $condition = '';
        if ($status) {
            $condition = " AND status='".self::RESOURCE_ACTIVE."'";
        }
		$query = "SELECT * FROM resource WHERE 1 $condition ORDER BY seq, name";
//		pr($query);
		$records = $this->ExecuteSelectQuery($query);
		if (!$records) {
			return null;
		}
		//pr($records);
		return $records;
	}

	/**
	 * Update a Resource object
	 */
	public function update($data, $refField)
	{
		try {
			$data = $this->make_array_safe($data);

			$refField = $this->make_array_safe($refField);
			$this->ExecuteUpdate($this->_tablename, $data, $refField);
		} catch(Exception $e) {
			die('Error updating resource: '.$e->getMessage());
		}
		return true;
	}

	/**
	 * Delete a row from the Resource table
	 */
	public function delete($resourceId)
	{
		try {
			$refField = array('id'=>$this->make_safe($resourceId));

			$res = $this->ExecuteDelete($this->_tablename, $refField);
			//pr('Deleted resource id: '.$resourceId.' with result: '.$res);
		} catch(Exception $e) {
			die('Error deleting resource: '.$e->getMessage());
		}
		return $res;
	}

	/**
	 * Soft delete a row from the Resource table
	 */
	public function softDelete($resourceId)
	{
		try {
			$refField = array('id'=>$this->make_safe($resourceId));

			$res = $this->update(array('status'=>self::RESOURCE_INACTIVE), array('id'=>$resourceId));
			//pr('Soft deleted resource id: '.$resourceId.' with result: '.$res);
		} catch(Exception $e) {
			die('Error soft deleting resource: '.$e->getMessage());
		}
		return $res;
	}

	/**
	 * Insert a new row into the Resource table
	 */
	public function insert($data)
	{
		try {
			$data['created_on'] = date('Y-m-d H:i:s');
			$data = $this->make_array_safe($data);

			$data = $this->formspecialchars($data);
			$this->ExecuteInsert($this->_tablename, $data);

			$resourceId = mysql_insert_id();
			//pr('New resource id: '.$resourceId);
		} catch(Exception $e) {
			die('Error inserting resource: '.$e->getMessage());
		}
		return $resourceId;
	}
}
