<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
class PictureRepository {

	
	/** @var PDO **/
	protected $db;
	
	/** @var TimeSource **/
	protected $timesource;
	
	function __construct(PDO $db, TimeSource $timesource) {
		$this->db = $db;
		$this->timesource = $timesource;
	}
	
	public function createFromWebUpload(Site $site, $localFileName, $remoteFileName, $sourceURL, $sourceText) {
		
		$newfilename = basename($remoteFileName);
		
		while(file_exists(__DIR__.'/../../pictures/full/'.$newfilename)) {
			$newfilename = mt_rand(1, 9999999).basename($remoteFileName);
		}
		
		$stat = $this->db->prepare("INSERT INTO picture (source_url, source_text, filename, created_at) ".
				"VALUES (:source_url, :source_text, :filename, :created_at)");
		$stat->execute(array(
				'source_url'=>$sourceURL,
				'source_text'=>$sourceText,
				'filename'=>$newfilename,
				'created_at'=>$this->timesource->getFormattedForDataBase()
			));
		$id = $this->db->lastInsertId();
		
		move_uploaded_file($localFileName, __DIR__.'/../../pictures/full/'.$newfilename);
		
		$stat = $this->db->prepare("INSERT INTO picture_in_site (site_id,picture_id,created_at) ".
				"VALUES (:site_id,:picture_id,:created_at)");
		$stat->execute(array(
				'site_id'=>$site->getId(),
				'picture_id'=>$id,
				'created_at'=>$this->timesource->getFormattedForDataBase()
			));
	}
	
	
}

