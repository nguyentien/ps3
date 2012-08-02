<?php

include_once 'class/payment_extra.class.php';

//$payment = (int) $_GET['payment'];
$payment = 1;

if (!empty($_GET['add'])) {
	$extra = explode(',', $_GET['extra']);
	$number = explode(',', $_GET['number']);
	for ($i=0; $i<count($extra); $i++) {
		$p = new Payment_Extra();
		$p->set_payment($payment);
		$p->set_extra($extra[$i]);
		$p->set_number($number[$i]);
		$p->set_date(strtotime('now'));
		Payment_Extra::save($p);
	}	
}

if (!empty($_GET['delete'])) {
	$id = (int) $_GET['id'];
	Payment_Extra::delete($id);
}

// Get list extra
$payment_extra = Payment_Extra::getById($payment);
	
$smarty->assign('payment_extra', $payment_extra);

$smarty->display('payment_extra.tpl');