<?php
/*
 * This controller is for handling requests for the core forgot pwd page
 */
class CoreForgotPwdController extends CoreController {
	
	private $_action;
    	
	public function __construct($action = '') {
		parent::__construct();

		$this->_action = $action;
    }

	public function perform()
	{
		parent::perform();

		$this->_View->assign("baseUrl", BASE_URL);
        switch($this->_action) {
            case 'resetPwd':
                $this->processReset();
                break;
            case 'changePwd':
                $this->processChange();
                break;
            default:
                $this->displayMain();
                break;
        }

	}

	public function displayMain()
	{
        if ($_POST && $_POST['txt_email_id'] && $_POST['from_forgot']) {
            // Validate the captcha value
            if ($_POST['txt_captcha']!=$_SESSION['captcha']) {
                MessageHelper::addMessage('The security characters were entered incorrectly.<br />Please try again.');
            } else {
                // NB This is how the reset mechanism works:
                // user enters email address
                // create ssltoken
                // save the token to the user's db record
                // encrypt the token along with the user id and the time to live of the link (default is 10 minutes)
                // send link via email with the encrypted details
                // the user clicks on the link and we decrypt the details
                // we check the time and timeout the link if appropriate
                // we compare the token with that on the db
                // anything wrong and we go back to the reset password get email page
                // if all ok we present the change password page.
                // the user enters the new pwd and confirmation pwd
                // with these details we confirm using the token once more, then update
                // the pwd and reset the token to blank on the db
                $User = new User();
                $user = $User->getUserByEmailId($_POST['txt_email_id']);
                if ($user) {
                    // Generate a user token
                    $token = $User->generateUserToken($user);
                    // Save it to the user db record
                    $User->update(array('auth_token'=>$token), array('user_id'=>$user['user_id']));
                    // Send user an email with the encrypted details
                    $this->_View->assign('companyName', FROM_COMPANY_NAME);
                    $this->_View->assign('companyTelephone', FROM_COMPANY_TELEPHONE);
                    $this->_View->assign('companyAddress', FROM_COMPANY_ADDRESS);
                    $this->_View->assign('companySupportEmail', DC::$companySupportEmail);
                    $this->_View->assign('resetPwdLink', ('http://'.BASE_URL.'forgotPwd/resetPwd/?token='.$token));

                    $Mailer = new MailHelper();
                    $Mailer->addEmailAddress($_POST['txt_email_id']);
                    $Mailer->setSubject(FROMNAME.' Forgotten Password Instructions');
                    $Mailer->setBody($this->_View->fetch('emails/forgotten_pwd_email.tpl'));
                    if ($Mailer->send()) {
                        MessageHelper::addMessage('Please check your emails. We have sent instructions to help you reset your password.');
                    } else {
                        MessageHelper::addMessage('There was a problem sending your email.');
                    }
                    $this->redirect('login');
                } else {
                    $this->_View->assign('txt_email_id', $_POST['txt_email_id']);
                    MessageHelper::addMessage('Your username could not be found');
                }
            }
        }
        $_SESSION['captcha'] = Utils::generateCaptcha();
        $this->_View->assign('txt_email_id', $_POST['txt_email_id']);
        $this->_View->assign('captcha', $_SESSION['captcha']);
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('page', 'forgot_pwd');
        $this->_View->assign('Content', $this->_View->fetch('core/forgot_pwd.tpl'));
    }

    public function processReset()
    {
        if ($_GET && $_GET['token']) {
            $token = $_GET['token'];
            $User = new User();
            $user = $User->getUserByAuthorityToken($token);
            if ($user) {
                $this->_View->assign('token', $token);
                $this->_View->assign('appMsgs', MessageHelper::getMessages());
                $this->_View->assign('Content', $this->_View->fetch('core/change_pwd.tpl'));
                return;
            } else {
                MessageHelper::addMessage('Invalid or expired password reset instructions.<br />Please try again.');
                $this->redirect('forgotPwd');
            }
        } else {
            MessageHelper::addMessage('Invalid password reset instructions.');
        }
        $this->redirect('login');
    }

    public function processChange()
    {
        if ($_POST && $_POST['txt_password']) {
            if ($_POST['txt_password'] && $_POST['txt_password'] == $_POST['txt_confirm_password']) {
                // Re-validate using the token
                $User = new User();
                $token = $_POST['token'];
                $user = $User->getUserByAuthorityToken($token);
                if ($user) {
                    if ($User->updateUserPassword($user['user_id'], $_POST['txt_password'])) {
                        MessageHelper::addMessage('Your password has been updated.');
                        // Log in the user
                        if ($this->performLogin($user['email_id'], $_POST['txt_password'])) {
                            //MessageHelper::addMessage('You have been automatically logged in.');
                        }
                    }
                     $this->redirect('home');
                } else {
                    MessageHelper::addMessage('Invalid or expired password reset instructions.<br />Please try again.');
                    $this->redirect('forgotPwd');
                }
            }
        } else {
            MessageHelper::addMessage('Invalid new password details.');
        }
        $this->redirect('login');
    }


}