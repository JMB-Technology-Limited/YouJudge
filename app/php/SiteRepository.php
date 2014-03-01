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
		$stat = $this->db->prepare("INSERT INTO site (title,question_type,question,admin_password,api_password,created_at) ".
				"VALUES(:title,:question_type,:question,:admin_password,:api_password,:created_at)");
		$stat->execute(array(
				'title'=>$title,
				'question'=>$question,
				'admin_password'=>$adminPassword,
				'question_type'=>'answer',
				'created_at'=>$this->timesource->getFormattedForDataBase(),
				'api_password'=>$this->createKey(10, 100),
			));
		return $this->db->lastInsertId();
	}

	function createVersusType($title,$question, $adminPassword) {
		$stat = $this->db->prepare("INSERT INTO site (title,question_type,question,admin_password,api_password,created_at) ".
				"VALUES(:title,:question_type,:question,:admin_password,:api_password,:created_at)");
		$stat->execute(array(
				'title'=>$title,
				'question'=>$question,
				'admin_password'=>$adminPassword,
				'question_type'=>'versus',
				'created_at'=>$this->timesource->getFormattedForDataBase(),
				'api_password'=>$this->createKey(10, 100),
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
	
	public function getNextQuestionForTypeVersus(Site $site) {
		$stat = $this->db->prepare("SELECT * FROM picture ".
				"JOIN picture_in_site ON picture_in_site.picture_id = picture.id ".
				"WHERE picture.removed_at IS NULL AND picture_in_site.removed_at IS NULL ".
				"AND picture_in_site.site_id = :site_id ".
				"ORDER BY rand()");
		$stat->execute(array('site_id'=>$site->getId()));
		if ($stat->rowCount() >= 2) {
			return array(
				'picture1'=>new Picture($stat->fetch()),
				'picture2'=>new Picture($stat->fetch()),
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
			'useragent'=>substr($useragent,0,250),
			'created_at'=>$this->timesource->getFormattedForDataBase(),
		));
		
	}
	
	public function getAndCacheVoteStatsForPictureForTypeAnswer(Site $site, Picture $picture) {
		$stat = $this->db->prepare("SELECT question_answer.*, COUNT(vote_answer.picture_id) AS c  ".
				"FROM question_answer ".
				"LEFT JOIN vote_answer ON vote_answer.question_answer_id = question_answer.id AND vote_answer.picture_id = :picture_id ".
				"WHERE question_answer.site_id=:site_id  ".
				"GROUP BY question_answer.id");
		$stat->execute(array(
			'site_id'=>$site->getId(),
			'picture_id'=>$picture->getId()
		));
		$out = array();
		$totalvotes = 0;
		$votes = array();
		while($data = $stat->fetch()) {
			$out[] = array(
				'answer_idx'=>$data['answer_index'],
				'answer'=>$data['answer'],
				'votes'=>$data['c']
			);
			$totalvotes += $data['c'];
			$votes[$data['id']] = $data['c'];
		}
		$statCache = $this->db->prepare("INSERT INTO picture_answer_cache ".
				"(picture_id,question_answer_id,votes_won,votes_total,votes_won_percentage) ".
				"VALUES (:picture_id,:question_answer_id,:votes_won,:votes_total,:votes_won_percentage) ".
				"on duplicate key update votes_won=values(votes_won), ".
				"votes_total=values(votes_total), votes_won_percentage=values(votes_won_percentage)");
		foreach($votes as $id=>$votes) {
			$statCache->execute(array(
				'picture_id'=>$picture->getId(),
				'question_answer_id'=>$id,
				'votes_won'=>$votes,
				'votes_total'=>$totalvotes,
				'votes_won_percentage'=>($totalvotes > 0 ? 100 * $votes / $totalvotes : 0.0),
			));
		}
		
		return $out;		
	}

	public function castVoteForTypeVersus(Site $site, Picture $winningPicture, Picture $losingPicture, $useragent, $ip) {
		
		$stat = $this->db->prepare("INSERT INTO vote_versus (site_id,winning_picture_id,losing_picture_id,ip,useragent,created_at) ".
				" VALUES (:site_id,:winning_picture_id,:losing_picture_id,:ip,:useragent,:created_at)");
		$stat->execute(array(
			'site_id'=>$site->getId(),
			'winning_picture_id'=>$winningPicture->getId(),
			'losing_picture_id'=>$losingPicture->getId(),
			'ip'=>$ip,
			'useragent'=>substr($useragent,0,250),
			'created_at'=>$this->timesource->getFormattedForDataBase(),
		));
		
	}
	
	public function getAndCacheVoteStatsForPictureForTypeVersus(Site $site, Picture $picture) {
		
		$statWinning = $this->db->prepare("SELECT COUNT(winning_picture_id) AS c  ".
				"FROM vote_versus ".
				"WHERE site_id=:site_id  AND winning_picture_id=:picture_id ".
				"GROUP BY vote_versus.winning_picture_id");
		$statWinning->execute(array(
			'site_id'=>$site->getId(),
			'picture_id'=>$picture->getId()
		));
		$data = $statWinning->fetch();
		$winningVotes = $data ? $data['c'] : 0;
		
		
		$statLosing = $this->db->prepare("SELECT COUNT(losing_picture_id) AS c  ".
				"FROM vote_versus ".
				"WHERE site_id=:site_id  AND losing_picture_id=:picture_id ".
				"GROUP BY vote_versus.losing_picture_id");
		$statLosing->execute(array(
			'site_id'=>$site->getId(),
			'picture_id'=>$picture->getId()
		));
		$data = $statLosing->fetch();
		$losingVotes = $data ? $data['c'] : 0;
		
		$statCache = $this->db->prepare("INSERT INTO picture_versus_cache ".
				"(picture_id,site_id,votes_won,votes_total,votes_won_percentage) ".
				"VALUES (:picture_id,:site_id,:votes_won,:votes_total,:votes_won_percentage) ".
				"on duplicate key update votes_won=values(votes_won), ".
				"votes_total=values(votes_total), votes_won_percentage=values(votes_won_percentage)");
		$statCache->execute(array(
			'picture_id'=>$picture->getId(),
			'site_id'=>$site->getId(),
			'votes_won'=>$winningVotes,
			'votes_total'=>$winningVotes+$losingVotes,
			'votes_won_percentage'=>( $winningVotes+$losingVotes > 0 ? 100*$winningVotes / ($winningVotes+$losingVotes) : 0.0 ),
		));
		
		
		return array(
			'votes_won'=>$winningVotes,
			'votes_lost'=>$losingVotes,
		);
	}
	
	function loadSites() {
		$stat = $this->db->prepare("SELECT * FROM site");
		$stat->execute();
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = new Site($data);
		}
		return $out;
	}
	
	function createKey($minLength = 10, $maxLength = 100) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$string ='';
		$length = mt_rand($minLength, $maxLength);
		for ($p = 0; $p < $length; $p++) {
			$string .= $characters[mt_rand(0, strlen($characters)-1)];
		}
		return $string;
	}

}


