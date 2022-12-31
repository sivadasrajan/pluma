<?php
ini_set('html_errors', true);

require_once 'core_autoload.php';
require_once 'app_autoload.php';

use SivadasRajan\MyApplication;
$application = new MyApplication(__DIR__);

return $application;