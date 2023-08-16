<?php


use SivadasRajan\Pluma\Route\Route;
use App\Controllers\LoginController;
use App\Controllers\LedgerController;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Middlewares\JWTAuthMiddleware;

return [

    Route::prefix('api')->group([

        Route::prefix('v1')->group([

            // Authenticaed routes
            Route::middlewares(['auth' => JWTAuthMiddleware::class])->group(
                [
                    Route::get('/home', function () {
                        return new Response('You are now home', 200);
                    }),

                    Route::resource('/ledger',LedgerController::class)
                ],
            ),

            Route::get('/page/{id}/{name}/', function () {
                return new Response('You are now in page', 200);
            }),
            Route::post('/login', [LoginController::class, 'login']),
        ]),

        //Non Authenticated routes

    ]),

    Route::get('/welcome', function () {
        return new Response('Welcome to pluma', 200);
    }),

];
