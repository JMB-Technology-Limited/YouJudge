<?php

/**
 * @link https://github.com/JMB-Technology-Limited/YouJudge
 * @license https://github.com/JMB-Technology-Limited/YouJudge/blob/master/LICENSE.txt BSD
 */
class Site {

	protected $id;
	protected $title;
	protected $question;
	protected $admin_password;
	protected $api_password;
	protected $type;
	
	function __construct($data) {
		if (is_array($data)) {
			$this->id = isset($data['id']) ? $data['id'] : null;
			$this->title = isset($data['title']) ? $data['title'] : null;
			$this->question = isset($data['question']) ? $data['question'] : null;
			$this->admin_password= isset($data['admin_password']) ? $data['admin_password'] : null;
			$this->api_password = isset($data['api_password']) ? $data['api_password'] : null;
			$this->type = isset($data['question_type']) ? $data['question_type'] : null;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getQuestion() {
		return $this->question;
	}

	public function getAdminPassword() {
		return $this->admin_password;
	}

	public function getApiPassword() {
		return $this->api_password;
	}

	public function getType() {
		return $this->type;
	}


}

