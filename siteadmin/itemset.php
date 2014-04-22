<?php

require __DIR__.'/../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

$itemset = $app['itemsetrepository']->loadItemSetById($_GET['itemsetid']);

if (isset($_POST['add']) && $_POST['add'] == 'yes') {
	
	$app['itemsetrepository']->addItemSetToSite($itemset, $site);
	header("Location: index.php?siteid=".$site->getId());
	die();

}

$lastitems = $app['itemrepository']->getLastAddedForItemSet($itemset,20);

print $app['twig']->render('siteadmin/itemset.html.twig',array(
		'itemset'=>$itemset,
		'lastitems'=>$lastitems,
	));



