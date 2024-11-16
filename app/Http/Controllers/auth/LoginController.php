<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function show() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        if (isset($request->validator) && $request->validator->fails()) {
            return back()->withErrors([
                'error' => $request->validator->errors()->first(),
            ])->withInput($request->except('password'));
        }

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $defaultRedirect = redirect()->intended('home');
            // testing role validation
            if (Auth::user()->role_id === UserRole::ROLE_ADMIN) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else if (Auth::user()->role_id === UserRole::ROLE_USER) {
                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            }

            return $defaultRedirect;
        }

        return back()->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }
}
