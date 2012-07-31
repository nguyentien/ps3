<?php

include_once 'class/system.class.php';

// Save
if (isset($_POST['save'])) {
	$default_cost = (float) str_replace(',', '', $_POST['cost']);
	$default_unit = (float) str_replace(',', '', $_POST['unit']);
	
	$data = array(
		'default_cost' => $default_cost,
		'default_unit' => $default_unit
	);
	System::save($data);
	die('1');
}

$defaults = System::getValue();

foreach ($defaults as $d) {
	switch($d->get_var()) {
		case 'default_cost':
			$smarty->assign('default_cost', $d->get_val());
			break;
		case 'default_unit':
			$smarty->assign('default_unit', $d->get_val());
			break;	
	}
}

$smarty->display('difference.tpl');