<?php
session_start();
define('rootPath', '../');
require_once('../classes/controllers/controller.php');
$action = $_POST['action'];
$controller = new Controller();
$controller->$action($_POST);
//$controller->logout();
//header("location: " . $_SERVER['HTTP_REFERER']);
?>