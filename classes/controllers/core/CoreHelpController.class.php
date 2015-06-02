<?php
/*
 * This controller is for handling Help requests
 *
 * NB See derived classes for overriding the help text
 */
class CoreHelpController extends CoreController
{
    private $topics = array(
        array('topic_id'=>'1','title'=>'Using this website','description'=>'Read the text. Use the buttons and other links.')
    );
	
	public function __construct() {
		parent::__construct();

        $this->_View->assign('pageTitle', 'Help');
        $this->_View->assign('topics', $this->topics);
    }

	public function perform() {
		parent::perform();

        $this->_showHelp();
	}

    public function _showHelp()
    {
        // Override the template so that it is suitable for a popup.
        $this->_View->_baseTemplate = "core/popup.tpl";
        $this->_View->assign('page', 'help');
        $this->_View->assign('Content', $this->_View->fetch('core/help.tpl'));
    }
}