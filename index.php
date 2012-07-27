<?php

include_once 'include/config.php';

$root	= dirname(__FILE__);
$url	= parse_url($_SERVER['REQUEST_URI']);
$arr	= explode('/', ltrim($url['path'], '/'));
$name	= array_shift($arr);

if ($name) {
	if (file_exists($root . '/logic/' . $name . '.php')) {
		include_once $root . '/logic/' . $name . '.php';
	} else {
		die('aaa');
	}
} else {
	include_once $root . '/logic/dashboard.php';
}