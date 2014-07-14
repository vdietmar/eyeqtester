<?php

require_once DIR_MDLS . 'Settings.php';

$model = new Settings('settings.php', 'General Settings', 3);
if (count($_POST) != 0) {
	if ($model->processForm($_POST)) {
		$model->saveSettings();
		$model->addAlert('success', 'Settings have successfully be saved (check not implemented).');
	}
	
} else {
	$model->loadSettings();
}

?>