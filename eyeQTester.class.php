<?php

require_once dirname( __FILE__ ) . 'VD/MVC/MVC.class.php';

define('DIR_DATA',	dirname( __FILE__ ) . 'data/');
define('DIR_CACHE',	dirname( __FILE__ ) . 'cache/');

if (!file_exists(DIR_DATA)) { mkdir(DIR_DATA); }
if (!file_exists(DIR_CACHE)) { mkdir(DIR_CACHE); }

define('APP_NAME', 'eyeQ WebAPI Tester');



/*
 * This is the main application framework which uses a simple MVC model.
*/
class eyeQTester {
	
	// List of known controllers, only actions for them are allowed
	private $_controllers = array(
			'settings' => 'Settings.Controller.class.php'
	);
	private $_controller = null;
	private $_model = null;
	
	function __construct() {
		// TODO - Insert your code here
	}
	
	function __destruct() {
		// TODO - Insert your code here
	}
	
	function init() {
		return true;
	}
	
	// Select and run controller; the controller will load the model
	function go($controller) {
		if ($controller == '') { $controller = $_GET['action']; }
		// Controller (and model)
		// Only known contollers can be loaded or a dummy controler gets loaded
		if (isset($controller) && isset($this->_controllers[$controller])) {
			require_once DIR_CTLS . $this->_controllers[$_GET['action']];
		} else {
			// Use standard (dummy) controller
			$this->_controller = new VD\MVC\Controller();
		}
		
		if ($this->_controller->run()) { $this->_model = $this->$_controller->getModel(); }
	}
	
	// Build view from model and template
	function render() {
		if ($this->_model != null) {
			$main = new Template('main.php', array(
					'app_name' => APP_NAME,
					'title' => $this->_model->title,
					'nav' => $this->_model->nav,
					'container' => new VD\MVC\VDTemplate($this->_model->page, $this->_model->getStuff()))
			);
			if (VD_DEBUG) {
				echo "<!-- DEBUG in index:\n";
				print_r($_POST);
				print_r($this->_model->getStuff());
				echo "-->\n";
			}
			ob_start();
			$main->render();
			ob_end_flush();
		}		
	}
}

?>