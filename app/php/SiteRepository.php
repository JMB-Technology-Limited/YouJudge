<?php

class SiteRepository {
	

	/** @var PDO **/
	protected $db;
	
	/** @var TimeSource **/
	protected $timesource;
	
	function __construct(PDO $db, TimeSource $timesource) {
		$this->db = $db;
		$this->timesource = $timesource;
	}

	function createAnswerType($title,$question, $adminPassword) {
		$stat = $this->db->prepare("INSERT INTO site (title,question_type,question,admin_password,created_at) ".
				"VALUES(:title,:question_type,:question,:admin_password,:created_at)");
		$stat->execute(array(
				'title'=>$title,
				'question'=>$question,
				'admin_password'=>$adminPassword,
				'question_type'=>'answer',
				'created_at'=>$this->timesource->getFormattedForDataBase(),
			));
		return $this->db->lastInsertId();
	}

	function createVersusType($title,$question, $adminPassword) {
		$stat = $this->db->prepare("INSERT INTO site (title,question_type,question,admin_password,created_at) ".
				"VALUES(:title,:question_type,:question,:admin_password,:created_at)");
		$stat->execute(array(
				'title'=>$title,
				'question'=>$question,
				'admin_password'=>$adminPassword,
				'question_type'=>'versus',
				'created_at'=>$this->timesource->getFormattedForDataBase(),
			));
		return $this->db->lastInsertId();
	}
	
	function loadSiteById($siteid) {
		$stat = $this->db->prepare("SELECT * FROM site WHERE id=:id");
		$stat->execute(array(
				'id'=>$siteid,
			));
		if ($stat->rowCount() > 0) {
			return new Site($stat->fetch());
		}
	}
	
}


