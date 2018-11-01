<?php

require_once('classes/models/usermodel.php');
$user =  new userModel();
$user->setEmail('christoffer_knudsen@live.dk');
/*$user->setName('Christoffer Knudsen');
$user->setpwd('kode1234');
$user->setHandle('Chris');
$user->setStatus(1);
$user->setPermission(0);*/
//$user->create();
$user->retrieve();
print_r($user);
?>