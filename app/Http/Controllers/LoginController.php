<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 顯示登入頁
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 顯示註冊頁
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 處理登入邏輯
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ✅ 登入成功後一律導向 /messages
            return redirect()->intended('/messages');
        }

        return back()->with('error', '帳號或密碼錯誤');
    }

    // 處理登出
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
