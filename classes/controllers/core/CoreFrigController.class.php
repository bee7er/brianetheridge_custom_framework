<?php
/*
 * This controller is for handling frig requests, i.e. where we are
 * running a one-off data manipulation
 */
class CoreFrigController extends CoreController
{
 	private $_action;
	private $_parm1;	
	private $_parm2;	
	private $_parm3;			
	
	public function __construct($action='', $parm1=null, $parm2=null, $parm3=null) {
		parent::__construct();

		$this->_action = $action;	
		$this->_parm1 = $parm1;
		$this->_parm2 = $parm2;
		$this->_parm3 = $parm3;
	}

	public function perform() {
		parent::perform();
		
		$this->_View->assign('pageTitle', 'Frig Manager');	  
		switch($this->_action)
		{
		case 'action':
			$this->_action($this->_parm1);
			break;
		case 't':
			$this->_runT();
			break;    
		default:		    
			die('Unexpected action');
			break;
		}
	}
	
	private function _action()
	{		
		die('This frig has already been run.');
	}
  
	private function _runT()
	{		
    $this->_View->_baseTemplate = "core/blank.tpl";
		$this->_View->assign('Content', $this->_View->fetch('core/t.tpl'));
	}  

}