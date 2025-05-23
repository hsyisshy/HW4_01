

<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Threads 留言板')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="app-layout">
        <aside class="sidebar">
            <!-- Top Logo -->
            <div class="sidebar-top">
                <a href="{{ route('messages.index') }}"><img src="/icons/logo.png" alt="Threads Logo"
                        class="logo hover:scale-125 hover:duration-200 ease-in-out transition-all"></a>
            </div>

            <!-- Middle Main Navigation -->
            <div class="sidebar-middle">
                <a href="{{ route('messages.index') }}"><img class="w-[40px] h-fit xl:w-[35px]" src="/icons/home.svg"
                        alt="首頁"></a>
                <a href="#"><img class="w-[40px] h-fit xl:w-[35px]" src="/icons/search.svg" alt="搜尋"></a>
                <a href="{{ route('messages.create') }}"><img class="w-[40px] h-fit xl:w-[35px]" src="/icons/plus.svg"
                        alt="發文"></a>
                <a href="#"><img class="w-[40px] h-fit xl:w-[35px]" src="/icons/heart.svg" alt="喜歡"></a>
                <a href="{{ route('profile.show') }}"><img class="w-[40px] h-fit xl:w-[35px]" src="/icons/user.svg"
                        alt="個人"></a>
            </div>

            <!-- Bottom Additional Options -->
            <div class="sidebar-bottom">
                <a href="#"><img src="/icons/bell.svg" alt="通知" class="w-[40px] h-fit xl:w-[35px]"></a>
                <form method="POST" action="{{ route('logout') }}" class="icon-logout-form mb-0">
                    @csrf
                    <button type="submit" class="icon-button" title="登出">
                        <img src="/icons/menu.svg" alt="登出">
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content mb-[60px] md:mb-0 h-fit">
            @yield('content')
        </main>
    </div>
</body>

</html>
