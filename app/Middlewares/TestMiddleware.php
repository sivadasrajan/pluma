<?php
namespace SivadasRajan;

use Closure;
use SivadasRajan\Pluma\Application;
use SivadasRajan\Pluma\Http\Request;
use SivadasRajan\Pluma\Http\Response;
use SivadasRajan\Pluma\Route\Middleware;

class TestMiddleware implements Middleware
{
    public function handle(Request $request,Closure $next)
    {
        if($request->request->get('auth') == 'yes'){
         return $next($request);
        }
        else return new Response("Unautorized",403);
    }
}