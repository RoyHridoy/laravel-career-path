<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
require_once "./vendor/autoload.php";


use app\controllers\DashboardController;
use app\controllers\LoginController;
use app\controllers\RegisterController;
use app\core\Application;

$app = new Application( __DIR__ );

$app->router->get( '/', 'home' );
$app->router->get( '/login', [LoginController::class, 'index'] );
$app->router->get( '/register', [RegisterController::class, 'index'] );
$app->router->post( '/register', [RegisterController::class, 'store'] );
$app->router->get( '/dashboard', [DashboardController::class, 'index'] );
$app->router->get( '/feedback/id', function () {
    echo "Feedback Page";
} );
// TODO: Feedback submission


$app->run();
