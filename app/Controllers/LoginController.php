<?php
namespace App\Controllers;



use SivadasRajan\Pluma\JWT;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Route\Controller;


class LoginController extends Controller{

    protected $jwt;

    public function __construct() {
        $this->jwt = new JWT('secret', 'HS256', 3600, 10);
    }
    public function login(Request $request)
    {

        if($request->attributes->get('username') == 'yes' && $request->attributes->get('password')  == 'bla'){
            $token = $this->jwt->encode([
                'uid'    => 1,
                'aud'    => 'http://site.com',
                'scopes' => ['user'],
                'iss'    => 'http://api.mysite.com',
            ]);
            return new Response(['access_token'=>$token],200);
        }
        return new Response('Invalid credentials',401);
    }
}