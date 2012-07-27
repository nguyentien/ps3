<?php

include 'libs/Smarty.class.php';

// Base url
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'];

$smarty = new Smarty();
$smarty->assign('baseUrl', $baseUrl);