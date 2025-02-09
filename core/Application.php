<?php

namespace App\core;

use app\core\Controller;

class Application
{
    public static string $ROOT_PATH;
    public Router $Router;
    public Request $Request;
    public Response $Response;
    public $Controller;
    public static Application $app;

    public function __construct($path)
    {
        self::$ROOT_PATH = $path;
        self::$app = $this;
        $this->Request = new Request;
        $this->Response = new Response;
        $this->Router = new Router($this->Request, $this->Response);
    }


    public function run()
    {
        echo $this->Router->Resolve();
    }
}