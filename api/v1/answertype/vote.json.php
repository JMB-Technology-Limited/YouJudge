<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

$pictureid = $_POST['pictureid'];
$voteidx = $_POST['idx'];

$picture = $app['picturerepository']->getByIdInSite($pictureid, $site);
if (!$picture) {
	die("404 no picture");
}

$questionanswer = $app['questionanswerrepository']->loadByIdxForSite($voteidx, $site);
if (!$questionanswer) {
	die("404 no question");
}

$app['siterepository']->castVoteForTypeAnswer($site, $picture, 
		$questionanswer, $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);


$stats = $app['siterepository']->getAndCacheVoteStatsForPictureForTypeAnswer($site, $picture, true);

print json_encode(array('stats'=>$stats));
