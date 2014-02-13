<?php

/**
 * @link https://github.com/JMB-Technology-Limited/CodeAPictureJudge
 * @license https://raw.github.com/JMB-Technology-Limited/CodeAPictureJudge/master/LICENSE.txt BSD
 */
class WebEnvironment {
	
	protected $server;
	
	function __construct($server) {
		$this->server = $server;
	}

	
	function getSiteRoot() {
		// TODO make work with sub folders by extracting sub folder path from SCRIPT_NAME
		return "http://".$this->server['HTTP_HOST'].'/';
	}
	
}


