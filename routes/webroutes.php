<?php

use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Route\Route;

return [

    Route::get('/home',function (){ return new Response('You are now home',200);}),
    Route::post('/page',function (){ return new Response('You are now in page',200);}),

];