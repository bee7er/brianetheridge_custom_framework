<?php

//ini_set("display_errors", 1);
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

//phpinfo();
//exit;

try {
	require_once('includes/prepend.php');

	# Code for filtering the input data. It is current looking into user input from GET and POST methods.
	if (!empty($_REQUEST)) {
		$_REQUEST = filterInput($_REQUEST);
		$_POST = filterInput($_POST);
		$_GET = filterInput($_GET);
	}
	$url = $_SERVER["REQUEST_URI"];
	// Tidy up the request url
	$start=strpos($url, APP_DIRECTORY);
	$end=strlen(APP_DIRECTORY);
	$len=strlen($url);
	$url=substr($url,$end-1,$len);

	// NB Removing the initial forward slash
	$urlParams = explode('/', substr($url, 1));

	if (empty($urlParams[0])) {
		$urlParams[0] = "";
	}
	if (empty($urlParams[1])) {
		$urlParams[1] = "";
	}
	if (empty($urlParams[2])) {
		$urlParams[2] = "";
	}
	if (empty($urlParams[3])) {
		$urlParams[3] = "";
	}
	if (empty($urlParams[4])) {
		$urlParams[4] = "";
	}

	//require_once('classes/helpers/AjaxManager.class.php');
	//AjaxManager::processAjaxRequest('SaveDataItemValues?activityDataItemId=1&valueData=[{"value":"Yes","is_default":"0"},{"value":"No","is_default":"1"}]');
	//exit;
	//require_once('classes/helpers/AjaxManager.class.php');
	//AjaxManager::processAjaxRequest('GetDataItemsData?pageId=10');
	//exit;

    if (!$urlParams[0]) {
        $urlParams[0] = 'home';
    }
    $action = $urlParams[0];

//    pr($urlParams);

	// Check if the site is offline
	$Config = new Config();
	$siteIsOffline = $Config->getConfigValueById(Config::CONFIG_SITE_OFFLINE);
	$_SESSION['siteIsOffline'] = ($siteIsOffline == 'Y');
	if ($_SESSION['siteIsOffline']) {
		// Some actions are allowed
		switch($action) {
			case 'help':
            case 'help_with_config':
			case 'login':
			case 'logout':
				break;
			default:
				// The site is offline and the user is trying to take a restricted action.
				// Check if administrator.
				if ($_SESSION['userOptionsMask'] & ADMINISTRATOR_CAPABILITY) {
					// Do nothing, admin can use the site normally
				} else {
					$action = 'offline';
				}
				break;
		}
	}

	try {
		switch($action)
		{
			case 'error':
				require_once('classes/controllers/core/CoreErrorController.class.php');
				$controller = new CoreErrorController($inPopup);
				break;

			case 'login':
			case 'logout':
				require_once('classes/controllers/core/CoreLoginPageController.class.php');
				$controller = new CoreLoginPageController($urlParams[0]);
				break;

            case 'forgotPwd':
                require_once('classes/controllers/core/CoreForgotPwdController.class.php');
                $controller = new CoreForgotPwdController($urlParams[1], $urlParams[2]);
                break;

			case 'config':
				require_once('classes/controllers/core/CoreConfigController.class.php');
				$controller = new CoreConfigController($urlParams[1]);
				break;

			case 'offline':
				require_once('classes/controllers/core/CoreHomePageController.class.php');
				$controller = new CoreHomePageController($action);
				break;

			case 'home':
				require_once('classes/controllers/core/CoreHomePageController.class.php');
				$controller = new CoreHomePageController($urlParams[1],$urlParams[2]);
				break;

			case 'users':
				require_once('classes/controllers/core/CoreUserController.class.php');
				$controller = new CoreUserController($urlParams[1],$urlParams[2]);
				break;

            case 'contact':
                require_once('classes/controllers/core/CoreContactPageController.class.php');
                $controller = new CoreContactPageController();
                break;

            case 'cookies':
                require_once('classes/controllers/core/CoreCookiesPageController.class.php');
                $controller = new CoreCookiesPageController();
                break;

      		case 'help_with_config':
				require_once('classes/controllers/core/CoreHelpController.class.php');
				$controller = new CoreHelpController($urlParams[0]);
				break;

			case 'manageFrigs':
				require_once('classes/controllers/core/CoreFrigController.class.php');
				$controller = new CoreFrigController($urlParams[1], $urlParams[2], $urlParams[3], $urlParams[4]);
				break;

			// Non-core functions

			case 'help':
                if ($urlParams[1]=='svenska') {
                    require_once('classes/controllers/svenska/SvenskaHelpController.class.php');
                    $controller = new SvenskaHelpController();
                } elseif ($urlParams[1]=='site') {
                    require_once('classes/controllers/site/SiteHelpController.class.php');
                    $controller = new SiteHelpController();
                } elseif ($urlParams[1]=='config') {
                    require_once('classes/controllers/core/CoreConfigHelpController.class.php');
                    $controller = new CoreConfigHelpController();
                } else {
                    require_once('classes/controllers/core/CoreHelpController.class.php');
                    $controller = new CoreHelpController();
                }
				break;

            case 'resource':
                require_once('classes/controllers/site/SiteResourceController.class.php');
                $controller = new SiteResourceController($urlParams[1], $urlParams[2], $urlParams[3]);
                break;

      		case 'svenska':
				require_once('classes/controllers/svenska/SvenskaPhraseController.class.php');
				$controller = new SvenskaPhraseController($urlParams[1], $urlParams[2], $urlParams[3]);
				break;

			case 'test':
				require_once('classes/controllers/core/CoreTestController.class.php');
				$controller = new CoreTestController($urlParams[1],$urlParams[2]);
				break;

			default:
			 	require_once('classes/controllers/core/CoreHomePageController.class.php');
				$controller = new CoreHomePageController($urlParams[1], $urlParams[2]);
			 	break;
    	}
	} catch (Exception $e) {
		echo 'Sorry, there was a problem serving your request. Please try again later. Code A.';
		exit;
	}
	try {
    // Perform business logic
		$controller->perform();
	} catch (Exception $e) {
		echo 'Sorry, there was a problem serving your request. Please try again later. Code B.'.$e->getMessage();
		exit;
	}
	// Calls the view to render display output
	try {
		$controller->display();
	} catch (Exception $e) {
		echo 'Sorry, there was a problem serving your request. Please try again later. Code C.';
		exit;
	}
} catch (Exception $e) {
	echo 'Sorry, there was a problem serving your request. Please try again later. Code D: '.$e->getMessage();
	exit;
}