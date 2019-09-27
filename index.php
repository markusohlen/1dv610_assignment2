<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('model/RegisterModel.php');
require_once('model/LoginModel.php');

require_once('model/StorageModel.php');

require_once('controller/RegisterController.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

//CREATE OBJECTS OF THE VIEWS
// $registerModel = new RegisterModel();
$loginModel = new LoginModel();
$storageModel = new StorageModel();

if ($storageModel->sessionIsSet() === false) {
    $storageModel->setLoggedInSession(false);
}

$v = new LoginView($loginModel, $storageModel);
$dtv = new DateTimeView();
$lv = new LayoutView();
$rv = new RegisterView();

// $registerController = new RegisterController($rv, $registerModel);
// $loginController = new LoginController($v, $loginModel);

// if (isset($_POST["DoRegistration"])) {
//     $registerController->register();
// }

// if (isset($_POST["LoginView::Login"])) {
//     // $loginController->login();

//     if ($v->userWantsToLogIn()) {
//         if (!$storageModel->isLoggedIn() && $loginModel->usernameExists($v->getRequestUserName()) && $loginModel->checkUsernameAndPassword($v->getRequestUserName(), $v->getRequestPassword())) {
//             $storageModel->setLoggedInSession(true);
//         }
//     }
// }

if (isset($_POST["LoginView::Login"])) {
    $storageModel->setLoggedInSession(true);
    $v->changeLoggedInFirstTime(true);
}

if (isset($_POST["LoginView::Logout"])) {
    $storageModel->setLoggedInSession(false);
    $v->changeLoggedInFirstTime(false);
}

$lv->render($v, $dtv, $rv, $storageModel);
