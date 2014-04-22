<?php

require __DIR__.'/../app/php/bootstrap.php';
require 'bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */


$itemset = $app['itemsetrepository']->loadItemSetById($_GET['itemsetid']);

print $app['twig']->render('sysadmin/itemset.html.twig',array(
		'itemset'=>$itemset,
	));

