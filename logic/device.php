<?php

include_once 'class/device.class.php';
include_once 'class/range.class.php';
include_once 'class/system.class.php';

// Insert
if (isset($_POST['insert'])) {
	$device = new Device();
	$device->set_uid((string) $_POST['uid']);
	$device->set_name((string) $_POST['name']);
	
	// Get default cost for device
	if ($_POST['default']) {
		foreach (System::getValue() as $r) {
			if ($r->get_var() == 'default_cost') {
				$device->set_cost($r->get_val());
			}
		}
	} else {
		$device->set_cost((float) $_POST['cost']);
	}
	$device->set_range((int) $_POST['range']);
	if (Device::save($device)) {
		die('1');
	}
	exit;
}

// Update
if (isset($_POST['update'])) {
	$device = new Device();
	$device->set_id((int) $_POST['id']);
	$device->set_uid((string) $_POST['uid']);
	$device->set_name((string) $_POST['name']);
	$device->set_cost((float) $_POST['cost']);
	$device->set_range((int) $_POST['range']);
	
	if (Device::save($device)) {
		die('1');
	}
	exit();
}

// Delete
if (isset($_POST['delete'])) {
	if (Device::delete((int) $_POST['id'])) {
		die('1');
	}
	exit();
}

$devices = Device::getAll();
$smarty->assign('devices', $devices);

$ranges = Range::getAll();
$smarty->assign('ranges', $ranges);

$smarty->display('device.tpl');