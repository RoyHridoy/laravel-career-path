<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\Models\User;

class FeedbackController extends Controller
{
    public function index( Request $request, $uniqueId )
    {
        $user           = new User;
        $feedbackToUser = $user->getUserByColumnName( $uniqueId, 'uniqueId' );
        if ( !$feedbackToUser ) {
            return $this->view( "_404" );
        }

        return $this->view( "feedback", [
            'name'     => $feedbackToUser["name"],
            'uniqueId' => $feedbackToUser["uniqueId"],
        ] );

    }
}
