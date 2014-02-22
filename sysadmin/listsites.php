<?php

require __DIR__.'/../app/php/bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */


$sites = $app['siterepository']->loadSites();

print $app['twig']->render('sysadmin/listsites.html.twig',array(
		'sites'=>$sites,
	));


