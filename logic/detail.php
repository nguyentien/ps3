<?php

include_once 'class/device.class.php';
include_once 'class/menu.class.php';

// Add new menu
if (isset($_GET['menu_add'])) {
	$id = (string) $_GET['menu_id'];
	$smarty->display('payment_extra.tpl');
	exit();
}

$id = (int) $_GET['id'];

// Get device by id
$device = Device::getDeviceById($id);

if (isset($_GET['payment'])) {
	if ($_GET['start']) {
		$start = 1;
	} elseif ($_GET['end']) {
		$status = 1;
	}

	$smarty->assign('id', $id);
	$smarty->assign('cost', $device['cost']); 
	$smarty->assign('status', $status);
	$smarty->assign('end', $end);

	$smarty->display('payment.tpl');
	exit();
}

// List menu
$menus = Menu::getAll();

$smarty->assign('id', $id);
$smarty->assign('menus', $menus);
$smarty->assign('cost', $device['cost']);
$smarty->assign('start', (int) $device['status']);
$smarty->assign('menu', 1);				// Main menu on right

$smarty->display('detail.tpl');