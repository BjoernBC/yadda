<?php
$action = $_POST['action'];
$action();
function userLogin(){
	echo "yoyoyo";
}
function userCreate(){
	echo "gawd dammit!";
}
//header("location: " . $_SERVER['HTTP_REFERER']);
?>