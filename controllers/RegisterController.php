<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        $this->setLayout( "form" );
        return $this->view( "register", [
            'model' => new User,
        ] );
    }

    public function store( Request $request )
    {
        $user = new User;
        $this->setLayout( "form" );
        $user->loadData( $request->getBody() );

        if ( $user->validate() && $user->register() ) {
            Application::$app->session->flash( 'success', 'You have successfully create your account. Please log in and enjoy' );
            header( 'location: /login' );
            exit;
        }

        return $this->view( "register", [
            "model" => $user,
        ] );
    }
}
