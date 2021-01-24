<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        return view('dashboard.auth.login');
    }

    public function login_post(AdminLoginRequest $request)
    {
       $remember_me = $request->has('remember-me') ? true : false;

       $credentials = $request->only(['email', 'password']);

       if (auth()->guard('admin')->attempt($credentials, $remember_me)) {
            return redirect()->intended('admin');
       }

       return redirect()->back()->with(['error' => 'هناك خطأ في البيانات']);
    }
}
