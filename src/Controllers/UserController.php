<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\View;

class UserController extends Controller
{
    public function index()
    {
        return 'INdex';
        //return 'User ID: ' . $id;
    }

    public function show(int $id, int $status)
    {
        return View::render('user.show', compact('id', 'status'));
    }
}