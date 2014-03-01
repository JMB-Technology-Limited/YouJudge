<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

$winningpictureid = $_POST['winningpictureid'];
$losingpictureid = $_POST['losingpictureid'];

$winningpicture = $app['picturerepository']->getByIdInSite($winningpictureid, $site);
if (!$winningpicture) {
	die("404 no picture");
}

$losingpicture = $app['picturerepository']->getByIdInSite($losingpictureid, $site);
if (!$losingpicture) {
	die("404 no picture");
}


$app['siterepository']->castVoteForTypeVersus($site, $winningpicture, $losingpicture,
		$_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);


$winningstats = $app['siterepository']->getAndCacheVoteStatsForPictureForTypeVersus($site, $winningpicture, true);
$losingstats = $app['siterepository']->getAndCacheVoteStatsForPictureForTypeVersus($site, $losingpicture, true);

print json_encode(array('stats'=>array('winning_picture'=>$winningstats,'losing_picture'=>$losingstats)));

