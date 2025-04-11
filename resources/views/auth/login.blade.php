<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>登入 Threads</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">
    <div class="login-container">
        <h1>登入 Threads</h1>
        <form method="POST" action="#">
            {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="密碼" required>
            <button type="submit">登入</button>
        </form>
        <p class="signup-link">還沒有帳號嗎？<a href="#">註冊</a></p>
    </div>
</body>
</html>
