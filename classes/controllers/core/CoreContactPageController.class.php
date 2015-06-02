<?php
/*
 * This controller is for handling requests for the core contact page
 */
class CoreContactPageController extends CoreController {
    	
	public function __construct() {
		parent::__construct();
    }

	public function perform()
	{
		parent::perform();

		$this->_View->assign("baseUrl", BASE_URL);
        $this->displayMain();
	}

	public function displayMain()
	{
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'contact');
		$this->_View->assign('Content', $this->_View->fetch('core/contact.tpl'));
	}
	
	public function btnContactOnClick()
	{
        if ($_POST) {
            // Email the message
            $Mailer = new MailHelper();
            $Mailer->addEmailAddresses(DC::$siteEmailRecipients);
            $Mailer->setSubject('Contact from be.com: '.$_POST['subject']);
            $Mailer->setBody('Message from: '.$_POST['email'].'<br /><br />Message: '.$_POST['message']);
            if ($Mailer->send()) {
                MessageHelper::addMessage('Thank you for your email.');
                $this->redirect('home');
            } else {
                MessageHelper::addMessage('Sorry, there was a problem sending your email.');
            }
        }
	}

}