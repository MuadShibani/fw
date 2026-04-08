<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ session('lang', 'en') === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Wathba Platform') | وثبة</title>
    <meta name="description" content="@yield('description', 'Wathba – Empowering Yemen\'s Entrepreneurial Ecosystem')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+Arabic:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')
</head>
<body class="bg-cream text-brown {{ session('lang', 'en') === 'ar' ? 'font-arabic' : 'font-sans' }}">

    {{-- Top Bar --}}
    <div class="top-bar hidden md:block">
        <div class="container">
            <div class="top-bar-inner">
                <div class="top-bar-contact">
                    <span>📞 +967 1 234 567</span>
                    <span>✉️ info@wathba.ye</span>
                </div>
                <div class="top-bar-social">
                    <a href="#" aria-label="Facebook">&#xfb;</a>
                    <a href="#" aria-label="Twitter">&#x74;</a>
                    <a href="#" aria-label="LinkedIn">&#x69;n</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    @include('layouts.navbar')

    {{-- Main --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('layouts.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>
