@extends('layouts.custom-auth')

@section('title', '登入 Threads')

@section('content')
    <div class="login-container">
        <h1>登入 Threads</h1>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autofocus>
            <input type="password" name="password" placeholder="密碼" required>
            <button type="submit">登入</button>
        </form>
        <p class="signup-link">還沒有帳號嗎？<a href="{{ route('register') }}">註冊</a></p>
    </div>
@endsection
