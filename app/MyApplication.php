<?php
namespace SivadasRajan;

use SivadasRajan\Pluma\Application;

class MyApplication extends Application
{
    protected $middlewares = [
        TestMiddleware::class
    ];
    public function __construct(string $root)
    {
        parent::__construct($root);
    }
}