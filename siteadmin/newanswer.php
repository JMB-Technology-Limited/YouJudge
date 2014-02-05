<?php
require __DIR__.'/../app/php/bootstrap.php';

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
$siteid = $_GET['siteid'];
$site = $app['siterepository']->loadSiteById($siteid);
if (!$site) {
	die("404");
}


if ($site->getType() == 'answer' && isset($_POST['answer']) && trim($_POST['answer'])) {
	$app['questionanswerrepository']->newQuestionAnswer($site, trim($_POST['answer']));
}

header("Location: index.php?siteid=".$site->getId());

