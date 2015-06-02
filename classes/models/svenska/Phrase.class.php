<?php
/**
 * Phrase class
 * @author etheridgeb
 *
 */
class Phrase extends Database implements Paginateable
{
    const SEARCH_PLACEHOLDER = "Enter all or part of the word or phrase";

	protected $_tablename="phrase";	

	public function __construct() {
		parent::__construct();
	}
	
	public function getTableName() {
		return $this->_tablename;
	}	
  
    public function getRowCount($condition) {
        $query = "SELECT count(*) FROM phrase WHERE 1 $condition";
        return $this->ExecuteScaler($query);
    }

    public function getResultSet($condition, $start=null, $limit=null) {
        $query = "SELECT * FROM phrase WHERE 1 $condition ";
        $limitStr = '';
        if ($limit) {
          $limitStr = "LIMIT $start, $limit";
        }
        $query .= "ORDER BY fphrase $limitStr";
        ///p($query);
        return $this->ExecuteSelectQuery($query);
    }

    public function getSearchCondition($pattern, $fromDate=null, $toDate=null) {
        $pattern = $this->make_safe($pattern);
        $condition = " AND (fphrase LIKE '%$pattern%' OR ephrase LIKE '%$pattern%') OR pronunciation LIKE '%$pattern%' ";
        if ($fromDate) {
          $condition .= " AND created_on>='$fromDate 00:00:00'";
        }
        if ($toDate) {
          $condition .= " AND created_on<='$toDate 23:59:59'";
        }
        return $condition;
    }
	
	public function getPhraseById($phraseId)
	{
    $query = "SELECT * FROM phrase WHERE 1 AND phrase_id='$phraseId'";
		$data = $this->ExecuteSelectQuery($query);
		if (count($data) == 0) {
			return null;
		}
		return $data[0];
	}

    public function getPhrase()
	{
		$query = "SELECT * FROM phrase WHERE 1";
		$query .= "ORDER BY created_on DESC";
		return $this->ExecuteSelectQuery($query);
	}
  
}