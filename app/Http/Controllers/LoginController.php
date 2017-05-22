<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $username = 'id';

    public function username()
    {
        return $this->username;
    }

    public function index()
    {
        return view('login');
    }

    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        }
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        return redirect()->route('login.index');
    }

    public function authenticate(Request $request)
    {
        // User ログイン
        Auth::guard('web');
        $this->validateLogin($request);
        $id = $request->input('id');
        $password = $request->input('password');
        if (Auth::attempt(['id' => $id, 'password' => $password])) {
            return redirect()->route('app');
        }

        // Admin ログイン
        Auth::guard('admin');
        $this->username = 'username';
        if (Auth::guard('admin')->attempt(['username' => $id, 'password' => $password])) {
            return redirect()->route('app');
        }

        return redirect()->back();
    }
}
