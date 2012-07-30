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

// Check status device
$status = Device::getStatus($id);

// List menu
$smarty->assign('menus', Menu::getAll());

$smarty->assign('status', 0);
$smarty->assign('menu', 1);
$smarty->display('detail.tpl');