<?php
/*
 * This controller is for handling Help requests
 */
class CoreConfigHelpController extends CoreHelpController
{
    private $topics = array(
        array('topic_id'=>'1','title'=>'Configuring the System','description'=>'This page allows the administrator to set certain system wide options.'),
        array('topic_id'=>'2','title'=>'Site offline','description'=>'<p>The <strong>Site offline</strong> option excludes all non-administrators from the application.</p><p>Although not mandatory, this facility should be used to avoid conflict when deploying a new release of the application. It ensures that users of the application cannot be changing data while the application itself is being changed.</p>')
    );

    public function __construct() {
        parent::__construct();

        $this->_View->assign('pageTitle', 'Help with Configuring the System');
        $this->_View->assign('topics', $this->topics);
    }
}