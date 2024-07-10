<?php
require_once "./vendor/autoload.php";

use app\controllers\DashboardController;
use app\controllers\LoginController;
use app\controllers\RegisterController;
use app\core\Application;

$app = new Application( __DIR__ );

$app->router->get( '/', 'home' );
$app->router->get( '/login', [LoginController::class, 'index'] );
$app->router->get( '/register', [RegisterController::class, 'index'] );
$app->router->get( '/dashboard', [DashboardController::class, 'index'] );
$app->router->get( '/feedback/id', function () {
    echo "Feedback Page";
} );
// TODO: Feedback submission

$app->router->post( '/register', function () {
    echo "Register form handled here";
} );

$app->run();
