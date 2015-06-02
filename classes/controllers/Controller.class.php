<?php
ob_start();
session_start();
/*
 * This is the base controller
 */

class Controller {
	protected $user;
	protected $baseTemplate;
	public $_View;

	public function __construct() {
		return true;
	}

	public function perform() {

		// Generate a random token to be used in request - anti CSRF measure
		if (!isset($_SESSION['sessionToken']))
		{
			$token = md5(rand(1, 1000000));
			$_SESSION['sessionToken'] = $token;
		}
		else
		{
			if ($_POST) {				
				if (!isset($_POST['sessionToken'])
				 || (isset($_POST['sessionToken']) && $_POST['sessionToken'] != $_SESSION['sessionToken'])) {
					echo '<h1>Invalid request!</h1>';
					exit;
				}
			}
		}
		$this->_View->assign('sessionToken', $_SESSION['sessionToken']);
		$this->_View->assign('siteIsOffline', $_SESSION['siteIsOffline']);
			
		// Set up authorities
		///p($_SESSION['userOptionsMask']);
		$this->_View->assign('userOptionsMask', (isset($_SESSION['userOptionsMask']) ? $_SESSION['userOptionsMask']: 0));		
		$this->_View->assign('userCapability', USER_CAPABILITY);
        $this->_View->assign('administratorCapability', ADMINISTRATOR_CAPABILITY);

		if(isset($_POST['hidEvent']) && $_POST['hidEvent'])
		{
			if(isset($_POST['hidArguments']) && $_POST['hidArguments'] != "") {
				$arr = explode(',', $_POST['hidArguments']);
				call_user_func_array(array($this, $_POST['hidEvent']), $arr);
			} else {
				call_user_func(array($this, $_POST['hidEvent']));
			}
		}
		return true;
	}

	public function isAuthorised($requiredAuthority) {
        $result = false;
        if (isset($_SESSION['userOptionsMask'])) {
            if ($requiredAuthority & $_SESSION['userOptionsMask']) {
                // User has the necessary authority
                $result = true;
            } else {
                MessageHelper::addMessage("You do not have the necessary authority to access the requested page", MessageHelper::MESSAGE_TYPE_COMPLETION);
            }
        } else {
            MessageHelper::addMessage("You need to be logged in to access the requested page", MessageHelper::MESSAGE_TYPE_COMPLETION);
        }
        return $result;
	}
  
  public function display() {
		$this->_View->render();
	}

	public function redirect($url) {
        if (strpos(strtolower($url), 'http')===false) {
            $url = APP_DIRECTORY.$url;
        }
		header("Location: $url");
		exit;
	}
}