<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }
        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function loginPage()
    {
        return view('admin.auth.login');
    }

    public function registerPage()
    {
        return view('admin.auth.register');
    }

    public function register(Request $request)
    {
        return view('admin.auth.register');
    }

    public function forgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        return view('admin.auth.forgot-password');
    }

    public function resetPassword()
    {
        return view('admin.auth.reset-password');
    }

    public function logout()
    {
        return redirect()->route('admin.auth.login');
    }
}
