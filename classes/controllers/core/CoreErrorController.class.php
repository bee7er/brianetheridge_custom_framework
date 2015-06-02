<?php

class CoreErrorController extends CoreController 
{  
	private $inPopup;
	
	public function __construct($inPopup) {
		parent::__construct();
		
		
		$this->inPopup = $inPopup;
	}
	
	public function perform() 
	{
		parent::perform();
		
		$errors = MessageHelper::getMessages();
		if (!$errors || count($errors) <= 0) {
			$errors = array('Unknown error');
		}
		
		$this->_View->assign('inPopup', $this->inPopup);
		$this->_View->assign('error_messages', $errors);
		if ($this->inPopup) {
			// Override the template so that it is suitable for a popup.
			$this->_View->_baseTemplate = "core/popup.tpl";
		}
        $this->_View->assign('page', 'error');
		$this->_View->assign('Content', $this->_View->fetch('core/core_error.tpl'));		
	}
}