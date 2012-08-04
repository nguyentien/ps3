<?php

include_once 'class/user.class.php';

$user = (string) $_POST['user'];
$pass = (string) $_POST['pass'];

if ($user) {
	if (User::login($user, $pass)) {
		$_SESSION['isLogin'] = 1;
		header('Location: /dashboard');
	}
} else {
	unset($_SESSION['isLogin']);
}

$smarty->display('login.tpl');