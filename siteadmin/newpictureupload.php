<?php
require __DIR__.'/../app/php/bootstrap.php';
require './bootstrap.php';

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */

$validImageExtensions = array('png','gif','jpg','jpeg');

if (isset($_FILES['picture']) && isset($_FILES['picture']['error']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
	$extensionBits = explode(".", $_FILES['picture']['name']);
	$extension = strtolower(array_pop( $extensionBits ));
	if (in_array($extension,$validImageExtensions)) {
		list($width, $height, $type, $attr)= getimagesize($_FILES['picture']['tmp_name']);
		if (in_array($type, array(IMAGETYPE_GIF, IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_JPEG2000))) {
			$app['picturerepository']->createFromWebUpload(
					$site, 
					$_FILES['picture']['tmp_name'], 
					$_FILES['picture']['name'], 
					$_POST['sourceurl'], 
					$_POST['sourcetext']
				);
		}
	}
}

header("Location: index.php?siteid=".$site->getId());



