<?php

require __DIR__.'/../config.php';
require __DIR__.'/Pimple.php';
require __DIR__.'/TimeSource.php';
require __DIR__.'/SiteRepository.php';
require __DIR__.'/Site.php';
require __DIR__.'/QuestionAnswerRepository.php';
require __DIR__.'/../vendor/autoload.php';


$app = new Pimple();

$app['timesource'] = function($c) { return new TimeSource(); };

$app['database'] = function ($c) {
	$DB = new PDO(DATABASE_TYPE.':host='.DATABASE_SERVER.';dbname='.DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);
	$DB->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$DB->exec("SET NAMES 'utf8'");
	return $DB;
};

$app['siterepository'] = function($c) {
	return new SiteRepository($c['database'],$c['timesource']);
};
$app['questionanswerrepository'] = function($c) {
	return new QuestionAnswerRepository($c['database'],$c['timesource']);
};

$app['twig'] = function($c) {
	$loader = new Twig_Loader_Filesystem(__DIR__.'/../templates/');
	$twig = new Twig_Environment($loader, array(
		'cache' => __DIR__.'/../cachedtemplates',
		'debug' => DEBUG_MODE,
	));	
	return $twig;
};



