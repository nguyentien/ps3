<?php

include_once 'class/device.class.php';

$id = (int) $_GET['id'];

// Check status device
$status = Device::getStatus($id);

$smarty->assign('status', 0);
$smarty->assign('menu', 1);
$smarty->display('detail.tpl');