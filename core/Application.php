<?php

namespace SivadasRajan\Pluma;

use Exception;
use SivadasRajan\Pluma\Route\Route;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Middlewares\JWTAuthMiddleware;

class Application
{
    protected $routes = [];
    protected $core_middlewares = [];
    protected $middlewares = [];
    public function __construct(string $root)
    {
        $routes = require_once $root . '/../routes/web.php';
        $this->processRouteOrRouteGroup($routes);
    }

    function processRouteOrRouteGroup($routes)
    {
        foreach ($routes as $route) {
            if ($route instanceof Route) {
                $key = $route->getVerb().':'.$route->getRoute();
                $key = $key.(substr($key, -1) == '/' ? '' : '/');
                $this->routes[$key]  = $route;
            } else if (is_array($route)) {
                $this->processRouteOrRouteGroup($route);
            } else {
                throw new Exception("The passed route is invalid");
            }
        }
    }

    public function handle(Request $request)
    {
        return $this->route($request);
    }

    public function route(Request $request)
    {

        if ('OPTIONS' == $request->server->get('REQUEST_METHOD'))
                return new Response('', 200, [
                    'Access-Control-Allow-Origin: *',
                    'Access-Control-Allow-Methods: '.'POST',
                    'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization',
                    'Access-Control-Allow-Credentials: true',

                ]);
        $path = ($request->server->get('REQUEST_METHOD').':'.$request->server->get('PATH_INFO'));
        $path = $path.(substr($path, -1) == '/' ? '' : '/');
       
        if (key_exists($path, $this->routes)) {
            $rt =   $this->routes[$path];
            if ($rt->getVerb() == $request->server->get('REQUEST_METHOD')) {
                
                $middlewares = array_merge($this->core_middlewares, $rt->getMiddlewares());
                foreach ($middlewares as $middleware) {

                    $middlewareObj = new $middleware();
                    $out = $middlewareObj->handle($request);
                    if ($out !== true) {
                        return $out;
                    }
                }


                $response =  $rt->execute($request);
                if($response){
                    $response->addHeader('Access-Control-Allow-Origin',' *');
                    return ($response);
                }else{
                   return  new Response('',200);
                }
            }
        }


        if ('GET' == $request->server->get('REQUEST_METHOD'))
            return (new Response(file_get_contents("index.html"), 200))->setJson(false);
        else
            return new Response('Not found', 404);
    }
}
