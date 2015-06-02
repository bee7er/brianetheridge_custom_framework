<?php
/*
 * This controller is for handling Help requests
 */
class SiteHelpController extends CoreHelpController
{
    private $topics = array(
        array('topic_id'=>'1','title'=>'Resource','description'=>'Maintaining resource content used by the application.')
    );

    public function __construct() {
        parent::__construct();

        $this->_View->assign('page', 'help');
        $this->_View->assign('pageTitle', 'Help');
        $this->_View->assign('topics', $this->topics);
    }
}