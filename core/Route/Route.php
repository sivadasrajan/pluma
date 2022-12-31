<?php
namespace SivadasRajan\Pluma\Route;

use SivadasRajan\Pluma\Http\Request;

class Route{

    private $callback;
    private string $route;
    private string $name;
    private string $verb;

    public function __construct(string $route,string $verb, callable $callback) {
        $this->callback = $callback;
        $this->verb = $verb;
        $this->route = $route;
    }
    
    public static function get(string $route,callable $callback)
    {
        return new static($route,'GET',$callback);
    }
    
    public static function post(string $route,callable $callback)
    {
        return new static($route,'POST',$callback);
    }
    
    public function execute(Request $request)
    {
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