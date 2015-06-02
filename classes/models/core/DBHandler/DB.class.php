<?php

/*
// DB library

Use like:

class DB_Mysql_Prod_gosc_cms extends DB_Mysql {
    protected $user   = "smileon";
    protected $pass   = "********";
    protected $dbhost = "localhost";
    protected $dbname = "ewisdom";

    public function __construct() { }
}

##And then in the code...
$dbo = new DB_ghar();

##Query
$sql = "select stuff from sourcetable";
$db = $dbo->prepare($sql)->execute();
or
$insert_id = $dbo->prepare($sql)->execute_Insert();

##Results
$results = $db->fetchall_assoc(); - returns a set of records
or
$record = $db->fetch_assoc(); - returns a recordset


*/
class MysqlException extends Exception {
  public $backtrace;
  public function __construct($message=false, $code=false) {
    if(!$message) {
      $this->message = mysql_error();
    }
    if(!$code) {
      $this->code = mysql_errno();
    }
    $this->backtrace = debug_backtrace();
  }
}

interface DB_Connection {
  public function prepare($query);
  public function execute($query);
}


class DB_Mysql implements DB_Connection {
  protected $user;
  protected $pass;
  protected $dbhost;
  protected $dbname;
  protected $dbh;


  public function __construct($user, $pass, $dbhost, $dbname) {
    $this->user = $user;
    $this->pass = $pass;
    $this->dbhost = $dbhost;
    $this->dbname = $dbname;
  }

  protected function connect() {

    $this->dbh = mysql_pconnect($this->dbhost, $this->user, $this->pass, TRUE);
    
    if(!is_resource($this->dbh)) {	
      throw new MysqlException;
    }
    if(!mysql_select_db($this->dbname, $this->dbh)) {
      throw new MysqlException;
    }
  }
  public function make_safe($str)
  {
    return mysql_real_escape_string($str, $this->get_connection());
  }
  
  public function get_connection() {
	$this->connect();
	return $this->dbh;
  }
  
  public function make_array_safe($array){
  	if ($array) {
	    foreach ($array as $key => $value) { 
	    	$array[$key] = $this->make_safe($value); 
	  	}
  	}
	return $array;  
  }

  public function execute($query) {
    if(!$this->dbh) {
      $this->connect();
    }

    $ret = mysql_query($query, $this->dbh);

    if(!$ret) {
      throw new MysqlException;
    }
    else if(!is_resource($ret)) {
      return TRUE;
    } else {
      $stmt = new DB_MysqlStatement($this->dbh, $query);
      $stmt->result = $ret;
      return $stmt;
    }
  }

  public function prepare($query) {
    if(!$this->dbh) {
      $this->connect();
    }
  return new DB_MysqlStatement($this->dbh, $query);
  }
}


interface DB_Statement {
  public function execute();
  public function bind_param($key, $value);
  public function fetch_row();
  public function fetch_assoc();
  public function fetchall_assoc();
}

class DB_MysqlStatement implements DB_Statement {

  public $result;
  public $binds;
  public $query;
  public $dbh;

  public function __construct($dbh, $query) {

    $this->query = $query;

    $this->dbh = $dbh;
    if(!is_resource($dbh)) {
      throw new MysqlException("Not a valid database connection");
    }
  }

  public function bind_param($ph, $pv) {
    $this->binds[$ph] = $pv;
    return $this;
  }

  public function execute() {
    $binds = func_get_args();
    $query = $this->query; 
    $this->result = mysql_query($query, $this->dbh);
    if(!$this->result) {
      throw new MysqlException;
    }
    return $this;
  }

  public function execute_Insert() {
    $query = $this->query;

    $this->result = mysql_query($query, $this->dbh);

    if(!$this->result) {
      throw new MysqlException;
    }

	// Get the ID number of the new record
	return mysql_insert_id($this->dbh);
  }

  public function fetch_row() {
    if(!$this->result) {
      throw new MysqlException("Query not executed");
    }
    return mysql_fetch_row($this->result);
  }

  public function fetch_num_row(){
        if(!$this->result) {
      throw new MysqlException("Query not executed");
    }
    return mysql_num_rows($this->result);
  }

  public function fetch_assoc() {
    return mysql_fetch_assoc($this->result);
  }

  public function fetchall_assoc() {
    $retval = array();
    while($row = $this->fetch_assoc()) {
      $retval[] = $row;
    }
    return $retval;
  }  
}

class DB_Result {
  protected $stmt;
  protected $result = array();
  private $rowIndex = 0;
  private $currIndex = 0;
  private $done = false;

  public function __construct(DB_Statement $stmt){
    $this->stmt = $stmt;
  }

  public function first()
  {
    if(!$this->result) {
      $this->result[$this->rowIndex++] = $this->stmt->fetch_assoc();
    }
    $this->currIndex = 0;
    return $this;
  }

  public function last() {
    if(!$this->done) {
      array_push($this->result, $this->stmt->fetchall_assoc());
    }
    $this->done = true;
    $this->currIndex = $this->rowIndex = count($this->result) - 1;
    return $this;
  }

  public function next() {
    if($this->done) {
      return false;
    }

    $offset = $this->currIndex + 1;
    if(!$this->result[$offset]) {
      $row = $this->stmt->fetch_assoc();
      if(!$row) {
        $this->done = true;
        return false;
      }
      $this->result[$offset] = $row;
      ++$this->rowIndex;
      ++$this->currIndex;
      return $this;
    }
    else {
      ++$this->currIndex;
      return $this;
    }
  }

  public function prev() {
    if($this->currIndex == 0) {
      return false;
    }
    --$this->currIndex;
    return $this;
  }

  public function __get($value){
    if(array_key_exists($value, $this->result[$this->currIndex])) {
      return $this->result[$this->currIndex][$value];
    }
  }
}

?>