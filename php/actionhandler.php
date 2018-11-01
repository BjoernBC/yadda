<?php
define('rootPath', '../');
require_once('../classes/controllers/controller.php');
$action = $_POST['action'];
$controller = new Controller();
$controller->$action();
//header("location: " . $_SERVER['HTTP_REFERER']);
?>