<?php


session_start();

if (isset($_POST['password']) && $_POST['password'] == SYSADMIN_PASSWORD) {
	$_SESSION['SYSADMINPASSWORD'] = SYSADMIN_PASSWORD;
}

if (!isset($_SESSION['SYSADMINPASSWORD']) || $_SESSION['SYSADMINPASSWORD'] != SYSADMIN_PASSWORD) {
	print $app['twig']->render('sysadmin/login.html.twig',array(
		));
	die();
}