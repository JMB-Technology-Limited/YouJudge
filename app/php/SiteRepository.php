<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
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
	
	public function getNextQuestionForTypeAnswer(Site $site) {
		$stat = $this->db->prepare("SELECT * FROM picture ".
				"JOIN picture_in_site ON picture_in_site.picture_id = picture.id ".
				"WHERE picture.removed_at IS NULL AND picture_in_site.removed_at IS NULL ".
				"AND picture_in_site.site_id = :site_id ".
				"ORDER BY rand()");
		$stat->execute(array('site_id'=>$site->getId()));
		if ($stat->rowCount() > 0) {
			return array(
				'picture'=>new Picture($stat->fetch())
			);
		}
	}
	
	public function castVoteForTypeAnswer(Site $site, Picture $picture, 
			QuestionAnswer $questionanswer,$useragent, $ip) {
		
		$stat = $this->db->prepare("INSERT INTO vote_answer (picture_id,question_answer_id,ip,useragent,created_at) ".
				" VALUES (:picture_id,:question_answer_id,:ip,:useragent,:created_at)");
		$stat->execute(array(
			'picture_id'=>$picture->getId(),
			'question_answer_id'=>$questionanswer->getId(),
			'ip'=>$ip,
			'useragent'=>$useragent,
			'created_at'=>$this->timesource->getFormattedForDataBase(),
		));
		
	}
	
}


