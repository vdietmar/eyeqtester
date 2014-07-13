<?php

require_once 'config.php' ;
require_once '../' . DIR_LIB . 'EyeqWebAPI.php';

$api = new EyeqWebAPI('https://c952576.ipg.web.cddbp.net/webapi/xml/1.0/');
$api->ping();

?>