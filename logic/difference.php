<?php

include_once 'class/system.class.php';

if ($_POST['save']) {
	$default_cost = (float) str_replace(',', '', $_POST['default']);
	
	$data = array('default_cost' => $default_cost);
	System::save($data);
	die('1');
}

$defaults = System::getValue();

foreach ($defaults as $d) {
	switch($d->get_var()) {
		case 'default_cost':
			$smarty->assign('default_cost', $d->get_val());
			break;
	}
}

$smarty->display('difference.tpl');