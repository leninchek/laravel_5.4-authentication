<?php

namespace App\Http\Controllers\AdminAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    protected $redirectTo = '/admin/home';
    
    use AuthenticatesUsers;
    
    //Guard para Admin
    protected function guard()
    {
        return Auth::guard('web_admin');
    }
    
    public function showLoginForm()
    {
       return view('admin.auth.login');
    }
    
    public function logout(Request $request) {
    Auth::guard('web_admin')->logout();
    $request->session()->flush();
    $request->session()->regenerate();
    return view('admin.auth.login');
    }
}
