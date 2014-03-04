<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$indata = array_merge($_POST,$_GET);

$voteidx = $indata['idx'];
$order = isset($indata['order']) && $indata['order'] ? $indata['order'] : "DESC";
$limit = isset($indata['limit']) && $indata['limit'] ? $indata['limit'] : 30;
$threshhold = isset($indata['threshhold']) && $indata['threshhold'] ? $indata['threshhold'] : 1;

$questionanswer = $app['questionanswerrepository']->loadByIdxForSite($voteidx, $site);
if (!$questionanswer) {
	die("404 no question");
}

$items = $app['itemrepository']->getChartForTypeAnswer($questionanswer, $threshhold, $order, $limit);

$out = array();
foreach($items as $itemdata) {
	$out[] = array(
		'item'=>array(
			'id'=>$itemdata['item']->getId(),
			'source_url'=>$itemdata['item']->getSourceUrl(),
			'source_text'=>$itemdata['item']->getSourceText(),
			'url_full_size'=>$app['webenvironment']->getSiteRoot().'items/full/'.$itemdata['item']->getFilename(),
		),
		'votes_won'=>$itemdata['votes_won'],
		'votes_total'=>$itemdata['votes_total']
	);
}

print json_encode(array('items'=>$out));









