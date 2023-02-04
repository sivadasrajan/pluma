<?php
namespace SivadasRajan\Pluma\Route;

use Exception;
use SivadasRajan\Pluma\Http\Request;

class RouteGroup{

    private $middlewares = [];
    private $prefix = '';

    public function __construct($middlewares,$prefix)
    {
        $this->middlewares = $middlewares;
        $this->prefix = $prefix;
        
    }
  
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    public function getPrefix()
    {
        return $this->prefix;
    }

    public function group(array $routes) {
        /** @var Route $route */
        foreach ($routes as $route) {

        if($route instanceof Route){
                if(is_array($this->middlewares)){
                 $route->middleware($this->middlewares);
                }else throw new Exception("Invalid middlewares");
            
                if($this->prefix)
                    $route->setPrefix($this->prefix);
        }elseif (is_array($route)) {
            self::group($route);
        }
          
        }

        return $routes;
      }
    
}