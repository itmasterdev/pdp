<?php

use Framework\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

Router::get('/', [HomeController::class, 'index']);
Router::get('/user/show', [UserController::class, 'show']);


/*$router->get('/', [HomeController::class, 'index']);
$router->get('/user/show', [UserController::class, 'show']);*/
//$router->get('/user/{id}', [UserController::class, 'index']);
