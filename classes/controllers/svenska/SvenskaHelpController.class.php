<?php
/*
 * This controller is for handling Help requests
 */
class SvenskaHelpController extends CoreHelpController
{
    private $topics = array(
        array('topic_id'=>'1','title'=>'Pronunciation','description'=>'How to pronounce the language. Conventions and exceptions.'),
        array('topic_id'=>'2','title'=>'Vocabulary','description'=>'The variety and complexity of words and phrases')
    );

    public function __construct() {
        parent::__construct();

        $this->_View->assign('pageTitle', 'Svenska Help');
        $this->_View->assign('page', 'help');
        $this->_View->assign('topics', $this->topics);
    }
}