<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function register(RegistrationRequest $request)
    {

        User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'type' => $request->type
        ]);

        return redirect()->route('login');
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('checkout.index');
        }

        return back()->with('status', 'Invalid login details');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
