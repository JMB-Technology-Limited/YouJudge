<?php

require __DIR__.'/../app/php/bootstrap.php';
require 'bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */


$sites = $app['siterepository']->loadSites();

print $app['twig']->render('sysadmin/listsites.html.twig',array(
		'sites'=>$sites,
	));


