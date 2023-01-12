<?php
namespace App;

use SivadasRajan\Pluma\Application;

class MyApplication extends Application
{
    protected $middlewares = [];
    public function __construct(string $root)
    {
        parent::__construct($root);
    }
}