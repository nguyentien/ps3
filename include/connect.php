<?php

global $dbh;
$dsn		= 'mysql:dbname=ps3; host=localhost';
$user		= 'root';
$password	= '';

try {
	$dbh = new PDO($dsn, $user, $password);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Connection failed: ' . $e->getMessage();
}