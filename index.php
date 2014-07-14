<?php

/*
* On require vs include:
* require will produce a fatal error (E_COMPILE_ERROR) and stop the script
* include will only produce a warning (E_WARNING) and the script will continue
*/

require_once dirname( __FILE__ ) . 'eyeQTester.class.php' ;

define("VD_DEBUG", false);
define("GN_DEBUG", false);

// Create app framework ans run select controller
$eyeQTester = new $eyeQTester();
$eyeQTester->prepare();
$eyeQTester->render();

// View
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

?>