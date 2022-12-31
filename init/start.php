<?php
ini_set('html_errors', true);

require_once 'core_autolaod.php';
require_once 'app_autolaod.php';

use SivadasRajan\MyApplication;
$application = new MyApplication(__DIR__);

return $application;