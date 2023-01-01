<?php
namespace SivadasRajan\Pluma\Route;


use SivadasRajan\Pluma\Http\Request;

interface Middleware{

    public function handle(Request $request);

}