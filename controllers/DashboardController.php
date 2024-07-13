<?php

namespace app\controllers;

use app\core\Controller;
use app\Models\Message;
use app\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $this->auth();
        $this->setLayout( "auth" );
        $user = new User;
        $user = $user->getUserByColumnName( $_SESSION['user'], 'uniqueId' );
        $message = new Message;

        return $this->view( "dashboard", [
            'name'     => $user['name'],
            'uniqueId' => $user['uniqueId'],
            'messages' => $message->getAllMessagesByUser( $user["uniqueId"] ),
        ] );
    }
}
