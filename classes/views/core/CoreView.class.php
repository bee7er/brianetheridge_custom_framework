<?php
/*
 * This class handles the View for the front-end
 */

class CoreView extends View {
	public function __construct() {
		parent::__construct();
		// set base template
		$this->_baseTemplate = "core/index.tpl";
	}
}