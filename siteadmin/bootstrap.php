<?php

$siteid = isset($_GET['siteid']) && $_GET['siteid'] ? $_GET['siteid'] : (isset($_POST['siteid']) && $_POST['siteid'] ? $_POST['siteid']:null);
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	print $app['twig']->render('siteadmin/login.html.twig',array(
		));
	die();
}



session_start();

if (isset($_POST['password']) && $_POST['password'] == $site->getAdminPassword()) {
	$_SESSION['SITE'.$site->getId().'PASSWORD'] = $site->getAdminPassword();
}

if (!isset($_SESSION['SITE'.$site->getId().'PASSWORD']) || $_SESSION['SITE'.$site->getId().'PASSWORD'] != $site->getAdminPassword()) {
	print $app['twig']->render('siteadmin/login.html.twig',array(
		));
	die();
}