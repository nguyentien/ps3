<?php

include_once 'class/device.class.php';

$smarty->assign('device', Device::getAll());

$smarty->display('report.tpl');