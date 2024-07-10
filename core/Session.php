<?php

namespace app\core;

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function flash( $key, $message = null )
    {
        if ( $message ) {
            $_SESSION['flash'][$key] = $message;
        } else if ( isset( $_SESSION['flash'][$key] ) ) {
            $message = $_SESSION['flash'][$key];
            unset( $_SESSION['flash'][$key] );
            return $message;
        }
    }
}
