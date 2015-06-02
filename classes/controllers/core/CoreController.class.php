<?php
/*
 * This controller is for handling requests for the "front-end"
 */

class CoreController extends Controller {

	protected $loggedIn;
	protected $pageRequiresLogin = true;

	public function __construct() {

		parent::__construct();

		$this->_View = new CoreView();
		// Most pages require login
		$this->checkIsLoggedIn();
	}

	public function perform() {
		parent::perform();
	}

	public function checkIsLoggedIn()
	{
		if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn']) {
			// Ok
		} else {
            $orgAction = $this->_View->_tpl_vars['uri'];
            if ($orgAction == '/') {
                $orgAction = '/home';
            }
			// ensure we do not go into a redirection loop
			if (strpos($orgAction,'/login')!==false
             || strpos($orgAction,'/forgotPwd')!==false) {
                // Ok
            } else {
                // Check if we are going to a public page
                if (strpos($orgAction,'/help')!==false
                 || strpos($orgAction,'/home')!==false
                 || strpos($orgAction,'/contact')!==false
                 || strpos($orgAction,'/cookies')!==false
                 || strpos($orgAction,'/svenska')!==false) {
                    // Anyone can see these pages
                } else {
				    $this->redirect('login');
                }
			}
		}
		// Assign variables to view
		$this->_View->assign('userLoggedIn', (isset($_SESSION['userLoggedIn']) ? $_SESSION['userLoggedIn']: 0));
		$this->_View->assign('userName', (isset($_SESSION['userName']) ? $_SESSION['userName']: ''));
        $this->_View->assign('userRole', (isset($_SESSION['userRole']) ? $_SESSION['userRole']: ''));
	}

    public function performLogout()
    {
        session_start();
        session_unset();
        session_destroy();
        session_write_close();
        setcookie(session_name(),'',0,'/');
        session_regenerate_id(true);
        $this->redirect('home');
    }

    public function performLogin($emailId, $password)
    {
        $User = new User();
        $validUser = $User->validateLogin($emailId, $password);
        if ($validUser) {
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['userName'] = ($validUser['first_name'].' '.$validUser['surname']);
            $_SESSION['userPreviewFolder'] = $validUser['folder'];
            $_SESSION['userId'] = $validUser['user_id'];
            $_SESSION['emailId'] = $validUser['email_id'];
            $_SESSION['userRoleId'] = $validUser['user_role_id'];
            $_SESSION['userRole'] = $validUser['role_title'];
            $_SESSION['userOptionsMask'] = $validUser['options_mask'];

            return true;
        }
        $this->_View->assign('txt_email_id', $_REQUEST['txt_email_id']);
        MessageHelper::addMessage('Your username or password is incorrect');
        return false;
    }
}