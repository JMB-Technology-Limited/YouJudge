<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$winningitemid = $_POST['winningitemid'];
$losingitemid = $_POST['losingitemid'];

$winningitem = $app['itemrepository']->getByIdInSite($winningitemid, $site);
if (!$winningitem) {
	die("404 no item");
}

$losingitem = $app['itemrepository']->getByIdInSite($losingitemid, $site);
if (!$losingitem) {
	die("404 no item");
}


$app['siterepository']->castVoteForTypeVersus($site, $winningitem, $losingitem,
		$_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']);


$winningstats = $app['siterepository']->getAndCacheVoteStatsForItemForTypeVersus($site, $winningitem, true);
$losingstats = $app['siterepository']->getAndCacheVoteStatsForItemForTypeVersus($site, $losingitem, true);

print json_encode(array('stats'=>array('winning_item'=>$winningstats,'losing_item'=>$losingstats)));

