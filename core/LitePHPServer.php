<?php
namespace SivadasRajan\LitePHPServer;

use Ahc\Jwt\JWT;
use Ahc\Jwt\JWTException;
use SivadasRajan\LitePHPServer\Request;
use SivadasRajan\LitePHPServer\Response;

ini_set('display_errors', 1);

class LitePHPServer{

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
