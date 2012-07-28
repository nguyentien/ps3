<?php

include_once 'class/device.class.php';
include_once 'class/range.class.php';

$devices = Device::getAll();
$smarty->assign('devices', $devices);

$ranges = Range::getAll();
$smarty->assign('ranges', $ranges);

$smarty->display('device.tpl');