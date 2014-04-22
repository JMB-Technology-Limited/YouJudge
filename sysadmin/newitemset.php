<?php

require __DIR__.'/../app/php/bootstrap.php';
require 'bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

if (isset($_POST['title'])) {
	
	$title = $_POST['title'];
	
	if ($title) {
		$id = $app['itemsetrepository']->create($title);
		header('Location: '.WEB_ROOT.'sysadmin/itemset.php?itemsetid='.$id);
		die();
	}
	
}



print $app['twig']->render('sysadmin/newitemset.html.twig',array());


