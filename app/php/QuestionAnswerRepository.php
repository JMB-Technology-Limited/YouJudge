<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
class QuestionAnswerRepository {
	
	/** @var PDO **/
	protected $db;
	
	/** @var TimeSource **/
	protected $timesource;
	
	function __construct(PDO $db, TimeSource $timesource) {
		$this->db = $db;
		$this->timesource = $timesource;
	}
	
	public function newQuestionAnswer(Site $site, $answer) {
		$newIDX = 0;
		$stat = $this->db->prepare("SELECT answer_index FROM question_answer WHERE site_id=:id");
		$stat->execute(array('id'=>$site->getId()));
		while($data = $stat->fetch()) {
			if ($data['answer_index']+1>$newIDX) {
				$newIDX = $data['answer_index']+1;
			}
		}
		$stat = $this->db->prepare("INSERT INTO question_answer (site_id,answer_index,answer,created_at) ".
				"VALUES (:site_id,:answer_index,:answer,:created_at)");
		$stat->execute(array(
			'site_id'=>$site->getId(),
			'answer_index'=>$newIDX,
			'answer'=>$answer,
			'created_at'=>$this->timesource->getFormattedForDataBase(),
		));
	}
	
	public function loadForSite(Site $site) {
		$stat = $this->db->prepare("SELECT * FROM question_answer WHERE site_id=:id ORDER BY answer_index ASC");
		$stat->execute(array('id'=>$site->getId()));
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = new QuestionAnswer($data);
		}
		return $out;
	}
	
}

