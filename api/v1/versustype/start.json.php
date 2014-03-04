<?php

require __DIR__.'/../../../app/php/bootstrap.php';
require './bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */


$data = array(
		'title'=>$site->getTitle(),
		'question'=>$site->getQuestion(),
	);

print json_encode($data);

