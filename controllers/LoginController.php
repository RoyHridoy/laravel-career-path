<?php

namespace app\controllers;

use app\core\Controller;

class LoginController extends Controller
{
    public function index()
    {
        return $this->view( "login" );
    }

    public function login()
    {

    }
}
