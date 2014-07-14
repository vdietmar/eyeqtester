<?php
require_once DIR_LIB . 'MVC.class.php';

class Controller {
	private $_model;
	
	function __construct() {
		$model = new VD\MVC\VDModel();
	}
	
	function __destruct() {
		
	}
	
	function run()
	{
		return true;
	}
	
	function getModel() {
		return $this->_model;
	}
}
?>