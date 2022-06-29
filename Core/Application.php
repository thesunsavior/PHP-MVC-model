<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;
    public Respone $respone;
    public static string $ROOT_DIR;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->respone = new Respone();
        $this->router = new Router($this->request, $this->respone);
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
