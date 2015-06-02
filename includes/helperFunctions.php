<?php

	/*
	 * This function have been used to filter the input data.
	 * This will allow only the white listed elements into the system.
	 * Also this function can be configured for a separate list of whitelist elements according to the functionality
	 * For example: On login page no tags should be allowed and on Add new course page some tags should be allowed in description.
	 */
	function filterInput($data = array()) {
		
		$allowedElements = array('txt_content');
		
		if (!empty($data)) {
			$HtmlSanitizer = new HtmlSanitizer;
			foreach ($data as $var => $val) {
				// check if its allowed tags.
				if(!in_array($var,$allowedElements)){
					$val = $HtmlSanitizer->sanitize($val);
					$data[$var] = $HtmlSanitizer->sanitize($val);
				}
			}
		}
		return $data;
	}

	/*
	 * Function to make order by value used in mysql query, safe.
	 */
	function make_safe_order($orderBy) {
		# 1 will order by the query with the very first field of the table.
		$return = 1;
		$first_char = substr($orderBy, 0, 1);

		if (!is_numeric($first_char)) {
			# Strip spaces if any.
			$return = str_replace(' ', NULL, $orderBy);
		}
		return $return;
	}

	/*
	 * Function to make limit value used in mysql query, safe.
	 */
	function make_safe_limit($limit) {
		$return = 0;
		if (is_numeric($limit)) {
			$return = intval($limit);
		}
		return $return;
	}

	/*
	 * Helper function to get a list of ids from selection criteria
	 */
	function getIdList($filterFieldIdMixed) {
		$idString = '';
		if (is_array($filterFieldIdMixed)) {
			if (count($filterFieldIdMixed) > 0) {
				$comma = '';
				foreach ($filterFieldIdMixed as $filterFieldId) {
					if (!$filterFieldId) {
						continue;
					}
					$idString .= ($comma . $filterFieldId);
					$comma = ',';
				}
			}
		} else {
			$idString = $filterFieldIdMixed;
		}
		return $idString;
	}