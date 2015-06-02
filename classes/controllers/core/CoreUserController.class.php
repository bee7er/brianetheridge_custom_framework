<?php
/*
 * This controller is for handling requests for the core user page
 */
class CoreUserController extends CoreController
{

    private $action;
    private $userId;
    private $startPage;

    public function __construct($action = '', $userId = null)
    {
        parent::__construct();

        // Admin authority is needed for this function
        if (!$this->isAuthorised(ADMINISTRATOR_CAPABILITY)) {
            $this->redirect("home");
        }

        $this->action = $action;
        $this->userId = $userId;
    }

    public function perform()
    {
        parent::perform();

        switch ($this->action) {
            case 'active':
                $this->makeActive();
                break;
            case 'inactive':
                $this->makeInactive();
                break;
            case 'edit':
                $this->editUser();
                break;
            default:
                $this->displayMain();
                break;
        }
        $this->_View->assign("baseUrl", BASE_URL);
    }

    private function displayMain()
    {
        $searchPattern = (isset($_SESSION['user_txt_searchPattern']) ? $_SESSION['user_txt_searchPattern'] : '');
        $selUserRoleId = (isset($_SESSION['user_sel_user_role_id']) ? $_SESSION['user_sel_user_role_id'] : '');
        $selAccountStatus = (isset($_SESSION['user_sel_account_status']) ? $_SESSION['user_sel_account_status'] : '');
        $this->startPage = (isset($_SESSION['user_startPage']) ? $_SESSION['user_startPage'] : 1);

        $User = new User();
        $Paginate = new Paginate();
        $Paginate->generate($User, $User->getAdminSearchCondition($searchPattern, $selUserRoleId, $selAccountStatus), $this->startPage);
        $UserRole = new UserRole();
        $userRoles = $UserRole->getUserRoles();

        $users = $Paginate->getData();
        $this->_View->assign('users', $users);
        $this->_View->assign('userRoles', $userRoles);
        $this->_View->assign('accountStatuses', User::$accountStatusValues);
        $this->_View->assign('paginationStr', $Paginate->getPaginationStr());
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('searchPlaceholder', User::SEARCH_PLACEHOLDER);
        $this->_View->assign('txt_searchPattern', $searchPattern);
        $this->_View->assign('selUserRoleId', $selUserRoleId);
        $this->_View->assign('selAccountStatus', $selAccountStatus);
        $this->_View->assign('page', 'userList');
        $this->_View->assign('Content', $this->_View->fetch('core/userList.tpl'));
    }

    private function makeActive()
    {
        $this->setUserAccountStatus(User::USER_STATUS_ACTIVE);
    }

    private function makeInactive()
    {
        $this->setUserAccountStatus(User::USER_STATUS_INACTIVE);
    }

    private function setUserAccountStatus($accountStatus)
    {
        if (!$this->userId) {
            MessageHelper::addMessage('User id not found');
            $this->redirect("users/list");
        }
        $User = new User();
        $data = array('account_status' => $accountStatus);
        $User->update($data, array('user_id' => $this->userId));
        MessageHelper::addMessage("User made $accountStatus", MessageHelper::MESSAGE_TYPE_COMPLETION);
        $this->redirect("users/list");
    }

    protected function gotoPageOnClick($page)
    {
        $_SESSION['user_startPage'] = $page;
    }

    protected function searchOnClick()
    {
        if ($_POST) {
            if (isset($_POST['txt_searchPattern'])) {
                $_SESSION['user_txt_searchPattern'] = $_POST['txt_searchPattern'];
            }
            if (isset($_POST['sel_user_role_id'])) {
                $_SESSION['user_sel_user_role_id'] = $_POST['sel_user_role_id'];
            }
            if (isset($_POST['sel_account_status'])) {
                $_SESSION['user_sel_account_status'] = $_POST['sel_account_status'];
            }
        }
        // Search from the beginning
        $_SESSION['user_startPage'] = 1;
    }

    private function editUser()
    {
        if (!$this->userId) {
            MessageHelper::addMessage('User id not found');
            $this->redirect("users/list");
        }
        $User = new User();
        // Validate user id
        $user = $User->getUserById($this->userId);
        if (!$user) {
            MessageHelper::addMessage('Invalid user id');
            $this->redirect("users/list");
        }
        $updateFromPostValues = false;
        if ($_POST) {
            // Make sure email is unique
            if (!$User->isValidEmail($this->userId, $_POST['txt_email_id'])) {
                MessageHelper::addMessage("Invalid email address or email address has already been used");
                // We are going around again, but use POST data
                $updateFromPostValues = true;
            } else {
                $data = array('user_role_id' => $_POST['sel_user_role_id'],
                    'first_name' => $_POST['txt_first_name'],
                    'surname' => $_POST['txt_surname'],
                    'email_id' => $_POST['txt_email_id'],
                    'account_status' => $_POST['sel_account_status']);
                // Check if password update was included
                if ($_POST['txt_password']) {
                    $data['password'] = $User->generateEncryptedPassword($_POST['txt_password']);
                }
                $User->update($data, array('user_id' => $this->userId));
                MessageHelper::addMessage("User updated", MessageHelper::MESSAGE_TYPE_COMPLETION);
                $this->redirect("users/list");
            }
        }
        if ($updateFromPostValues) {
            if ($_POST['sel_user_role_id']) {
                $user['user_role_id'] = $_POST['sel_user_role_id'];
            }
            if ($_POST['txt_first_name']) {
                $user['first_name'] = $_POST['txt_first_name'];
            }
            if ($_POST['txt_surname']) {
                $user['surname'] = $_POST['txt_surname'];
            }
            if ($_POST['txt_email_id']) {
                $user['email_id'] = $_POST['txt_email_id'];
            }
            if ($_POST['sel_account_status']) {
                $user['account_status'] = $_POST['sel_account_status'];
            }
        }
        // Load edit page
        $UserRole = new UserRole();
        $userRoles = $UserRole->getUserRoles();
        ///p($symptom);
        $this->_View->assign('mode', 'edit');
        $this->_View->assign('user', $user);
        $this->_View->assign('userRoles', $userRoles);
        $this->_View->assign('accountStatuses', User::$accountStatusValues);
        $this->_View->assign('appMsgs', MessageHelper::getMessages());
        $this->_View->assign('Content', $this->_View->fetch('core/userEdit.tpl'));
    }

}