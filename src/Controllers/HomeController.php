<?php

namespace App\Controllers;

use Framework\Controller;
use Framework\View;

class HomeController extends Controller
{
    public function index()
    {
        return View::render('home.index');
    }
}