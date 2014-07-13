<?php

/*
 * This is the main application framework which uses a simple MVC model.
 * 
 * On require vs include:
 * require will produce a fatal error (E_COMPILE_ERROR) and stop the script
 * include will only produce a warning (E_WARNING) and the script will continue
 */

require_once 'config.php' ;
require_once DIR_LIB . 'Template.php';

$model = null;

// List of known controllers, only actions for them are allowed
$controllers = array(
	'settings' => 'settings.php',
);

// Controller (and model)
if (isset($_GET['action']) && isset($controllers[$_GET['action']])) {
	require_once DIR_CTLS . $controllers[$_GET['action']];
} else {
	require_once DIR_CTLS . 'dummy.php';
}

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