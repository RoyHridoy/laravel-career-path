<?php

namespace app\core;

class Application
{
    public static string $ROOT_PATH;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    // public Controller $controller;

    public function __construct( string $rootPath )
    {
        self::$ROOT_PATH  = $rootPath;
        $this->request    = new Request;
        $this->response   = new Response;
        // $this->controller = new Controller;
        $this->router     = new Router( $this->request, $this->response );
        self::$app        = $this;
    }

    public function run()
    {
        echo $this->router->resolve();
    }
}
