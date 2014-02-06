<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
class Picture {

	protected $id;
	protected $source_url;
	protected $source_text;
	protected $filename;
	
	function __construct($data) {
		if (is_array($data)) {
			$this->id = isset($data['id']) ? $data['id'] : null;
			$this->source_text = isset($data['source_text']) ? $data['source_text'] : null;
			$this->source_url = isset($data['source_url']) ? $data['source_url'] : null;
			$this->filename = isset($data['filename']) ? $data['filename'] : null;
		}
	}

	public function getId() {
		return $this->id;
	}

	public function getSourceUrl() {
		return $this->source_url;
	}

	public function getSourceText() {
		return $this->source_text;
	}

	public function getFileName() {
		return $this->filename;
	}


	
}


