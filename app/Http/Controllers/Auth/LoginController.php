<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email', 'string'],
            'password' => ['required', 'string']
        ]);
        $remember = $request->filled('remember');
        if(Auth::attempt($credentials, $remember)){
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        throw ValidationException::withMessages([
            'credentials' => __('auth.failed')
        ]);   
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');

    }
}
