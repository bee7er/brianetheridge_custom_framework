<?php

/**
 * Utility functions.
 */
class HtmlUtils {

	/**
	 * Generates a table of special chars, from an array of them
	 */
	public function getSpecialCharTable($specialChars)
	{
		$rtnHtml = '';
		if (is_array($specialChars)) {
			if ($specialChars) {
                $rtnHtml .= '<table><tbody>';
				foreach ($specialChars as $specialChar) {
                    $rtnHtml .= '<tr>';
                    foreach ($specialChar as $specialCharKey=>$specialCharChar) {
                        $rtnHtml .= "<td>$specialCharKey: </td><td>$specialCharChar</td>";
                    }
                    $rtnHtml .= '</tr>';
				}
                $rtnHtml .= '</tbody></table>';
			}
		}
        ///pr($rtnHtml);
		return $rtnHtml;
	}

}