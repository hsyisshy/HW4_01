<!-- resources/views/layouts/custom-auth.blade.php -->
<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', '登入')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="login-body">
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
