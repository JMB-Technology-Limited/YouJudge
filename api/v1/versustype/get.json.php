<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

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



