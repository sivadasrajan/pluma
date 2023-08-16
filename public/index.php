<?php
require '../vendor/autoload.php';
ini_set('html_errors', true);
ini_set('xdebug.mode', 'develop');
ini_set('display_errors', 1);

use SivadasRajan\Pluma\Http\Request;

$app = require_once __DIR__ . '/../init/start.php';



// $led = new Ledger();
// var_dump($led->selectQuery("SELECT * FROM ledgers limit 1;"));
// $orm->all();

$request = Request::capture();
$response = $app->handle(
    $request
)->send();

exit();
// $server->terminate($request, $response);

function dd($arrayData, $exit = TRUE)
{
    echo "<pre>";
    var_dump($arrayData);
    if ($exit === TRUE) die();
}
