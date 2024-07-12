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

    public function requireAuth()
    {
        if ( !isset( $_SESSION['user'] ) ) {
            header( "Location: login" );
            exit;
        }
    }

    public function destroySession()
    {
        unset( $_SESSION );
        session_destroy();
        header( 'location: /' );
        exit;
    }

    public function isAuthenticatedUser(): bool
    {
        return isset( $_SESSION['user'] );
    }
}
