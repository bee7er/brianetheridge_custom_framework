<?php
/*
 * This controller is for handling requests for the core login page
 */
class CoreLoginPageController extends CoreController {
	
	private $_action;
    private $_subAction;
    	
	public function __construct($action = '') {
		parent::__construct();
		
		$this->_action = $action;
    }

	public function perform()
	{
		parent::perform();

		$this->_View->assign("baseUrl", BASE_URL);
		switch ($this->_action) {
            case 'logout':
                $this->performLogout();
                break;
			default:
				break; 
		}
        $this->displayMain();
	}

	public function displayMain()
	{
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'login');
		$this->_View->assign('Content', $this->_View->fetch('core/login.tpl'));
	}
	
	public function btnLoginOnClick()
	{
		if ($this->performLogin($_REQUEST['txt_email_id'], $_REQUEST['txt_password'])) {
            $this->redirect('home');
        }
	}

}