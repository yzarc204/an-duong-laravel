<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        if ($request->isMethod('GET')) {
            return view('auth.register');
        }

        $userData = array_merge($request->validated(), [
            'password' => bcrypt($request->password)
        ]);
        User::create($userData);

        return redirect()->route('login')->with('message', 'Đăng ký thành công!');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('auth.login');
        }

        $payload = $request->only('email', 'password');
        if (Auth::attempt($payload)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('message', 'Email hoặc mật khẩu không chính xác!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
