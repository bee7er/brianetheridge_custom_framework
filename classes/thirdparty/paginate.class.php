<?php

class Paginate
{
  const GET_ALL_DATA_PAGES = -1;
  const GET_ALL_DATA_LIMIT = 999999;
  
	public static $limit = PAGE_LIMIT;
  private $data;
  private $paginationStr;
  
  public function getData() {
    return $this->data;
  }
  
  public function getPaginationStr() {
    return $this->paginationStr;
  }
  
  public function generate($object, $condition, $getPage) {
                
    $totalRows = $object->getRowCount($condition);

    $stages = 3;
    $page = mysql_escape_string($getPage);
    if ($page) {
      $start = ($page - 1) * self::$limit; 
    } else {
      $start = 0;	
		}	
    $limit = self::$limit;
    if ($page == self::GET_ALL_DATA_PAGES) {
      // Get all records
      $start = 0;
      $limit = self::GET_ALL_DATA_LIMIT;
    }	
    // Get page data
    $this->data = $object->getResultSet($condition, $start, $limit);

    // Initial page num setup
    if ($page == self::GET_ALL_DATA_PAGES) {
      // Getting all the data, all in one go
      return '';
    }
    if ($page == 0) {
      $page = 1;
    }
    $prev = $page - 1;	
    $next = $page + 1;							
    $lastpage = ceil($totalRows/self::$limit);		
    $penultimatePage = $lastpage - 1;					
    $paginate = '';
    if ($lastpage > 1) {	
      $paginate .= "<div class='paginate'>";
      // Previous
      if ($page > 1) {
        $paginate .= "<a href='javascript:gotoPageOnClick($prev);'>previous</a>";
      } else {
        $paginate .= "<span class='disabled'>previous</span>";	
      }
      // Pages	
      if ($lastpage < 7 + ($stages * 2)) {	// Not enough pages to breaking it up	
        for ($counter = 1; $counter <= $lastpage; $counter++) {
          if ($counter == $page){
            $paginate .= "<span class='current'>$counter</span>";
          } else {
            $paginate .= "<a href='javascript:gotoPageOnClick($counter);'>$counter</a>";
          }					
        }
      } elseif($lastpage > 5 + ($stages * 2))	{ // Enough pages to hide a few?
        // Beginning only hide later pages
        if($page < 1 + ($stages * 2)) {
          for ($counter = 1; $counter < 4 + ($stages * 2); $counter++) {
            if ($counter == $page){
              $paginate .= "<span class='current'>$counter</span>";
            } else {
              $paginate .= "<a href='javascript:gotoPageOnClick($counter);'>$counter</a>";                
            }					
          }
          $paginate .= "...";
          $paginate .= "<a href='javascript:gotoPageOnClick($penultimatePage);'>$penultimatePage</a>";
          $paginate .= "<a href='javascript:gotoPageOnClick($lastpage);'>$lastpage</a>";		
        } elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2)) {
          // Middle hide some front and some back
          $paginate .= "<a href='javascript:gotoPageOnClick(1);'>1</a>";
          $paginate .= "<a href='javascript:gotoPageOnClick(2);'>2</a>";
          $paginate .= "...";
          for ($counter = $page - $stages; $counter <= $page + $stages; $counter++) {
            if ($counter == $page){
              $paginate .= "<span class='current'>$counter</span>";
            } else {
              $paginate .= "<a href='javascript:gotoPageOnClick($counter);'>$counter</a>";
            }					
          }
          $paginate .= "...";
          $paginate .= "<a href='javascript:gotoPageOnClick($penultimatePage);'>$penultimatePage</a>";
          $paginate .= "<a href='javascript:gotoPageOnClick($lastpage);'>$lastpage</a>";		
        } else {
          // End only hide early pages
          $paginate .= "<a href='javascript:gotoPageOnClick(1);'>1</a>";
          $paginate .= "<a href='javascript:gotoPageOnClick(2);'>2</a>";
          $paginate .= "...";
          for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++) {
            if ($counter == $page) {
              $paginate .= "<span class='current'>$counter</span>";
            } else {
              $paginate .= "<a href='javascript:gotoPageOnClick($counter);'>$counter</a>";  
            }					
          }
        }
      }
      // Next
      if ($page < $counter - 1) { 
        $paginate .= "<a href='javascript:gotoPageOnClick($next);'>next</a>";
      } else {
        $paginate .= "<span class='disabled'>next</span>";
      }
      $paginate .= "</div>";		
    }
    $this->paginationStr = $paginate;
  }
  
}