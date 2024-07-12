<?php

namespace app\core;

class Controller
{
    public function view( string $view, array $params = [] )
    {
        return Application::$app->router->renderView( $view, $params );
    }

    public function setLayout( string $view )
    {
        Application::$app->router->setLayout( $view );
    }

    public function auth()
    {
        Application::$app->session->requireAuth();
    }

    public function isAuthenticated()
    {
        return Application::$app->session->isAuthenticatedUser();
    }
}
