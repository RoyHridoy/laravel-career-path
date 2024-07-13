<?php
require_once "./vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\DashboardController;
use app\controllers\FeedbackController;
use app\controllers\RegisterController;
use app\core\Application;

try {
    $errorFilePointer = fopen( "error.txt", "a+" );

    $app = new Application( __DIR__ );

    // Routes
    $app->router->get( '/', 'home' );
    $app->router->get( '/login', [AuthController::class, 'index'] );
    $app->router->post( '/login', [AuthController::class, 'login'] );
    $app->router->post( '/logout', [AuthController::class, 'logout'] );

    $app->router->get( '/register', [RegisterController::class, 'index'] );
    $app->router->post( '/register', [RegisterController::class, 'store'] );

    $app->router->get( '/dashboard', [DashboardController::class, 'index'] );

    $app->router->get( '/feedback/{user}', [FeedbackController::class, 'index'] );
    $app->router->post( '/feedback', [FeedbackController::class, 'store'] );

    $app->run();
} catch ( Throwable $e ) {

    fwrite( $errorFilePointer, $e->getMessage() . " on line Number " . $e->getLine() . " on file " . $e->getFile() . " at " . date( "F j, Y, g:i a" . "\n\n" ) );
    echo "<pre>Something went wrong. See error.txt file or Contact with the Administrator</pre>";

} finally {
    fclose( $errorFilePointer );
}
