<?php

require __DIR__.'/../../app/php/bootstrap.php';


$siteRepo = $app['siterepository'];
var_dump($siteRepo->createAnswerType('title','question','password'));

