<?php

namespace app\controllers;

use app\core\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return $this->view( "dashboard" );
    }
}
