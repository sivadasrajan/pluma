<?php
require '../vendor/autoload.php';
ini_set('html_errors', true);

ini_set('display_errors', 1);
use SivadasRajan\Pluma\Http\Request;


$app = require_once __DIR__.'/../init/start.php';



// $led = new Ledger();
// var_dump($led->selectQuery("SELECT * FROM ledgers limit 1;"));
// $orm->all();

$response = $app->handle(
    $request = Request::capture()
)->send();

die();
// $server->terminate($request, $response);
