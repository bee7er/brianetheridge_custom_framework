<?php
/**
 * Config class
 * @author etheridgeb
 *
 */
class Config extends Database
{
	protected $_tablename="config";

	const CONFIG_SITE_OFFLINE = 1;
	
	public function __construct()
	{
		parent::__construct();
	}
	
	public function getTableName()
	{
		return $this->_tablename;
	}	
	
	public function getConfigById($configId)
	{
		$configId = $this->make_safe($configId);
		$where = array('config_id'=>$configId);
		$config = $this->CommonSelect($this->_tablename, $select=NULL, $where, $offset=NULL, $limit=NULL, $order_bys=NULL, $group_by=NULL);
		if (count($config) == 0) {
			return null;
		}
		return $config;
	}
	
	public function getConfigValueById($configId)
	{
		$config = $this->getConfigById($configId);
		if ($config) {
			return $config['value'];
		}
		die('Error: Could not find configuration item with id: '.$configId);
	}
	
	public function getConfigList()
	{
		$condition = '';

		$orderBy = "ORDER BY name";

		$query = "SELECT * FROM config WHERE 1 $condition $orderBy";
		$records = $this->ExecuteSelectQuery($query);
		return $records;
	}

	public function applyDataOperation($operation, $value)
	{
		// Check for certain supported operations and apply them
		switch($operation) {
			case 'lowercase':
				$value = strtolower($value); 
				break;
			case 'uppercase':
				$value = strtoupper($value); 
				break;				
			default:
				// Do nothing
		}
		return $value;
	}
  
	public function setSiteOffline($action)
	{
    $value = ($action ? 'Y': 'N');
		$this->update(array('value'=>$value), array('config_id'=>self::CONFIG_SITE_OFFLINE));
	}  
}