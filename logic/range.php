<?php

include_once 'class/range.class.php';

// Insert
if (isset($_POST['insert'])) {
	$range = new Range();
	$range->set_name((string) $_POST['name']);
	Range::save($range);
	die('1');
}

// Update
if (isset($_POST['update'])) {
	$range = new Range();
	$range->set_id((int) $_POST['id']);
	$range->set_name((string) $_POST['name']);
	
	Range::save($range);
	die('1');
}

// Delete
if (isset($_POST['delete'])) {
	Range::delete((int) $_POST['id']);
	die('1');
}

$ranges = Range::getAll();
$smarty->assign('ranges', $ranges);

$smarty->display('range.tpl');