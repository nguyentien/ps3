<?php

include_once 'class/range.class.php';

$ranges = Range::getAll();

$smarty->assign('ranges', $ranges);
$smarty->assign('menu', 2);

$smarty->display('system.tpl');