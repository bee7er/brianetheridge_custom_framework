<?php
/*
 * This controller is for handling the Swedish phrase page
 */
class SvenskaPhraseController extends CoreController
{
    private static $specialCharsAry = array(array('Alt+0196'=>'&Auml;', 'Alt+0228'=>'&auml;'),array('Alt+0197'=>'&Aring;', 'Alt+0229'=>'&aring;'),array('Alt+0214'=>'&Ouml;', 'Alt+0246'=>'&ouml;'));
    private $action;
    private $startPage;

    public function __construct($action = '') {
        parent::__construct();

        $this->action = $action;
    }

    public function perform() {
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

    private function displayMain() {
        $searchPattern = (isset($_SESSION['svenska_txt_searchPattern']) ? $_SESSION['svenska_txt_searchPattern'] : '');
        $this->startPage = (isset($_SESSION['svenska_startPage']) ? $_SESSION['svenska_startPage'] : 1);

        $Phrase = new Phrase();
        $Paginate = new Paginate();
        $Paginate->generate($Phrase, $Phrase->getSearchCondition($searchPattern), $this->startPage);
        $phrases = $Paginate->getData();
        if ($phrases) {
            foreach ($phrases as &$phrase) {
                // Nothing to do at present
            }
        }
        ///pr($Paginate);
        ///pr($phrases);
        $this->_View->assign('phrases', $phrases);
        $this->_View->assign('specialChars', HtmlUtils::getSpecialCharTable(self::$specialCharsAry));
        $this->_View->assign('paginationStr', $Paginate->getPaginationStr());
        $this->_View->assign('searchPlaceholder', Phrase::SEARCH_PLACEHOLDER);
        $this->_View->assign('txt_searchPattern', $searchPattern);
        $this->_View->assign('help', '/svenska');
        $this->_View->assign('page', 'svenska');
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'svenskaList');
        $this->_View->assign('Content', $this->_View->fetch('svenska/svenskaList.tpl'));
    }

    protected function gotoPageOnClick($page) {
        $_SESSION['svenska_startPage'] = $page;
    }

    protected function searchOnClick() {
        if ($_POST && isset($_POST['txt_searchPattern'])) {
            $_SESSION['svenska_txt_searchPattern'] = $_POST['txt_searchPattern'];
        }
        // Search from the beginning
        $_SESSION['svenska_startPage'] = 1; //p($_SESSION);
    }

    public function showCoreOfflinePage() {
        // Process any outstanding error messages
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('Content', $this->_View->fetch('core/offline.tpl'));
    }

}