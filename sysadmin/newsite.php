<?php

require __DIR__.'/../app/php/bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

if (isset($_POST['title'])) {
	
	$title = $_POST['title'];
	$type = $_POST['type'];
	$question = $_POST['question'];
	$adminpassword = $_POST['adminpassword'];
	
	if ($title && in_array($type, array('answer','versus')) && $question && $adminpassword) {
		$siteRepo = $app['siterepository'];
		if ($type == 'answer') {
			$id = $siteRepo->createAnswerType($title,$question,$adminpassword);
		} else if ($type == 'versus') {
			$id = $siteRepo->createVersusType($title,$question,$adminpassword);
		}
		header('Location: '.WEB_ROOT.'siteadmin/index.php?siteid='.$id);
		die();
	}
	
}



print $app['twig']->render('sysadmin/newsite.html.twig',array());


