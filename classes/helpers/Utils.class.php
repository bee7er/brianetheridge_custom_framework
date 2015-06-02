<?php

/**
 * Utility functions.
 */
class Utils {

	public static $yesnoTypes = array('1'=>'Yes', '0'=>'No');
    public static $nullDate = '0000-00-00 00:00:00';
	
	/**
	 * Builds a separated list from an array
	 */
	public function getSeparatedList($elems, $separatorValue=',')
	{
		$rtnStr = '';
		$separator = '';
		if (is_array($elems)) {
			if ($elems) {
				foreach ($elems as $elem) {
					$rtnStr .= ($separator.$elem);
					$separator = $separatorValue;
				}
			}
		} else {
			$rtnStr = $elems;
		}
		return $rtnStr;
	}
		
	/**
	 * Returns a Unix timestamp for a date in the specified format 
	 */
	public static function getTimeFromFormat($dateStr, $format) 
	{
		$dateAry = self::getDateParts($dateStr, $format);
		return mktime(0,0,0, $dateAry['month'], $dateAry['day'], $dateAry['year']); 
	}
  
	public static function getExternalDate($dateStr, $format='Y-m-d') 
	{
    if (!$dateStr || $dateStr==self::$nullDate) {
      return null;
    }    
		$dateAry = self::getDateParts($dateStr, $format);
		return ($dateAry['day'].'/'.$dateAry['month'].'/'.$dateAry['year']);
	}

	public static function getInternalDate($dateStr, $format='d-m-Y') 
	{
    if (!$dateStr || $dateStr==self::$nullDate) {
      return null;
    }
		$dateAry = self::getDateParts($dateStr, $format);
		return ($dateAry['year'].'-'.$dateAry['month'].'-'.$dateAry['day']);
	}  
	
	/**
	 * Returns part of a date:
	 * 		year
	 * 		month
	 * 		day
	 */
	public static function getDatePart($dateStr, $part, $format='Y/m/d') 
	{
		$dateAry = self::getDateParts($dateStr, $format);
		switch($part) {
			case 'year':
			case 'month':
			case 'day':
				// Ok
				break;
			default:
				die('Utils::getDatePart Date part not supplied in an expected format');
				break;								
		}		
		return $dateAry[$part];
	}

	/**
	 * Returns all parts of a date 
	 */
	public static function getDateParts($dateStr, $format='Y/m/d') 
	{
		switch($format) {
			case 'Y/m/d':
			case 'Y-m-d':
				list($y, $m, $d) = preg_split('/[-\.\/ ]/', $dateStr);
				break;
			case 'm/d/Y':
			case 'm-d-Y':
				list($m, $d, $y) = preg_split('/[-\.\/ ]/', $dateStr);
				break;
			case 'd/m/Y':
			case 'd-m-Y':
				list($d, $m, $y) = preg_split('/[-\.\/ ]/', $dateStr);
				break;
			default:
				die('Utils::getTimeFromFormat Date format not supplied in an expected format');
				break;								
		}
		return array('year' => $y, 'month' => $m, 'day' => $d); 
	}	

	/**
	 * Remove null elements from an array
	 */
	public static function array_compress($elems) {
		$rtnArray = array();
		if ($elems) {
			foreach ($elems as $elem) {
				if ($elem) {
					$rtnArray[] = $elem;
				}
			}
		}		
		return $rtnArray;
	}	

	/**
	 * Merge arrays when not sure which one has any data.
	 */
	public static function array_combine($ary1, $ary2)
	{		
		if ($ary2) {
			if ($ary1) {
				$ary1 = array_merge($ary1, $ary2);
			} else {
				$ary1 = $ary2;
			}
		}
		return $ary1;
	}	
	
	/**
	 * Returns a JSON encoded string for the array passed
	 * 
	 * Used instead of json_encode, because that requires later than 5.1.6.
	 */
	public static function getJsonEncode($data) 
	{
		$json = new Services_JSON();
		$retnData = array();
		// NB Must remove newline/carriage return chars.
		if ($data) {
			foreach ($data as $key => $value) {
				if (gettype($value) == "string"){
					$retnData[$key] = trim(($value === null ? '': $value));				
				} else {
					if ($value) {
						// It is an array.  Examine each field and switch any null values to a null string.
						foreach ($value as $valueKey => &$valueValue) {	
							if ($valueValue == null) {
								$valueValue = '';
							}			
						}			
					}	
					$retnData[$key] = $value;
				}
			}	
		}
		return $json->encode($retnData);
	}	
	
	/**
	 * Makes a directory and allows access to it
	 */
	public static function checkExists($dir) 
	{
		if (!file_exists($dir)) {
			// Create the target directory
			if (!mkdir($dir, 0777)) { 
				print '<br />Could not create directory: '.$dir.'<br />';
		      	return false;
			}
			if (!chmod($dir, 0777)) { 
		      	return false;
			}	        
		}	
		return true;		
	}
	
	/**
	 * Produces a line of output
	 */
	public static function outl($str) {
    // There can be problems with invalid characters embedded in the content.
    // Here we do something about it.
    //Originally:  return $str."\n";			
    return iconv("UTF-8", "ISO-8859-1//IGNORE", $str).PHP_EOL;	
		//This does not help:   return iconv("UTF-8", "ISO-8859-1//TRANSLIT", $str).PHP_EOL;			
	}	
	
    /**
     * Limits the length of text displayed and attaches a elipsis
     * if longer than the length specified
     *
     */
    public static function more($string, $length) {
        $outStr = substr($string, 0, $length);
        if ($outStr != $string) {
        	// We lost something on the substring
        	$strLen = strlen($outStr);
        	if ($strLen > 3) {
        		// Find the last space and add an elipsis to it        		
        		$lastSpace = strrpos($outStr, ' ');
        		$outStr = (substr($outStr, 0, ($lastSpace - $strLen)).' &hellip;');
        	}        	
        }
        return $outStr;
    }
    
    public static function is_alphabetic($string) {
        if ($string) {
          $len = strlen($string);
          for ($i=0; $i<$len; $i++) {
            if (is_numeric($string[$i])) {
              return false;
            }
          }
        }
        return true;
    }

    public static function startsWith($haystack, $needle) {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    public static function endsWith($haystack, $needle) {
        $length = strlen($needle);
        if ($length == 0) {
            return false;
        }
        return (substr($haystack, -$length) === $needle);
    }

    public static function generateCaptcha() {
        return substr(uniqid(),3,6);
    }
}