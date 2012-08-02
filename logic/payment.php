<?php

include_once 'class/device.class.php';
include_once 'class/payment.class.php';

$device_id = (int) $_GET['device'];
$payment_id = 1;

// Get device by id
$device = Device::getDeviceById($device_id);

if (!empty($_GET['start'])) {
	$start = 1;
	$end = 0;
	
	// New payment
	$p = new Payment();
	$p->set_device($device_id);
	$p->set_start(strtotime('now'));
	$p->set_stop(0);
	$p->set_surcharge(0);
	$p->set_discount(0);
	$p->set_comment('');
	$p->set_status(0);
	$p->set_date(strtotime('now'));
	$payment_id = Payment::save($p);
	$smarty->assign('payment', Payment::getById($payment_id));
}

if (!empty($_GET['end'])) {
	$start = 1;
	$end = 1;
}

$smarty->assign('id', $device_id);
$smarty->assign('cost', $device['cost']);
$smarty->assign('start', $start);
$smarty->assign('end', $end);

$smarty->display('payment.tpl');