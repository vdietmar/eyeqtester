<?php

require_once DIR_LIB . 'Model.php';
require_once DIR_LIB . 'EyeqWebAPI.php';

/*
 * TODO Need to separate page, nav and Co. from the real settings
 */
class Settings extends Model {
	/*
	 * Later when having multiple settings sections make this
	 * depending from section via function parameter.
	 */
	public function processForm($in) {
		
		parent::processForm($in);
		$r = true;
		/*
		echo "<!-- DEBUG in settings model:\n";
		print_r($this->in);
		echo "-->\n";
		*/
		// Process General Settings
		if ($this->checkEndpoint() === false) {
			$this->addAlert('danger', 'Check of Endpoint URL failed.');
			$this->addError('eyeqendpoint');
			$r = false;
		} else {
			if ($this->checkEndpoint() === false) {
				$this->addAlert('danger', 'Check of Client ID failed.');
				$this->addError('eyeqclientid');
				$r = false;
			} else {
				if ($this->checkUserId() === false) {
					$this->addAlert('danger', 'Check or registration of new User ID failed.');
					$this->addError('eyequserid');
				}
			}
		}
		return ($r !== false);
	}
	
	private function checkEndpoint() {
		
		$api = new EyeqWebAPI($this->eyeqendpoint);
		return $api->ping();
	}

	private function checkUserId() {
		
		$api = new EyeqWebAPI($this->eyeqendpoint, $this->eyeqclientid);
		if ($this->eyequserid == '') {
			if (($r = $api->register()) !== false) {
				$this->eyequserid = $r;
				return true;
			} else {
				return false;
			}
		} else {
			// TODO Dummy command to check
			return true;			
		}
	}
		
	public function saveSettings() {
		
		$res = array();
		foreach ($this->data as $key => $val) {
			$res [] = "$key = " . (is_numeric($val)?$val:'"' . addslashes($val) . '"');
		}
		return (file_put_contents(DIR_DATA . 'settings.ini', implode("\r\n", $res)) !== false);
	}
	
	public function loadSettings() {
		
		$res = array();
		$file = explode("\r\n", file_get_contents(DIR_DATA . 'settings.ini'));
		/*
		echo "<!-- DEBUG in Load Settings:\n";
		print_r($file);
		echo "-->\n";
		*/
		foreach ($file as $line) {
			$res = explode("=", $line);
			$key = trim($res[0]);
			$val = trim($res[1]);
			$this->data[$key] = is_numeric($val)?$val:stripslashes(trim($val,'"'));
		}
		return (count($file) != 0);
	}
}

?>