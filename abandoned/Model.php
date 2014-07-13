<?php

class Model {
	protected $data = array();
	private $alerts = array();
	private $errors = array();

	public function __get($name) {
		return $this->data[$name];
	}

	public function __set($name, $value) {
		$this->data[$name] = $value;
	}
	
	public function __construct($page = 'dummy.php', $title = 'No title', $nav = -1) {
		$this->page = $page;
		$this->title = $title;
		$this->nav = $nav;
		$this->container_title = $title;
	}
	
	public function processForm($in) {
		/*
		 * Here you process any form input.
		 * As an default we copy all input to the output and mark all input as OK.
		 */
		foreach ($in as $key => $value) {
			$this->data[$key] = $value;
			$this->errors[$key] = false;
		}
	}
	
	public function addAlert($type, $message) {
		$this->alerts[$type] = $message;
	}
	
	private function addError($key)
	{
		$this->errors[$key] = true;
	}
	
	public function getStuff() {
		$stuff = $this->data;
		$stuff['alerts'] = $this->alerts;
		$stuff['errors'] = $this->errors;
		return $stuff;		
	}	
}

?>