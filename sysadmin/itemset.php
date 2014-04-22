<?php

require __DIR__.'/../app/php/bootstrap.php';
require 'bootstrap.php';
/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */


$itemset = $app['itemsetrepository']->loadItemSetById($_GET['itemsetid']);


$validImageExtensions = array('png','gif','jpg','jpeg');

if (isset($_FILES['picture']) && isset($_FILES['picture']['error']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
	$extensionBits = explode(".", $_FILES['picture']['name']);
	$extension = strtolower(array_pop( $extensionBits ));
	if (in_array($extension,$validImageExtensions)) {
		list($width, $height, $type, $attr)= getimagesize($_FILES['picture']['tmp_name']);
		if (in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000))) {
			$app['itemrepository']->createPictureFromWebUploadForItemSet(
					$itemset, 
					$_FILES['picture']['tmp_name'], 
					$_FILES['picture']['name'], 
					$_POST['sourceurl'], 
					$_POST['sourcetext']
				);
		}
	}
}


$lastitems = $app['itemrepository']->getLastAddedForItemSet($itemset,20);

print $app['twig']->render('sysadmin/itemset.html.twig',array(
		'itemset'=>$itemset,
		'lastitems'=>$lastitems,
	));

