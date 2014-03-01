<?php


$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}
if ($site->getType() != 'answer'){
	die("404 wrong type");
}
if ($site->getApiPassword() != $_GET['siteapipassword']) {
	die('404 wrong password');
}

header("Access-Control-Allow-Origin: *");

