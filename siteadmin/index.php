<?php

require __DIR__.'/../app/php/bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}


$params = array(
		'site'=>$site,
		'lastpictures' => $app['picturerepository']->getLastAddedForSite($site,5),
	);

if ($site->getType() == 'answer') {
	$params['answers']= $app['questionanswerrepository']->loadForSite($site);
}


print $app['twig']->render('siteadmin/index.html.twig',$params);



