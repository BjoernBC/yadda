<?php
$pages[] = 'frontpage';
$page = isset($_GET['page']) ? $_GET['page'] : $pages[0];

include_once('includes/pages/' . $page . ".php");
?>