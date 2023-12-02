<?php

namespace App\Controllers;

use Framework\Request;

class UserController
{
    public function index(Request $request)
    {
        return 'INdex';
        //return 'User ID: ' . $id;
    }

    public function show()
    {
        return 'Show';
    }
}