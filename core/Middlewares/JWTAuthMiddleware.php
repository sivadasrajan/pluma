<?php
namespace SivadasRajan\Pluma\Middlewares;

use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Route\Middleware;

class JWTAuthMiddleware implements Middleware{
    
    protected $jwt;

    public function __construct() {
        $this->jwt = new JWT('secret', 'HS256', 3600, 10);
    }

    public function handle(Request $request)
    {
       return $this->authenticate($request);
    }

    public function authenticate(Request $request)
    {
            $token = $request->headers->get('AUTHORIZATION');
            try {
                $payload = $this->jwt->decode($token);
                return true;
            } catch (JWTException $th) {
                return new Response('Auth error',403);
            }   
    }

}