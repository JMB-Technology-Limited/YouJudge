<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */


$data = array(
		'title'=>$site->getTitle(),
		'question'=>$site->getQuestion(),
		'answers'=>array(),
	);

foreach($app['questionanswerrepository']->loadForSite($site) as $answer) {
	$data['answers'][] = array(
			'idx'=>$answer->getAnswerIndex(),
			'answer'=>$answer->getAnswer(),
		);
}


print json_encode($data);

