<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$itemid = $_POST['itemid'];
$voteidx = $_POST['idx'];

$item = $app['itemrepository']->getByIdInSite($itemid, $site);
if (!$item) {
	die("404 no item");
}

$questionanswer = $app['questionanswerrepository']->loadByIdxForSite($voteidx, $site);
if (!$questionanswer) {
	die("404 no question");
}

$app['siterepository']->castVoteForTypeAnswer($site, $item, 
		$questionanswer, $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);


$stats = $app['siterepository']->getAndCacheVoteStatsForItemForTypeAnswer($site, $item, true);

print json_encode(array('stats'=>$stats));
