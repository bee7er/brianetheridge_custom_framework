<?php
/**
 * Defines functions required to support pagination
 *
 * @author etheridgeb
 */
interface Paginateable {

  public function getRowCount($condition);
  
  public function getResultSet($condition, $start=null, $limit=null);
}