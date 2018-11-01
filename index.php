<?php
require_once('classes/models/usermodel.php');
$user =  new userModel();
$user->setName('Christoffer Knudsen');
$user->setEmail('christoffer_knudsen@live.dk');
$user->setpwd('kode1234');
$user->setHandle('Chris');
$user->setStatus(1);
$user->setPermission(0);
$user->create();
$pages[] = 'frontpage';
$page = isset($_GET['page']) ? $_GET['page'] : $pages[0];

include_once('includes/pages/' . $page . ".php");
?>