<?php
namespace SivadasRajan\Pluma\Route;

use Exception;
use SivadasRajan\Pluma\Http\Request;

class Route{

    private $callback;
    private string $route;
    private string $name;
    private string $verb;
    private array $middlewares = [];
    private $object;

    public function __construct(string $route,string $verb,$callback) {

        $this->verb = $verb;
        $this->route = $route;

        if(is_array($callback)){
            $this->object = new $callback[0];
            $this->callback = $callback[1];


        }else{
            $this->callback = $callback;
        }
    }
    
    public static function get(string $route, $callback)
    {
      
        return new static($route,'GET',$callback);
    }
    
    public static function post(string $route,$callback)
    {
        return new static($route,'POST',$callback);
    }
    
    public function execute(Request $request)
    {
        

        if(is_string($this->callback)){
            $funcname = ($this->callback);
            return $this->object->$funcname($request);

        }else

       return call_user_func($this->callback,$request);
    }

    public function middleware(array $middlewares)
    {
        $this->middlewares = $middlewares;

        return $this;
    }

    public function prefix(string $prefix)
    {
        foreach (array_reverse(explode('//',$prefix)) as $prefix) {
            $this->route = $prefix.'//'.$this->route;
        }
    }

    public static function group(array $routes,array $attrs) {
        /** @var Route $route */
        foreach ($routes as $route) {
          if(array_key_exists('middlewares',$attrs)){
             if(is_array($attrs['middlewares'])){
              $route->middleware($attrs['middlewares']);
             }else throw new Exception("Invalid middlewares");
          }
  
          if(array_key_exists('prefix',$attrs)){
            $route->prefix($attrs['prefix']);
          }
        }
      }
  
    public function getRoute()
    {
        return $this->route;
    }
    public function getVerb()
    {
        return $this->verb;
    }
}