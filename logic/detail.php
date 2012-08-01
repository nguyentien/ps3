<?php

include_once 'class/device.class.php';
include_once 'class/menu.class.php';
include_once 'class/payment.class.php';
include_once 'class/payment_menu.class.php';

$device_id	= (int) $_GET['id'];
$start		= 0;
$stop		= 0;

// Get device by id for get cost only
$device = Device::getById($device_id);

// Get payment of device
$payment = Payment::getByDevice($device_id);

if ($payment) {
	if ($payment->get_start()) {
		$start = 1;
	}
	
	if ($payment->get_stop()) {
		$stop = 1;
	}
	
	// Assign list menu in payment
	$smarty->assign('list_payment_menu', Payment_Menu::getByPayment($payment->get_id()));
	
	// Assign payment
	$smarty->assign('payment', $payment);
}

// List menu
$list_menu = Menu::getAll();

// List device for switch device
$list_device = Device::getAll();

$smarty->assign('start', $start);
$smarty->assign('stop', $stop);
$smarty->assign('device', $device);
$smarty->assign('list_device', $list_device);
$smarty->assign('list_menu', $list_menu);
$smarty->assign('menu', 1);

$smarty->display('detail.tpl');