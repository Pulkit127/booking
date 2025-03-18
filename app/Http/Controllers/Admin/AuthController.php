<?php

namespace App\Http\Controllers\Admin;

use App\Events\SendResetLinkEmail;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['status'] = '1'; // Only allow active users

        if (Auth::attempt($credentials, $request->remember)) {
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        }
        return back()->with('error', 'Invalid credentials.');
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
        $request->validate(['email' => 'required|email|exists:users,email']);
        if ($user = User::where('email', $request->email)->first()) {
            event(new SendResetLinkEmail($user));
            return redirect()->route('login')->with('success', 'Password reset link sent to your email.');
        }
        return back()->with('error', 'No user found with this email.');   
    }

    public function resetPassword($resetlink)
    {
        return view('admin.auth.reset-password', compact('resetlink'));
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        if ($user = User::where('reset_link', $request->resetlink)->first()) {
            $user->update([
                'password' => Hash::make($request->password),
                'reset_link' => null
            ]);
            return redirect()->route('login')->with('success', 'Password reset successful!');
        }
        return back()->with('error', 'Invalid reset link.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');      
    }
}
