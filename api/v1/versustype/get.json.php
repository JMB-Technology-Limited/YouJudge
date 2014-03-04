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
		'item1'=>array(
			'id'=>$qdata['item1']->getId(),
			'source_url'=>$qdata['item1']->getSourceUrl(),
			'source_text'=>$qdata['item1']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'items/full/'.$qdata['item1']->getFilename(),
		),
		'item2'=>array(
			'id'=>$qdata['item2']->getId(),
			'source_url'=>$qdata['item2']->getSourceUrl(),
			'source_text'=>$qdata['item2']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'items/full/'.$qdata['item2']->getFilename(),
		)
	));
	
}



