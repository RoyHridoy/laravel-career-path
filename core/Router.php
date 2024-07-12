<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    private array $routes  = [];
    private string $layout = 'main';
    private string $model  = '';

    public function __construct( Request $request, Response $response )
    {
        $this->request  = $request;
        $this->response = $response;
    }

    public function get( string $path, array | string | callable $callback ): void
    {
        $this->routes['get'][$path] = $callback;
        $this->modelBindings();
    }

    private function modelBindings(): void
    {
        $requestedPath = $this->request->getPath();
        foreach ( $this->routes['get'] as $key => $value ) {
            $openCurlyPosition = strpos( $key, "{" );
            if ( $openCurlyPosition === false ) {
                continue;
            }
            $routeFirstPart = substr( $key, 0, $openCurlyPosition );
            if ( !str_starts_with( $requestedPath, $routeFirstPart ) ) {
                continue;
            }
            $requestUrlId = str_replace( $routeFirstPart, "", $requestedPath );
            $isValidId    = strpos( $requestUrlId, "/" ) === false;
            if ( $isValidId ) {
                $key                       = $routeFirstPart . $requestUrlId;
                $this->routes['get'][$key] = $value;
                $this->model               = $requestUrlId;
            }
        }
    }

    public function post( string $path, array | string | callable $callback ): void
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method        = $this->request->method();
        $requestedPath = $this->request->getPath();
        $callback      = $this->routes[$method][$requestedPath] ?? false;

        if ( $callback === false ) {
            $this->response->setResponseCode( 404 );
            return $this->renderView( "_404" );
        }
        if ( is_string( $callback ) ) {
            return $this->renderView( $callback );
        }
        if ( is_array( $callback ) ) {
            $callback[0] = new $callback[0];
        }

        return call_user_func( $callback, $this->request, $this->model );
    }

    public function renderView( string $view, array $params = [] )
    {
        $layout  = $this->loadLayout();
        $content = $this->viewContent( $view, $params );
        return str_replace( "{{content}}", $content, $layout );
    }
    public function setLayout( string $view ): void
    {
        $this->layout = $view;
    }

    private function viewContent( string $view, array $params = [] )
    {
        foreach ( $params as $key => $value ) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_PATH . "/view/{$view}.view.php";
        return ob_get_clean();
    }

    private function loadLayout()
    {
        ob_start();
        include_once Application::$ROOT_PATH . "/view/layouts/{$this->layout}.view.php";
        return ob_get_clean();
    }
}
