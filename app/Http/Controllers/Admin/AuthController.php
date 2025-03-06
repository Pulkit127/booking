<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
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

    public function register(RegisterRequest $request)
    {
        $user = User::create($request->validated());    
        Auth::login($user); 
        return redirect()->route('dashboard')->with('success', 'Account created successfully!');
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
        Auth::logout();
        return redirect()->route('login');      
    }
}
