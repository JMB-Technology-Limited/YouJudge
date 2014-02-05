<?php

require __DIR__.'/../app/php/bootstrap.php';

$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}



print $app['twig']->render('siteadmin/index.html.twig',array('site'=>$site));



