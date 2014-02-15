<?php

require __DIR__.'/../../../app/php/bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}
if ($site->getType() != 'versus'){
	die("404 wrong type");
}


header("Access-Control-Allow-Origin: *");

$qdata = $app['siterepository']->getNextQuestionForTypeVersus($site);

if ($qdata) {
	print json_encode(array(
		'picture1'=>array(
			'id'=>$qdata['picture1']->getId(),
			'source_url'=>$qdata['picture1']->getSourceUrl(),
			'source_text'=>$qdata['picture1']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'pictures/full/'.$qdata['picture1']->getFilename(),
		),
		'picture2'=>array(
			'id'=>$qdata['picture2']->getId(),
			'source_url'=>$qdata['picture2']->getSourceUrl(),
			'source_text'=>$qdata['picture2']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'pictures/full/'.$qdata['picture2']->getFilename(),
		)
	));
	
}



