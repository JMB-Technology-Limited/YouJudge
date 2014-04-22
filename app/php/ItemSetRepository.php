<?php

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */
class ItemSetRepository {
	
	
	/** @var PDO **/
	protected $db;
	
	/** @var TimeSource **/
	protected $timesource;
	
	function __construct(PDO $db, TimeSource $timesource) {
		$this->db = $db;
		$this->timesource = $timesource;
	}
	
	
	function loadItemSets() {
		$stat = $this->db->prepare("SELECT * FROM item_set");
		$stat->execute();
		$out = array();
		while($data = $stat->fetch()) {
			$out[] = new ItemSet($data);
		}
		return $out;
	}
	
	function loadItemSetById($itemsetid) {
		
		$stat = $this->db->prepare("SELECT * FROM item_set WHERE id=:id");
		$stat->execute(array(
				'id'=>$itemsetid,
			));
		if ($stat->rowCount() > 0) {
			return new ItemSet($stat->fetch());
		}
	}
	
	function create($title) {
		$stat = $this->db->prepare("INSERT INTO item_set (title,created_at) ".
				"VALUES(:title,:created_at)");
		$stat->execute(array(
				'title'=>$title,
				'created_at'=>$this->timesource->getFormattedForDataBase(),
			));
		return $this->db->lastInsertId();
	}
	
	function addItemSetToSite(ItemSet $itemset, Site $site) {
		$statInsert = $this->db->prepare("INSERT IGNORE INTO item_in_site (site_id,item_id,created_at) ".
				"VALUES (:site_id,:item_id,:created_at)");
		$statRead = $this->db->prepare("SELECT item.id FROM item ".
				"JOIN item_in_item_set ON item_in_item_set.item_id = item.id ".
				"WHERE item_in_item_set.item_set_id = :item_set_id  AND item_in_item_set.removed_at IS NULL ".
				"ORDER BY item_in_item_set.created_at DESC ");
		$statRead->execute(array(
			'item_set_id'=>$itemset->getId(),
		));
		while($data = $statRead->fetch()) {
			$statInsert->execute(array(
				'site_id'=>$site->getId(),
				'item_id'=>$data['id'],
				'created_at'=>$this->timesource->getFormattedForDataBase(),
			));
		}
	}
	

}
