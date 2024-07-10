<?php

namespace app\core;

class Request
{
    public function method()
    {
        return strtolower( $_SERVER['REQUEST_METHOD'] );
    }

    public function getPath()
    {
        $path     = $_SERVER["REQUEST_URI"] ?? "/";
        $position = strpos( $path, "?" );
        if ( $position === false ) {
            return $path;
        }
        return substr( $path, 0, $position );
    }

    public function getBody()
    {
        $body = [];
        if ( $this->isGet() ) {
            foreach ( $_GET as $key => $value ) {
                $body[$key] = htmlspecialchars( $value );
            }
        }
        if ( $this->isPost() ) {
            foreach ( $_POST as $key => $value ) {
                $body[$key] = htmlspecialchars( $value );
            }
        }
        return $body;
    }

    private function isGet()
    {
        return $this->method() === 'get';
    }

    private function isPost()
    {
        return $this->method() === 'post';
    }

}
