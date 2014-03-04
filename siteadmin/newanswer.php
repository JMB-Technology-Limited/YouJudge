<?php
require __DIR__.'/../app/php/bootstrap.php';
require './bootstrap.php';

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */

if ($site->getType() == 'answer' && isset($_POST['answer']) && trim($_POST['answer'])) {
	$app['questionanswerrepository']->newQuestionAnswer($site, trim($_POST['answer']));
}

header("Location: index.php?siteid=".$site->getId());

