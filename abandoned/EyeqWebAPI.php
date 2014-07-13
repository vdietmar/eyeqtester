<?php

require_once '../eyeQ WebAPI Test Application/library/Request.php';

/** 
 * @author dkrauss
 * 
 */
class EyeqWebAPI extends Request {
	
	private $clientId;
	private $userId;
	
	/**
	 */
	public function __construct($endpoint, $clientId = '', $userId = '', $autoRegister = false) {
		
		parent::__construct($endpoint);
		$this->clientId = $clientId;
		if ($userId == '' && $autoRegister) {
			$this->register($userId);
		} else {
			$this->userId = $userId;
		}
	}
	
	/**
	 */
	function __destruct() {
		
		// TODO - Insert your code here
	}
	
	function getClientId() {
		
		return $this->clientId;
	}
	
	function getUserId() {
		
		return $this->userId;
	}
		
	
	private function request($payload, $responseFormat = self::XML) {

		$response = http_post_data($this->endpoint, $payload, $info);
		/*
		echo <!-- DEBUG in Request post\n";
		var_dump($response);
		var_dump($info);
		echo -->\n;
		*/		
		if ($info['error'] != '') {
			$this->addError('HTTP request failed: ' . $info['error']);
			return false;
		}
		if ($info['response_code'] != 200) { 
			$this->addError('HTTP request failed: '. $info['response_code']);
			return false;
		}
		if ($responseFormat == self::XML) {
			$xml = simplexml_load_string(http_parse_message($response)->body);
			if($xml->RESPONSE[0]->attributes()->STATUS == 'OK')
			{
				return $xml->RESPONSE[0];
			} else
			{
				$this->addError('WebAPI Error: ' . $xml->MESSAGE);
				return false;
			}
		}
		return '';
	}
	
	public function ping() {
		return ($this->request('') !== false);
	}
	
	public function register() {
		
		if(($response = $this->command('REGISTER')) !== false)
		{
			$this->userid = (string)$response->USER;
			return true;
		} else
		{
			$this->errorstack = 'Web API Registration failed';
			return false;
		}
	}
	
	public function command($cmd) {
		
		if ($this->getUserId() == '') {
			return false;
		}
	}
}

?>