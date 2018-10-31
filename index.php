<?php
require_once('classes/dbh.php');
$dbCon =  $dbh = DbH::getDbH();
$pages[] = 'frontpage';
$page = isset($_GET['page']) ? $_GET['page'] : $pages[0];

include_once('includes/pages/' . $page . ".php");
echo 'Hello world from Alexander';
?>