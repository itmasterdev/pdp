<?php

use Framework\Router;
use App\Controllers\HomeController;
use App\Controllers\UserController;

Router::get('/', [HomeController::class, 'index'])->name('home.index');
Router::get('/user', [UserController::class, 'index'])->name('user.index');
Router::get('/user/status/{id}/{status}', [UserController::class, 'show'])->name('user.show');