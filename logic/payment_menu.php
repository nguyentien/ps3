<?php

include_once 'class/payment_menu.class.php';

$payment_id = (int) $_GET['payment_id'];

if (!empty($_GET['add'])) {
	$menus		= explode(',', $_GET['menus']);
	$numbers	= explode(',', $_GET['numbers']);
	for ($i=0; $i<count($menus); $i++) {
		$p = new Payment_Menu();
		$p->set_payment($payment_id);
		$p->set_menu($menus[$i]);
		$p->set_number($numbers[$i]);
		$p->set_date(strtotime('now'));
		Payment_Menu::save($p);
	}
}

if (!empty($_GET['delete'])) {
	$id = (int) $_GET['payment_menu_id'];
	Payment_Menu::delete($id);
}

// Assign list payment menu
$smarty->assign('list_payment_menu', Payment_Menu::getByPayment($payment_id));

$smarty->display('payment_menu.tpl');