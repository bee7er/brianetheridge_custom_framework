<?php
/*
 * This controller is for handling requests for the core cookies page
 */
class CoreCookiesPageController extends CoreController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function perform()
    {
        parent::perform();

        $this->_View->assign("baseUrl", BASE_URL);
        $this->displayMain();
    }

    private function displayMain()
    {
        $this->_View->assign('pageTitle', 'Cookies');
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'cookies');
        $this->_View->assign('Content', $this->_View->fetch('core/cookies.tpl'));
    }
}