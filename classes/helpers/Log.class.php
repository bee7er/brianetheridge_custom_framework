<?php
/**
 * Log message to file system
 *
 * @author etheridgeb
 */
class Log {

  public static function l($msg) {
    $f = null;
		try {
      $logFile = APPLICATION_PHYSICAL_PATH.'/../log/out.log';
      $f = fopen($logFile, 'a');  
      $msg = (date('Y-m-d H:i:s')." $msg\n");
      if (!fwrite($f, $msg, strlen($msg))) {
        die('Log failed to write with length: '.strlen($msg));
      }			
    } catch(Exception $e) {
      print $e->getMessage();die;
    }
    if ($f) {
      fclose($f);
    }    
  }
}