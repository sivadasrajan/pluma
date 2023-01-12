<?php
namespace SivadasRajan\Pluma\Middlewares;



use SivadasRajan\Pluma\JWT;
use SivadasRajan\Pluma\JWTException;
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
            if($token)
            try {
                $payload = $this->jwt->decode($token);
                return true;
            } catch (JWTException $th) {
                return new Response('Auth error',403);
            }   
        return new Response('Missing token',403);
    }

}