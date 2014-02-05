<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
class QuestionAnswer {


	protected $id;
	protected $site_id;
	protected $answer_index;
	protected $answer;
	
	function __construct($data) {
		if (is_array($data)) {
			$this->id = isset($data['id']) ? $data['id'] : null; 
			$this->site_id = isset($data['site_id']) ? $data['site_id'] : null; 
			$this->answer_index = isset($data['answer_index']) ? $data['answer_index'] : null; 
			$this->answer = isset($data['answer']) ? $data['answer'] : null; 
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getSiteId() {
		return $this->site_id;
	}

	public function getAnswerIndex() {
		return $this->answer_index;
	}

	public function getAnswer() {
		return $this->answer;
	}


}

