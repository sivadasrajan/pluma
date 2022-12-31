<?php
namespace SivadasRajan\Core\Pluma;

use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;


class Pluma{

    protected $jwt;

    public function __construct() {
        $this->jwt = new JWT('secret', 'HS256', 3600, 10);
    }

    public function handle(Request $request)
    {
       return $this->authenticate($request);
    }

    public function authenticate(Request $request):Response
    {
            $token = '';
            try {
                $payload = $this->jwt->decode($token);
                echo json_encode("Welcome");
            } catch (JWTException $th) {
                return new Response('Auth error',403);
            }   
    }

}
