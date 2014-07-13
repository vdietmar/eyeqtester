<?php

namespace VD;

/*
 * This is the main application framework which uses a simple MVC model.
*/

define('DIR_BASE',	dirname(dirname( __FILE__ )) . '/');
define('DIR_LIB',	'library/');
define('DIR_VIEWS',	'views/');
define('DIR_CTLS',	'controllers/');
define('DIR_MDLS',	'models/');
define('DIR_DATA',	'data/');
define('DIR_CACHE',	'cache/');

if (!file_exists(DIR_DATA)) { mkdir(DIR_DATA); }
if (!file_exists(DIR_CACHE)) { mkdir(DIR_CACHE); }

define('APP_NAME', 'eyeQ WebAPI Tester');

define("VD_DEBUG", false);
define("GN_DEBUG", false);

class eyeQTester {
	
	// List of known controllers, only actions for them are allowed
	private $_controllers = array(
			'settings' => 'settings.php',
	);
	private $_model = null;
	
	// TODO - Insert your code here
	function __construct() {
	}
	function __destruct() {
		
		// TODO - Insert your code here
	}
	
	// Select controller; the controller will load the model
	function prepare() {
		// Controller (and model)
		if (isset($_GET['action']) && isset($this->_controllers[$_GET['action']])) {
			require_once DIR_CTLS . $this->_controllers[$_GET['action']];
		} else {
			require_once DIR_CTLS . 'dummy.php';
		}
		
	}
	
	// Build view from model and template
	function render() {
		if ($model != null) {
			$main = new Template('main.php', array(
					'app_name' => APP_NAME,
					'title' => $model->title,
					'nav' => $model->nav,
					'container' => new Template($model->page, $model->getStuff()))
			);
			/*
			 echo "<!-- DEBUG in index:\n";
			print_r($_POST);
			print_r($model->getStuff());
			echo "-->\n";
			*/
			ob_start();
			$main->render();
			ob_end_flush();
		}		
	}
}

?>