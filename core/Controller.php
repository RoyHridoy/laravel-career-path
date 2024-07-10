<?php

namespace app\core;

class Controller
{
    public function view( string $view, array $params = [] )
    {
        return Application::$app->router->renderView( $view, $params );
    }
}
