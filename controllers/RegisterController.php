<?php

namespace app\controllers;

use app\core\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        return $this->view( "register" );
    }
}
