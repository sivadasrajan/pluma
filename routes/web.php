<?php


use SivadasRajan\Pluma\Route\Route;
use App\Controllers\LoginController;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Middlewares\JWTAuthMiddleware;

return [

    Route::group([

        Route::group([

            // Authenticaed routes
            Route::group(
                [
                    Route::post('/home', function () {
                        return new Response('You are now home', 200);
                    }),
                ],
                ['middlewares' => ['auth' => JWTAuthMiddleware::class],]
            ),

            Route::get('/page', function () {
                return new Response('You are now in page', 200);
            }),
            Route::post('/login', [LoginController::class, 'login']),
        ], ['prefix' => 'v1',]),

        //Non Authenticated routes

    ], [
        'prefix' => 'api',
    ]),

    Route::get('/welcome', function () {
        return new Response('Welcome to pluma', 200);
    }),

];
