<?php




session_start();

include_once 'include/config.php';
include_once 'include/connect.php';

$root	= dirname(__FILE__);
$url	= parse_url($_SERVER['REQUEST_URI']);
$arr	= explode('/', ltrim($url['path'], '/'));
$name	= array_shift($arr);

if ($name) {
	if ($name == 'login') {
		include_once $root . '/logic/' . $name . '.php';
	} else {
		if (!$_SESSION['isLogin']) {
			header('Location: /login');
		}
		if (file_exists($root . '/logic/' . $name . '.php')) {
			include_once $root . '/logic/' . $name . '.php';
		} else {
			die('aaa');
		}
	}
} else {
	if ($_SESSION['isLogin']) {
		include_once $root . '/logic/dashboard.php';
	} else {
		include_once $root . '/logic/login.php';
	}
}