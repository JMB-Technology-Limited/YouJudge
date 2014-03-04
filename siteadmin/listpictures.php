<?php

require __DIR__.'/../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$params = array(
		'site'=>$site,
		'lastpictures' => $app['picturerepository']->getLastAddedForSite($site,5000),
	);


print $app['twig']->render('siteadmin/listpictures.html.twig',$params);


