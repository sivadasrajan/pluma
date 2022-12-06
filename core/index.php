<?php

use SivadasRajan\LitePHPServer\Http\Request;
use SivadasRajan\LitePHPServer\LitePHPServer;
use SivadasRajan\Ledger;

require './LitePHPServer.php';
require './JWT.php';
require './ORM/OPORM.php';
require './ORM/Ledger.php';
require './ORM/Query.php';
require './Http/Request.php';
require './Http/Response.php';
require './Http/ParameterBag.php';


$server = new LitePHPServer();

$led = new Ledger();
$led->where('id',null , 'NOT');
// $orm->all();

// $response = $server->handle(
//     $request = Request::capture()
// )->send();

die();
// $server->terminate($request, $response);
