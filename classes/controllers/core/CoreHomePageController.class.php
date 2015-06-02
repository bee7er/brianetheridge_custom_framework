<?php
/*
 * This controller is for handling requests for the core home page
 */
class CoreHomePageController extends CoreController
{

    private $action;
    private $startPage;

    public function __construct($action = '')
    {
        parent::__construct();

        $this->action = $action;
    }

    public function perform()
    {
        parent::perform();

        $this->_View->assign("baseUrl", BASE_URL);
        switch ($this->action) {
            case 'offline':
                $this->showCoreOfflinePage();
                break;
            default:
                $this->displayMain();
                break;
        }
    }

    private function displayMain()
    {
        $this->startPage = (isset($_SESSION['home_startPage']) ? $_SESSION['home_startPage'] : 1);

        $Resource = new Resource();
        $Paginate = new Paginate();
        $Paginate->generate($Resource, $condition = " AND status='".Resource::RESOURCE_ACTIVE."'", $this->startPage);
        $resources = $Paginate->getData();
        if ($resources) {
            foreach ($resources as &$resource) {
                // Nothing to do at present
            }
        }

        //die($Paginate->getPaginationStr());

        $this->_View->assign('resources', $resources);
        $this->_View->assign('paginationStr', $Paginate->getPaginationStr());
        $this->_View->assign('pageTitle', 'Fascination with the number 9');
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'home');
        $this->_View->assign('Content', $this->_View->fetch('core/home.tpl'));
    }

    public function showCoreOfflinePage()
    {
        $this->_View->assign('pageTitle', 'Site is Offline');
        // Process any outstanding error messages
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('Content', $this->_View->fetch('core/offline.tpl'));
    }

    protected function gotoPageOnClick($page) {
        $_SESSION['home_startPage'] = $page;
    }
}