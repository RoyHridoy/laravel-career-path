<?php
ini_set( 'display_errors', '1' );
ini_set( 'error_reporting', E_ALL );
require_once "./vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\DashboardController;
use app\controllers\FeedbackController;
use app\controllers\RegisterController;
use app\core\Application;

$app = new Application( __DIR__ );

$app->router->get( '/', 'home' );
$app->router->get( '/login', [AuthController::class, 'index'] );
$app->router->post( '/login', [AuthController::class, 'login'] );
$app->router->post( '/logout', [AuthController::class, 'logout'] );
$app->router->get( '/register', [RegisterController::class, 'index'] );
$app->router->post( '/register', [RegisterController::class, 'store'] );
$app->router->get( '/dashboard', [DashboardController::class, 'index'] );
$app->router->get( '/feedback/{user}', [FeedbackController::class, 'index'] );
$app->router->get( '/post/{id}', [FeedbackController::class, 'index'] );
// TODO: Feedback submission

$app->run();
