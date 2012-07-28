<?php

include_once 'class/menu.class.php';

$menus = Menu::getAll();
$smarty->assign('menus', $menus);

$smarty->display('menu.tpl');