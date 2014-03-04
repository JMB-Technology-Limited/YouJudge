<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$qdata = $app['siterepository']->getNextQuestionForTypeAnswer($site);

if ($qdata) {
	print json_encode(array(
		'item'=>array(
			'id'=>$qdata['item']->getId(),
			'source_url'=>$qdata['item']->getSourceUrl(),
			'source_text'=>$qdata['item']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'items/full/'.$qdata['item']->getFilename(),
		)
	));
	
}



