<?php

include_once 'class/device.class.php';
include_once 'class/menu.class.php';
include_once 'class/payment_extra.class.php';

$id = (int) $_GET['id'];
$payment = 1;

// Get device by id
$device = Device::getDeviceById($id);

// Assign status
$start = $device['status'] ? 1 : 0;
$end   = $device['status'] ? 0 : 1;

// Get list extra
$payment_extra = Payment_Extra::getById($payment);

// List menu
$menus = Menu::getAll();

$smarty->assign('id', $id);
$smarty->assign('menus', $menus);
$smarty->assign('cost', $device['cost']);
$smarty->assign('start', $start);
$smarty->assign('end', $end);
$smarty->assign('payment_extra', $payment_extra);
$smarty->assign('menu', 1);

$smarty->display('detail.tpl');