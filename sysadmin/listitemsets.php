<?php

require __DIR__.'/../app/php/bootstrap.php';
require 'bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */


$itemsets = $app['itemsetrepository']->loadItemSets();

print $app['twig']->render('sysadmin/listitemsets.html.twig',array(
		'itemsets'=>$itemsets,
	));


