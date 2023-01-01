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
    protected $core_middlewares = [JWTAuthMiddleware::class];
    protected $middlewares = [];
    public function __construct(string $root)
    {
        $routes = require_once $root . '/../routes/web.php';
        foreach ($routes as $route) {
            if ($route instanceof Route) {
                $this->routes[$route->getRoute()]  = $route;
            } else {
                throw new Exception("The passed object is not a Route");
            }
        }
    }

    public function handle(Request $request)
    {
        return $this->route($request);
    }

    public function route(Request $request)
    {
        $path = ($request->server->get('PATH_INFO'));
        // echo $path;
        if (key_exists($path, $this->routes)) {
            $rt =   $this->routes[$path];
            if ($rt->getVerb() == $request->server->get('REQUEST_METHOD')) {
                $middlewares = array_merge($this->core_middlewares,$this->middlewares);
                for ($i = 0; $i < count($middlewares); $i++) {
                    $middleware = new $middlewares[$i]();
                    $out = $middleware->handle($request);
                    if ($out !== true) {
                        return $out;
                    }
                }

                
                return $rt->execute($request);
            }
        }


        return new Response('Not found', 404);
    }
}
