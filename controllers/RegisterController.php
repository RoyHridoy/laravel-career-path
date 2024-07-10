<?php

namespace app\controllers;

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
        $user->loadData( $request->getBody() );

        if ( $user->validate() && $user->register() ) {
            // TODO show flash message
            return $this->view( "login" );
        }

        $this->setLayout( "form" );
        return $this->view( "register", [
            "model" => $user,
        ] );
    }
}
