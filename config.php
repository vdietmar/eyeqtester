<?php
namespace VD;

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
?>