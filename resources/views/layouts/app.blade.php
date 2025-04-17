<!DOCTYPE html>
<html lang="zh-Hant">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Threads 留言板')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

<div class="app-layout">

<aside class="sidebar">

  <!-- Top Logo -->
  <div class="sidebar-top">
    <a href="#"><img src="/icons/logo.png" alt="Threads Logo" class="logo"></a>
  </div>

  <!-- Middle Main Navigation -->
  <div class="sidebar-middle">
    <a href="{{ route('messages.index') }}"><img src="/icons/home.svg" alt="首頁"></a>
    <a href="#"><img src="/icons/search.svg" alt="搜尋"></a>
    <a href="{{ route('messages.create') }}"><img src="/icons/plus.svg" alt="發文"></a>
    <a href="#"><img src="/icons/heart.svg" alt="喜歡"></a>
    <a href="{{ route('profile') }}"><img src="/icons/user.svg" alt="個人"></a>
  </div>

  <!-- Bottom Additional Options -->
  <div class="sidebar-bottom">
    <a href="#"><img src="/icons/bell.svg" alt="通知"></a>
    <a href="{{ route('login.ui') }}"><img src="/icons/menu.svg" alt="更多選項"></a>
  </div>

</aside>

<main class="main-content mb-[60px] md:mb-0 h-fit">
    @yield('content')
</main>
<div>

</body>
</html>


{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html> --}}

