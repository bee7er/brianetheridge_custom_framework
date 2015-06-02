<?php
/**
 * User class
 * @author etheridgeb
 *
 */
class User extends Database implements Paginateable
{ 
  const SEARCH_PLACEHOLDER = "Enter all or part of the user's name or email address";
  const USER_STATUS_ACTIVE = 'active';
  const USER_STATUS_INACTIVE = 'inactive';
  
  public static $accountStatusValues = array(self::USER_STATUS_ACTIVE, self::USER_STATUS_INACTIVE);
  
	protected $_tablename="user";	

	public function __construct()
	{
		parent::__construct();
	}
	
	public function getTableName()
	{
		return $this->_tablename;
	}	
  
  public function insert($data) {
    return parent::insert($data);
  } 
  
  public function update($data, $refField) {
    $refField = array('user_id'=>$this->make_safe($refField['user_id']));
    parent::update($data, $refField);
    return true;
  } 
  
  public function delete($refField) {		
    $refField = array('user_id'=>$this->make_safe($refField['user_id']));
    return parent::delete($refField);
  }  
  
  public function getRowCount($condition) {
		$query = "SELECT count(*) FROM user u WHERE 1 $condition";
		return $this->ExecuteScaler($query);    
  }
  
  public function getResultSet($condition, $start=null, $limit=null) {
		$query = "SELECT * FROM user u
            INNER JOIN user_role ur ON ur.user_role_id=u.user_role_id
            WHERE 1 $condition            
            ORDER BY u.surname, u.first_name LIMIT $start, $limit";
    ///p($query);
		return $this->ExecuteSelectQuery($query);    
  } 
  
  public function getSearchCondition($searchPattern, $activeOnly=true) {
    $condition = ''; 
    // Selecting Patients
    $condition .= " AND u.user_role_id='".UserRole::USER_ROLE_PATIENT."' ";
    if ($activeOnly) {
      // Exclude inactive users from the normal search
      $condition .= " AND account_status='".self::USER_STATUS_ACTIVE."' ";
    }    
    if ($searchPattern) {
      $condition .= " AND (u.user_id='$searchPattern' OR u.first_name LIKE '%$searchPattern%' OR u.surname LIKE '%$searchPattern%' OR u.email_id LIKE '%$searchPattern%') ";
    }
		return $condition;   
  }
  
  public function getAdminSearchCondition($searchPattern, $userRoleId=null, $accountStatus=null) {
    $condition = '';
    if ($userRoleId) {
      $condition .= " AND u.user_role_id='$userRoleId' ";
    }    
    if ($accountStatus) {
      $condition .= " AND u.account_status='$accountStatus' ";
    } 
    if ($searchPattern) {
      $condition .= " AND (u.user_id='$searchPattern' OR u.first_name LIKE '%$searchPattern%' OR u.surname LIKE '%$searchPattern%') ";
    }
		return $condition;   
  }  
	
	public function getUserById($userId)
	{
		$userId = $this->make_safe($userId);
        $query = "SELECT * FROM user WHERE 1 AND user_id='$userId'";
        $users = $this->ExecuteSelectQuery($query);
		if (count($users) == 0) {
			return null;
		}
		return $users[0];
	}
  
	public function getUserByEmailId($emailId)
	{
		$emailId = $this->make_safe($emailId);
        $query = "SELECT * FROM user WHERE 1 AND email_id='$emailId'";
        $users = $this->ExecuteSelectQuery($query);
		if (count($users) == 0) {
			return null;
		}
		return $users[0];
	}

    public function getUserByAuthorityToken($token)
    {
        try {
            $tokenData = $this->getUserTokenDecrypted($token);
        } catch (Exception $e) {
            //p($e->getMessage());
            return null;
        }
        // Check if token has expired;
        if (!isset($tokenData['expires']) || $tokenData['expires'] < time()) {
            //p('time out');
            return null;
        }
        // NB We ensure we use a raw version of the encoded data. Some chars get automatically decoded.
        $token = rawurlencode($token);
        $query = "SELECT * FROM user WHERE 1 AND auth_token='$token'";
        ///p($query);
        $users = $this->ExecuteSelectQuery($query);
        if (count($users) == 0) {
            return null;
        }
        $user = $users[0];
        // Ensure we are considering the correct user
        if ($user['user_id']==$tokenData['userId']) {
            return $user;
        }
        return null;
    }

    public function getUsers()
	{
		$query = "SELECT * FROM user WHERE 1 ";
		$query .= "ORDER BY surname, first_name";
        return $this->ExecuteSelectQuery($query);
	}
  
	public function validateLogin($username, $password)
	{
		$username = $this->make_safe($username);
		$password = $this->make_safe($password);
		
		$password = $this->generateEncryptedPassword($password);
		
		$sql = "SELECT * FROM user u INNER JOIN user_role ur ON ur.user_role_id=u.user_role_id WHERE email_id= '$username' AND password = '$password' AND account_status='".self::USER_STATUS_ACTIVE."';";
		///p($sql);
		$db = $this->prepare($sql)->execute();
		$record = $db->fetch_assoc();
		return ($record == null) ? 0 : $record;
	}

    public function updateUserPassword($userId, $password) {
        $encryptedPassword = $this->generateEncryptedPassword($password);
        return $this->update(array('password'=>$encryptedPassword, 'auth_token'=>''), array('user_id'=>$userId));
    }

	public function generateEncryptedPassword($password)
	{
	 	$salt = sha1(md5($password));
 	 	$password = md5($salt.$password);
		return $password;
	}		  
  
	public function isValidEmail($userId, $emailId)
	{
        if (!$userId || !$emailId) {
          return false;
        }
        $user = $this->getUserByEmailId($emailId);
		if ($user && $user['user_id']!=$userId) {
            // The email is used and not by our guy
            return false;
        }
        // Not used or is their own
        return true;
	}

    public function generateUserToken($user, $ttl=600) {
        // NB Setting a restricted time-to-live
        $tokenData = array(
            'userId' => $user['user_id'],
            'expires' => time() + $ttl
        );
        // @TODO Encrypt the token
        $token = serialize($tokenData);
        $token = base64_encode($token);
        $token = rawurlencode($token);
        return $token;
    }

    public function getUserTokenDecrypted($token) {
        $token = rawurldecode($token);
        $token = base64_decode($token);
        $tokenData = unserialize($token);
        return $tokenData;
    }
}