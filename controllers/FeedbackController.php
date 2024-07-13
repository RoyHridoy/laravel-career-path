<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\Models\Feedback;
use app\Models\User;

class FeedbackController extends Controller
{
    public function index( Request $request, $uniqueId )
    {
        if ( isset( $_SESSION['user'] ) && $uniqueId === $_SESSION['user'] ) {
            $this->setLayout( "auth" );
            return $this->view( "info", [
                "info" => "Sorry! You can't send yourself feedback.",
            ] );
        }

        $user = new User;
        $userReceivedFeedback = $user->getUserByColumnName( $uniqueId, 'uniqueId' );

        if ( !$userReceivedFeedback ) {
            Application::$app->response->setResponseCode( 404 );
            return $this->view( "_404" );
        }

        return $this->view( "feedback", [
            'name'     => $userReceivedFeedback["name"],
            'uniqueId' => $userReceivedFeedback["uniqueId"],
        ] );
    }

    public function store( Request $request )
    {
        $feedback = new Feedback;
        $feedback->loadData( $request->getBody() );

        if ( $feedback->validate() && $feedback->send() ) {
            if ( $this->isAuthenticated() ) {
                $this->setLayout( "auth" );
            }
            return $this->view( "feedback-success" );
        }
    }
}
