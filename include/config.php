<?php

include 'libs/Smarty.class.php';

$smarty = new Smarty();

// Base url
$baseUrl = 'http://' . $_SERVER['HTTP_HOST'];
$smarty->assign('baseUrl', $baseUrl);