<?php


class Site {

	protected $id;
	protected $title;
	protected $question;
	protected $adminPassword;
	protected $type;
	
	function __construct($data) {
		if (is_array($data)) {
			$this->id = isset($data['id']) ? $data['id'] : null;
			$this->title = isset($data['title']) ? $data['title'] : null;
			$this->question = isset($data['question']) ? $data['question'] : null;
			$this->adminPassword = isset($data['adminPassword']) ? $data['adminPassword'] : null;
			$this->type = isset($data['type']) ? $data['type'] : null;
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
		return $this->adminPassword;
	}

	public function getType() {
		return $this->type;
	}


}

