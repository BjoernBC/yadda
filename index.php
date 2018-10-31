<?php
require_once('classes/dbh.php');
$dbCon =  $dbh = DbH::getDbH();
$pages[] = 'frontpage';
$page = isset($_GET['page']) ? $_GET['page'] : $pages[0];
echo "test";
include_once('includes/pages/' . $page . ".php");
?>