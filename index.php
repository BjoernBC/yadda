<?php
define('rootPath', '');
$pages[] = 'frontpage';
$page = isset($_GET['page']) ? $_GET['page'] : $pages[0];
/*include_once('includes/pages/' . $page . ".php");*/
require_once('classes/controllers/controller.php');
$controller =  new Controller();
echo $controller->drawPage($page);
?>