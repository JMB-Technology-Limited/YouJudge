<?php

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */
class ItemRepository {

	
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
		
		while(file_exists(__DIR__.'/../../items/full/'.$newfilename)) {
			$newfilename = mt_rand(1, 9999999).basename($remoteFileName);
		}
		
		$stat = $this->db->prepare("INSERT INTO item (source_url, source_text, filename, created_at) ".
				"VALUES (:source_url, :source_text, :filename, :created_at)");
		$stat->execute(array(
				'source_url'=>$sourceURL,
				'source_text'=>$sourceText,
				'filename'=>$newfilename,
				'created_at'=>$this->timesource->getFormattedForDataBase()
			));
		$id = $this->db->lastInsertId();
		
		move_uploaded_file($localFileName, __DIR__.'/../../items/full/'.$newfilename);
		
		$stat = $this->db->prepare("INSERT INTO item_in_site (site_id,item_id,created_at) ".
				"VALUES (:site_id,:item_id,:created_at)");
		$stat->execute(array(
				'site_id'=>$site->getId(),
				'item_id'=>$id,
				'created_at'=>$this->timesource->getFormattedForDataBase()
			));
	}
	
	public function getLastAddedForSite(Site $site, $count=5) {
		$stat = $this->db->prepare("SELECT item.* FROM item ".
				"JOIN item_in_site ON item_in_site.item_id = item.id ".
				"WHERE item_in_site.site_id = :site_id  AND item_in_site.removed_at IS NULL ".
				"ORDER BY item_in_site.created_at DESC ".
				"LIMIT ".intval($count));
		$stat->execute(array(
			'site_id'=>$site->getId(),
		));
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = new Item($data);
		}
		return $out;		
	}
	
	public function getByIdInSite($id, Site $site) {
		$stat = $this->db->prepare("SELECT item.* FROM item ".
				"JOIN item_in_site ON item_in_site.item_id = item.id ".
				"WHERE item_in_site.site_id = :site_id AND item.id = :id ".
				"AND item_in_site.removed_at IS NULL");
		$stat->execute(array(
			'site_id'=>$site->getId(),
			'id'=>$id,
		));
		if ($stat->rowCount() > 0) {
			return new Item($stat->fetch());
		}
	}
	
	public function getChartForTypeAnswer(QuestionAnswer $answer, $threshhold=3, $order="DESC", $limit=100) {
		$order = (strtoupper($order) == "DESC") ? "DESC" : "ASC";
		$stat = $this->db->prepare("SELECT item.*, item_answer_cache.votes_total, item_answer_cache.votes_won FROM item ".
				"JOIN item_answer_cache ON item_answer_cache.item_id = item.id ".
				"WHERE item_answer_cache.question_answer_id = :id AND item_answer_cache.votes_total >= :threshhold ".
				"ORDER BY item_answer_cache.votes_won_percentage ".$order." LIMIT ".intval($limit));
		$stat->execute(array(
			'id'=>$answer->getId(),
			'threshhold'=>$threshhold,
		));
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = array('item'=>new Item($data),'votes_won'=>$data['votes_won'],'votes_total'=>$data['votes_total']);
		}
		return $out;
	}
	
	public function getChartForTypeVersus(Site $site, $threshhold=3, $order="DESC", $limit=100) {
		$order = (strtoupper($order) == "DESC") ? "DESC" : "ASC";
		$stat = $this->db->prepare("SELECT item.*, item_versus_cache.votes_total, item_versus_cache.votes_won FROM item ".
				"JOIN item_versus_cache ON item_versus_cache.item_id = item.id AND item_versus_cache.site_id = :id ".
				"WHERE item_versus_cache.votes_total >= :threshhold ".
				"ORDER BY item_versus_cache.votes_won_percentage ".$order." LIMIT ".intval($limit));
		$stat->execute(array(
			'id'=>$site->getId(),
			'threshhold'=>$threshhold,
		));
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = array('item'=>new Item($data),'votes_won'=>$data['votes_won'],'votes_total'=>$data['votes_total']);
		}
		return $out;
	}
	
}

