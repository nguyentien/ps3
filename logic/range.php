<?php

include_once 'class/range.class.php';

$ranges = Range::getAll();
$smarty->assign('ranges', $ranges);

$smarty->display('range.tpl');