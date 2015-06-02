<?php
/*
 * This is main base View class
 */

class View extends Smarty {
	public $_baseTemplate;

	public function __construct() {
		//$this->_baseTemplate = "core/index.tpl";

		$this->caching = false;
		$this->compile_dir = TEMPLATE_COMPILE_DIR;
		$this->template_dir = TEMPLATE_DIR;
		$this->plugins_dir = array(TEMPLATE_PLUGIN_DIR,TEMPLATE_PLUGIN_DIR_2);
		$this->load_filter('output', 'striptabs');

		$this->assign("stylesheet", "base.css");

		$this->assign("print", "print.css");
		$this->assign("basePath", DC::$urlPrefix . BASE_URL);
		$this->assign("PHPSELF", DC::$urlPrefix . BASE_URL . $_SERVER['PHP_SELF']);
		$this->assign("uri", $_SERVER["REQUEST_URI"]);
        $this->assign("companyName", FROM_COMPANY_NAME);
	}
	public function render() {
		$this->display($this->_baseTemplate);
	}
}