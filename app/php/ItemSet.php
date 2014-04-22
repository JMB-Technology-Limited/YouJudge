<?php

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */
class ItemSet {
	
	
	protected $id;
	protected $title;
	
	function __construct($data) {
		if (is_array($data)) {
			$this->id = isset($data['id']) ? $data['id'] : null;
			$this->title = isset($data['title']) ? $data['title'] : null;
		}
	}
	
	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

}
