<?php

require __DIR__.'/../app/php/bootstrap.php';

$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}


$params = array('site'=>$site);

if ($site->getType() == 'answer') {
	
}


print $app['twig']->render('siteadmin/index.html.twig',$params);



