<?php
define('rootPath', '../');
require_once('../classes/models/userModel.php');
$user = new UserModel();
$user->setId(4);
$user->retrieve();
$user->update();
require_once('../classes/controllers/controller.php');
$action = $_POST['action'];
$controller = new Controller();
$controller->$action($_POST);
//$controller->logout();
//header("location: " . $_SERVER['HTTP_REFERER']);
?>