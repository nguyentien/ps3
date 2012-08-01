<?php

include_once 'class/device.class.php';
include_once 'class/payment.class.php';

$device_id		= (int) $_GET['device_id'];
$payment_id		= (int) $_GET['payment_id'];
$start			= 0;
$stop			= 0;
$total			= 0;
$total1			= 0;

// Get device by id for get cost only
$device = Device::getById($device_id);

if (!empty($_GET['start'])) {
	// Change status device
	$device->set_status(1);
	Device::save($device);
	
	// New payment
	$p = new Payment();
	$p->set_device($device_id);
	$p->set_start(strtotime('now'));
	$p->set_stop(0);
	$p->set_surcharge(0);
	$p->set_discount(0);
	$p->set_comment('');
	$p->set_status(1);
	$p->set_date(strtotime('now'));
	$payment_id = Payment::save($p);
	
	$start = 1;
	$stop = 0;
}

if (!empty($_GET['end'])) {
	$payment = Payment::getById($payment_id);
	$payment->set_id($payment_id);
	$payment->set_stop(strtotime('now'));
	Payment::save($payment);
	
	$start	= 1;
	$stop	= 1;
}

if (!empty($_GET['cash'])) {
	$surcharge	= (float) str_replace(',', '', $_GET['surcharge']);
	$discount	= (float) str_replace(',', '', $_GET['discount']);
	$comment	= (string) $_GET['comment'];
	
	$p = Payment::getById($payment_id);
	$p->set_surcharge($surcharge);
	$p->set_discount($discount);
	$p->set_comment($comment);
	Payment::save($p);
	
	$start	= 1;
	$stop	= 1;
	$temp	= Payment::getTotal($payment_id);
	$total	= $temp[0];
	$total1	= $temp[1];
}

if (!empty($_GET['pay'])) {
	$start	= 0;
	$stop	= 0;
	
	// Update status for payment
	$p = Payment::getById($payment_id);
	$p->set_status(0);
	Payment::save($p);
	
	// Update status for device
	$d = Device::getById($device_id);
	$d->set_status(0);
	Device::save($d);
	
	// Update $payment_id
	$payment_id = 0;
}

$smarty->assign('start', $start);
$smarty->assign('stop', $stop);
$smarty->assign('total', $total);
$smarty->assign('total1', $total1);
$smarty->assign('payment', Payment::getById($payment_id));
$smarty->assign('device', $device);

$smarty->display('payment.tpl');