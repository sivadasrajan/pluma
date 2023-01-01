<?php
namespace SivadasRajan\Pluma\Route;

use SivadasRajan\Pluma\Http\Request;

class Route{

    private $callback;
    private string $route;
    private string $name;
    private string $verb;
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

    public function getRoute()
    {
        return $this->route;
    }
    public function getVerb()
    {
        return $this->verb;
    }
}