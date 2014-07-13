<?php

/** 
 * @author dkrauss
 * 
 */
class Request {

	const XML = 0;
	const JSON = 1;
	
	private $endpoint;
	private $callstack = array();
	private $errorstack = array();
	private $lastError = '';
	
	/**
	 */
	function __construct($endpoint) {
		if(strrpos($endpoint, '/') != (strlen($endpoint)-1)){
			$endpoint.='/';
		}
		$this->endpoint = $endpoint; 
	}
	
	/**
	 */
	function __destruct() {
	
	// TODO - Insert your code here
	}
	
	public function getEndpoint() {
		return $this->endpoint;
	} 
	
	protected function addToCallStack($call) {
	
		$this->callstack[] = $call;
	}
	
	public function getCallStack($tags_to_clean = array()) {
		$cs = $this->callstack;
		foreach ($tags_to_clean as $tag)  {
			$csclean = array();
			foreach ($cs as $key => $value)
			{
				if(strpos($value, "<$tag>") === false)
				{
					$csclean[] = $value;
				} else
				{
					$csclean[] = preg_replace("/<$tag>.*<\/$tag>/", "<$tag>Info removed</$tag>", $value);
				}
			}
			$cs = $csclean;
		}
		return $csclean;
	}
	
	protected function addError($errorMessage) {
	
		$this->errorstack[] = $errorMessage;
		$this->lastError = $errorMessage;
	}
	
	public function getErrorStack()
	{
		return $this->errorstack;
	}
	
	public function getLastError() {
	
		return $this->lastError;
	}

	private function translateReponseHeader() {
		
		$rh = get_headers($url, 1);
		sprintf('%s/ '$format)
	}
	
	
	public function post($path, $payload, $responseFormat = self::XML) {
		$opts = array (
				'http' => array (
						'method' => 'POST',
						'header' => "Connection: close\r\nContent-type: application/x-www-form-urlencoded\r\nContent-Length: " . strlen($payload) . "\r\n",
						'content' => $payload
				)
		);
		$response = file_get_contents($this->endpoint . $path, false, stream_context_create($opts));
		
		$rh = $http_response_header;
		/*
		echo <!-- DEBUG in Request post\n";
		var_dump($response);
		var_dump($rh);
		echo "Response status is " . $rh[0] . "\n";
		echo -->\n;
		*/
		if($rh[0] != 'HTTP/1.1 200 OK')
		{
			$this->errorstack[] = 'HTTP request failed: ' . $rh[0];
			return false;
		}
		if ($responseFormat == self::XML) {
			$xml = simplexml_load_string($response);
			if($xml->RESPONSE[0]->attributes()->STATUS == 'OK')
			{
				return $xml->RESPONSE[0];
			} else
			{
				$this->errorstack[] = 'HTTP request failed Web API Request returned error: ' . $xml->MESSAGE;
				return false;
			}
		}
		return $response;
	}
}

?>