<?php

include_once 'class/menu.class.php';

// Insert
if (isset($_POST['insert'])) {
	$menu = new Menu();
	$menu->set_name((string) $_POST['name']);
	$menu->set_unit((string) $_POST['unit']);
	$menu->set_cost((float) $_POST['cost']);
	if (Menu::save($menu)) {
		die('1');
	}
	exit;
}

// Update
if (isset($_POST['update'])) {
	$menu = new Menu();
	$menu->set_id((int) $_POST['id']);
	$menu->set_name((string) $_POST['name']);
	$menu->set_unit((string) $_POST['unit']);
	$menu->set_cost((float) $_POST['cost']);
	
	if (Menu::save($menu)) {
		die('1');
	}
	exit();
}

// Delete
if (isset($_POST['delete'])) {
	if (Menu::delete((int) $_POST['id'])) {
		die('1');
	}
	exit();
}

$menus = Menu::getAll();
$smarty->assign('menus', $menus);

$smarty->display('menu.tpl');