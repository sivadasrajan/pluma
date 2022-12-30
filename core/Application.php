<?php
namespace SivadasRajan\LitePHPServer;

use Exception;
use SivadasRajan\LitePHPServer\Http\Request;
use SivadasRajan\LitePHPServer\Http\Response;
use SivadasRajan\LitePHPServer\Route\Route;

class Application
{
    private $routes = [];
    public function __construct(string $root)
    {
        $routes = require_once $root.'/../routes/webroutes.php';
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
        var_dump($request->server);
        if(key_exists($path,$this->routes)){
          $rt =   $this->routes[$path];
          if($rt->getVerb() == $request->server->get('REQUEST_METHOD')){

              return $rt->execute($request);
          }
        }

        return new Response('Not found',404);
    }
}
