<?php
//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('view/RegisterView.php');

require_once('model/RegisterModel.php');
require_once('model/UserModel.php');

require_once('model/StorageModel.php');

require_once('controller/RegisterController.php');
require_once('controller/LoginController.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');
session_start();

//CREATE OBJECTS OF THE VIEWS
$userModel = new UserModel();
$storageModel = new StorageModel();
$registerModel = new RegisterModel($userModel);

if ($storageModel->sessionIsSet() === false) {
    $storageModel->setLoggedInSession(false);
}

$v = new LoginView($userModel, $storageModel);
$dtv = new DateTimeView();
$lv = new LayoutView();
$rv = new RegisterView();

$rc = new RegisterController($rv, $registerModel);

if (isset($_POST["RegisterView::Register=Register"])) {
    $rc->register();
}

if ($storageModel->isCookieSet() || isset($_POST["LoginView::Login"]) && $v->userFilledInUsername() && $v->userFilledInPassword() && $userModel->checkUsernameAndPassword($v->getRequestUserName(), $v->getRequestPassword())) {
    $storageModel->setLoggedInSession(true);
    if ($v->getKeepLoggedIn()) {
        $storageModel->setKeepLoggedIn();
    }
    $v->changeLoggedInFirstTime(true);
}

if (isset($_POST["LoginView::Logout"])) {
    $storageModel->setLoggedInSession(false);
    $storageModel->changeCookie();
    $v->changeLoggedInFirstTime(false);
}

$renderView = (isset($_GET["register"]) ? $rv : $v);

// var_dump($renderView);

$lv->render($renderView, $v, $dtv, $rv, $storageModel);
