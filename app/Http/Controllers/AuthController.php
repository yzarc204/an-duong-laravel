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

        $userData = $request->validated();
        $userData['password'] = bcrypt($userData['password']);
        User::create($userData);

        return redirect()->back()->with('message', 'Đăng ký thành công!');
    }

    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('auth.login');
        }

        $payload = $request->only('email', 'password');
        if (Auth::attempt($payload)) {
            return view('home');
        }

        return redirect()->back()->with('message', 'Email hoặc mật khẩu không chính xác!');
    }
}
