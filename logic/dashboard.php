<?php

include_once 'include/connect.php';
include_once 'class/range.class.php';
include_once 'class/device.class.php';

$results	= Range::getAll();
$width		= 0;

// Assign value for range
if ($results) {
	$width = (960 - (count($results) * 20)) / count($results);
}
$smarty->assign('ranges', $results);
$smarty->assign('devices', Device::getAll());
$smarty->assign('width', $width);
$smarty->assign('menu', 1);

$smarty->display('dashboard.tpl');