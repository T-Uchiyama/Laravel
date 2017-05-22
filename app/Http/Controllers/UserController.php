<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.check.user');
    }

    public function index()
    {
        return 'UserPage!';
    }
}
