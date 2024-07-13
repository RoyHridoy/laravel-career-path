<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        if ( $this->isAuthenticated() ) {
            header( 'location: /dashboard' );
            exit;
        }
        $this->setLayout( "form" );
        return $this->view( "login", [
            "model" => new User,
        ] );
    }

    public function login( Request $request )
    {
        ['email' => $email, 'password' => $password] = $request->getBody();

        $user          = new User;
        $existingUsers = $user->getAllByColumnName( 'email' );

        if ( !in_array( $email, $existingUsers, true ) ) {
            Application::$app->session->flash( 'error', 'Username or password incorrect' );
            header( 'location: login' );
            exit;
        }

        $user = $user->getUserByColumnName( $email, "email" );

        if ( !password_verify( $password, $user['password'] ) ) {
            Application::$app->session->flash( 'error', 'Username or password incorrect' );
            header( 'location: login' );
            exit;
        }

        $_SESSION['user'] = $user['uniqueId'];
        header( 'location: /dashboard' );
        exit;
    }

    public function logout()
    {
        Application::$app->session->destroySession();
    }
}
