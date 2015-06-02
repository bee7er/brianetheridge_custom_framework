<?php
/*
 * A RESTful API to return application data to clients via a RESTful web service
 */

$validateSession = false;

session_start();

//ini_set("display_errors", 1);
//error_reporting(E_ALL);

require_once('../includes/config.php');
require_once('../includes/dynamicConfig.php');

//Helpers
require_once('../classes/helpers/Log.class.php');
require_once('../classes/helpers/MessageHelper.class.php');
require_once('../classes/helpers/Utils.class.php');

//Core models
require_once('../classes/models/Base.class.php');
require_once('../classes/models/core/DBHandler/DB.class.php');
require_once('../classes/models/core/DBHandler/Database.class.php');
require_once('../classes/models/core/Paginateable.class.php');
require_once('../classes/models/core/Config.class.php');
require_once('../classes/models/core/User.class.php');
require_once('../classes/models/core/UserRole.class.php');

/**
 * Step 1: Require the Slim Framework
 * NB Note use of the Slim namespace
 */
require '../classes/thirdparty/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, and `Slim::delete`
 * is an anonymous function.
 */

// *****************************************************************
// API GET and POST route definitions
$app->post('/login', 'login');
$app->post('/logout', 'logout');
$app->get('/getLoggedInSessionId', 'getLoggedInSessionId');
// User interface 
$app->get('/getUsers', 'getUsers');
$app->post('/addUser', 'addUser');
$app->put('/updateUser/:id', 'updateUser');
$app->delete('/deleteUser/:id', 'deleteUser');
// *****************************************************************
/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
// *****************************************************************
// Session checker
// *****************************************************************
function getCurrentUserId($errorIfNotFound=true) {
    global $validateSession;
    /*
    // Set timeout period in seconds to test session handling
    $inactive = 10;
    // Check to see if $_SESSION['timeout'] is set
    if(isset($_SESSION['timeout']) ) {
        $session_life = time() - $_SESSION['timeout'];
        if ($session_life > $inactive) {
            session_destroy();
            throw new Exception("Sorry, your session appears to have timed out");
        }
    }
    $_SESSION['timeout'] = time();
    */
    if (isset($_SESSION['userLoggedIn']) && $_SESSION['userLoggedIn']) {
        if (!isset($_SESSION['userId']) || $_SESSION['userId']<=0) {
            if ($errorIfNotFound) {
                throw new Exception("Invalid user id. You must be logged in to access this application.");
            }
        } else {
            return $_SESSION['userId'];
        }
    } else {
        if ($errorIfNotFound && $validateSession) {
            throw new Exception("You must be logged in to access this application.");
        }
    }
    return 0;
}
// *****************************************************************
// API Functions
// *****************************************************************
function login() {
    global $app;
    $User = new User();
    try {
        $validUserData = null;
        // Validate session
        $sessionUserId = getCurrentUserId($errorIfNotFound=false);
        if ($sessionUserId) {
            // Kill the current session and create a new one
            endSession();
        }
        $loginData = json_decode($app->request()->getBody());
        if ($loginData) {
            // Validate POST parameters
            if (!isset($loginData->email) || !$loginData->email) {
                throw new Exception("Expected parameter 'email' not found");
            }
            if (!isset($loginData->password) || !$loginData->password) {
                throw new Exception("Expected parameter 'password' not found");
            }
            $validUser = $User->validateLogin($loginData->email, $loginData->password);
            if (!$validUser) {
                throw new Exception("Invalid user name or password");
            }
            $_SESSION['userLoggedIn'] = true;
            $_SESSION['userName'] = ($validUser['first_name'].' '.$validUser['surname']);
            $_SESSION['userId'] = $validUser['user_id'];
            $validUserData = json_encode(array('result'=>1,'userId'=>$_SESSION['userId'],'userName'=>$_SESSION['userName'],'msg'=>'Logged in ok'));
        } else {
            throw new Exception('No POST data');
        }
    } catch(Exception $e) {
        //die("Error: {$e->getMessage()}");
        $validUserData = json_encode(array('result'=>0,'userId'=>0,'msg'=>$e->getMessage()));
    }
    echo $validUserData;
}
function logout() {
    try {
        $validUserData = null;
        // Validate session
        $sessionUserId = getCurrentUserId($errorIfNotFound=false);
        if ($sessionUserId) {
            endSession();
        } else {
            throw new Exception("User is not logged in");
        }
        $validUserData = json_encode(array('result'=>1,'userId'=>0,'msg'=>'User has been logged out'));
    } catch(Exception $e) {
        $validUserData = json_encode(array('result'=>0,'userId'=>0,'msg'=>$e->getMessage()));
    }
    echo $validUserData;
}
function endSession() {
    $_SESSION['userLoggedIn'] = false;
    $_SESSION['userName'] = null;
    $_SESSION['userId'] = null;
    session_destroy();
}
function getLoggedInSessionId() {
    echo $sessionUserId = getCurrentUserId($errorIfNotFound=false);
}

// *****************************************************************
function getUsers() {
    $User = new User();
    try {
        $userData = null;
        // Validate session
        $sessionUserId = getCurrentUserId();

        // Should only be one, but allow for multiple
        $users = $User->getUsers();
        if ($users) {
            $userData = json_encode($users);
        } else {
            // No data is not an error
            //throw new Exception("No users found");
        }
    } catch(Exception $e) {
        die("Error: {$e->getMessage()}");
    }
    echo $userData;
}
function addUser() {
    global $app;
    $User = new User();
    try {
        $userId = null;
        // Validate session
        $sessionUserId = getCurrentUserId();

        $user = json_decode($app->request()->getBody());
        if ($user) {
            // Validate POST parameters
            if (!isset($user->first_name) || !$user->first_name) {
                throw new Exception("Expected parameter 'first_name' not found");
            }
            if (!isset($user->surname) || !$user->surname) {
                throw new Exception("Expected parameter 'surname' not found");
            }
            // Add the User
            $userId = $User->insert(array('first_name'=>$user->first_name,'surname'=>$user->surname,'user_role_id'=>UserRole::USER_ROLE_USER,'account_status'=>User::USER_STATUS_ACTIVE));
        } else {
            throw new Exception('No POST data');
        }
    } catch(Exception $e) {
        die("Error: {$e->getMessage()}");
    }
    echo $userId;
}
function updateUser($userId) {
    global $app;
    $User = new User();
    try {
        $msg = null;
        // Validate session
        $sessionUserId = getCurrentUserId();

        $user = json_decode($app->request()->getBody());
        if ($user) {
            // Validate POST parameters
            if (!isset($userId) || !$userId) {
                throw new Exception("Expected parameter 'userId' not found");
            }
            if (!isset($user->first_name) || !$user->first_name) {
                throw new Exception("Expected parameter 'first_name' not found");
            }
            // Update the User
            $User->update(array('first_name'=>$user->first_name), array('user_id'=>$userId));
        } else {
            throw new Exception('No POST data');
        }
    } catch(Exception $e) {
        $msg = "Error: {$e->getMessage()}";
    }
    echo $msg;
}
function deleteUser($userId) {
    global $app;
    $User = new User();
    try {
        $msg = null;
        // Validate session
        $sessionUserId = getCurrentUserId();

        // Validate parameters
        if (!isset($userId) || !$userId) {
            throw new Exception("Expected parameter 'userId' not found");
        }
        // Update the User
        $User->delete(array('user_id'=>$userId));
    } catch(Exception $e) {
        $msg = "Error: {$e->getMessage()}";
    }
    echo $msg;
}
