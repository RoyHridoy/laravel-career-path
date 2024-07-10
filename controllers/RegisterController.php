<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->view( "register" );
    }

    public function store( Request $request )
    {
        $user = new User;
        $user->loadData( $request->getBody() );
        $user->validate();

        // if ( $user->validate() && $user->register() ) {
        //     return "Success";
        // }

        return $this->view( "register", [
            "model" => $user,
        ] );

    }
}
