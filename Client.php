<?php

namespace mastercardmatch;

class Client {
	private $endpoint;
	private $ch;

	public function __construct($endpoint = "http://mastercardmatch.azurewebsites.net/") {
		$this->endpoint = $endpoint;
		$this->ch = curl_init();
		curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
	}
	public function queryTermination($query = []) {
		return $this->__request($query);
	}
	private function __request($query = [], $call) {
		if(empty($call) || empty($query)) {
			return new \stdClass();
		}
		
		curl_setopt($this->ch, CURLOPT_URL, $this->endpoint . $call . "/" . urlencode(json_encode($query)));
		$result = curl_exec($this->ch);
		return json_decode($result);
	}
}