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
    
    public static function put(string $route,$callback)
    {
        return new static($route,'PUT',$callback);
    }

    public static function patch(string $route,$callback)
    {
        return new static($route,'PATCH',$callback);
    }
    public static function delete(string $route,$callback)
    {
        return new static($route,'DELETE',$callback);
    }
    
    public static function resource(string $route,$class)
    {
        return [
            new static($route.'/','GET',[$class,'all']),
            new static($route.'/{id}','GET',[$class,'show']),
            new static($route.'/','POST',[$class,'store']),
            new static($route.'/{id}','PATCH',[$class,'update']),
            new static($route.'/{id}','DELETE',[$class,'delete']),
        ];
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

    public function setPrefix(string $prefix)
    {
        foreach (array_reverse(explode('//',$prefix)) as $prefix) {
            $this->route = '/'.$prefix.$this->route;
        }
        
    }

    
    public static function prefix(string $prefix) {
            return new RouteGroup([],$prefix);
    }
    
    public static function middlewares(array $middlewares) {
            return new RouteGroup($middlewares,null);
    }
    
    
  
    public function getRoute()
    {
        return $this->route;
    }
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
    public function getVerb()
    {
        return $this->verb;
    }
}