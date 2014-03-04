<?php

require __DIR__.'/../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$params = array(
		'site'=>$site,
		'lastitems' => $app['itemrepository']->getLastAddedForSite($site,5),
	);

if ($site->getType() == 'answer') {
	$params['answers']= $app['questionanswerrepository']->loadForSite($site);
}


print $app['twig']->render('siteadmin/index.html.twig',$params);



