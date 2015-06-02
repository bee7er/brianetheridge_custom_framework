<?php
/**
 * UserRole class
 * @author etheridgeb
 *
 */
class UserRole extends Database
{
  const USER_ROLE_ADMIN = 1;
  const USER_ROLE_USER = 2;
  
	protected $_tablename="user_role";	

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getTableName()
	{
		return $this->_tablename;
	}	
	
	public function getUserRoleById($userRoleId)
	{
		$userRoleId = $this->make_safe($userRoleId);
        $query = "SELECT * FROM user_role WHERE 1 AND user_role_id='$userRoleId'";
		$data = $this->ExecuteSelectQuery($query);
		if (count($data) == 0) {
			return null;
		}
		return $data[0];
	}

  public function getUserRoles()
	{
		$query = "SELECT * FROM user_role WHERE 1 ";
		$query .= "ORDER BY role_title";
		return $this->ExecuteSelectQuery($query);
	}

}