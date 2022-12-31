<?php

use SivadasRajan\Pluma\Application;

require "../core/Application.php";
require '../core/Http/Request.php';
require '../core/Route/Route.php';


require '../core/JWT.php';
require '../core//ORM/OPORM.php';
require '../core/ORM/Ledger.php';
require '../core/Http/Response.php';
require '../core/Http/ParameterBag.php';
$application = new Application(__DIR__);

return $application;