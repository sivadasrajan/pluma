<?php
namespace SivadasRajan\Pluma;

use Exception;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Route\Route;

class Application
{
    protected $routes = [];
    protected $middlewares = [];
    public function __construct(string $root)
    {
        $routes = require_once $root.'/../routes/web.php';
        foreach ($routes as $route) {
            if($route instanceof Route){
                $this->routes[$route->getRoute()]  = $route;
            }else{
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
        if(key_exists($path,$this->routes)){
          $rt =   $this->routes[$path];
          if($rt->getVerb() == $request->server->get('REQUEST_METHOD')){
              for ($i=0; $i < count($this->middlewares); $i++) { 
                $middleware = new $this->middlewares[$i]();
                if($i < count($this->middlewares)){
                    var_dump($middleware);
                    $middleware->handle($request,$middleware->handle(null,null));
                    
                }
              }
              }
              return $rt->execute($request);
          }
        

        return new Response('Not found',404);
    }
}
