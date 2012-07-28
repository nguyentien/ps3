<?php

include_once 'include/connect.php';

$smarty->assign('menu', 1);
$smarty->display('dashboard.tpl');