<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

$qdata = $app['siterepository']->getNextQuestionForTypeAnswer($site);

if ($qdata) {
	print json_encode(array(
		'picture'=>array(
			'id'=>$qdata['picture']->getId(),
			'source_url'=>$qdata['picture']->getSourceUrl(),
			'source_text'=>$qdata['picture']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'pictures/full/'.$qdata['picture']->getFilename(),
		)
	));
	
}



