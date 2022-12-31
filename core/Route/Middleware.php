<?php
namespace SivadasRajan\Pluma\Route;

use Closure;
use SivadasRajan\Pluma\Http\Request;

interface Middleware{

    public function handle(Request $request,Closure $next);

}