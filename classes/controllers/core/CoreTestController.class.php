<?php
/*
 * This controller is for handling requests for the core tests
 */
class CoreTestController extends CoreController {
	
	private $action;
    	
	public function __construct($action='') {
		parent::__construct();
    
		$this->action = $action;	
	}

	public function perform()
	{
		parent::perform();
 
    $this->displayMain();  
		$this->_View->assign("baseUrl", BASE_URL);
	}

	private function displayMain()
	{	
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'test');
		$this->_View->assign('Content', $this->_View->fetch('core/test.tpl'));
	}
 
}