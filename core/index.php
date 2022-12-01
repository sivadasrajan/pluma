<?php
require './LitePHPServer.php';
require './JWT.php';
require './Request.php';
require './Response.php';
require './ParameterBag.php';
use SivadasRajan\LitePHPServer\LitePHPServer;
use SivadasRajan\LitePHPServer\Request;


$server = new LitePHPServer();

$response = $server->handle(
    $request = Request::capture()
)->send();

die();
// $server->terminate($request, $response);
