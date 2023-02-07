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

    public function processRouteOrRouteGroup($routes)
    {
        foreach ($routes as $route) {
            if ($route instanceof Route) {
                $key = preg_replace("/(^\/)|(\/$)/","",$route->getRoute());
                $this->routes[$key]  = $route;
            } elseif (is_array($route)) {
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
        if ('OPTIONS' == $request->server->get('REQUEST_METHOD')) {
            return new Response('', 200, [
                'Access-Control-Allow-Origin: *',
                'Access-Control-Allow-Methods: ' . 'POST',
                'Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization',
                'Access-Control-Allow-Credentials: true',

            ]);
        }
        $path =  $request->server->get('PATH_INFO');
        $path = preg_replace("/(^\/)|(\/$)/","",$path);
        foreach ($this->routes as $name => $route) {

            preg_match_all("/(?<={).+?(?=})/", $name, $paramMatches);
            if (!empty($paramMatches[0])) {

                foreach ($paramMatches[0] as $key) {
                    $paramKey[] = $key;
                }
                $uri = explode("/", $name);
                $indexNum = []; 

                foreach($uri as $index => $param){
                    if(preg_match("/{.*}/", $param)){
                        $indexNum[] = $index;
                    }
                }

                $reqUri = explode("/", $path);

                //running for each loop to set the exact index number with reg expression
                //this will help in matching route
                foreach($indexNum as $key => $index){
        
                    //in case if req uri with param index is empty then return
                    //because url is not valid for this route
                    if(empty($reqUri[$index])){
                        return;
                    }
        
                    //setting params with params names
                    $params[$paramKey[$key]] = $reqUri[$index];
        
                    //this is to create a regex for comparing route address
                    $reqUri[$index] = "{.*}";
                }
        
                dd($reqUri);
                //converting array to sting
                $reqUri = implode("/",$reqUri);
                $reqUri = str_replace("/", '\\/', $reqUri);
        
                
            } elseif ($path ==  $name) {
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
                    if ($response) {
                        $response->addHeader('Access-Control-Allow-Origin', ' *');
                        return ($response);
                    } else {
                        return  new Response('', 200);
                    }
                }
            }
            
        }



        if ('GET' == $request->server->get('REQUEST_METHOD')) {
            return (new Response(file_get_contents("index.html"), 200))->setJson(false);
        } else {
            return new Response('Not found', 404);
        }
    }
}
