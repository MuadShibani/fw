<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') | Wathba Admin</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @stack('styles')
</head>
<body class="admin-body">

@if (!session('admin_authenticated'))
    {{-- Login page --}}
    @yield('content')
@else
    <div class="admin-wrapper">

        {{-- Sidebar --}}
        <aside class="admin-sidebar" id="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-logo-ar">وثبة</span>
                <span class="sidebar-logo-en">Admin</span>
            </div>

            <nav class="sidebar-nav">
                <a href="/admin/dashboard" class="sidebar-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <span class="sidebar-icon">⊞</span> Dashboard
                </a>
                <div class="sidebar-section-label">Content</div>
                <a href="/admin/hero"     class="sidebar-link {{ request()->is('admin/hero*')    ? 'active' : '' }}"><span class="sidebar-icon">🎞</span> Hero Slides</a>
                <a href="/admin/news"     class="sidebar-link {{ request()->is('admin/news*')    ? 'active' : '' }}"><span class="sidebar-icon">📰</span> News</a>
                <a href="/admin/blog"     class="sidebar-link {{ request()->is('admin/blog*')    ? 'active' : '' }}"><span class="sidebar-icon">✍️</span> Blog</a>
                <a href="/admin/events"   class="sidebar-link {{ request()->is('admin/events*')  ? 'active' : '' }}"><span class="sidebar-icon">📅</span> Events</a>
                <a href="/admin/library"  class="sidebar-link {{ request()->is('admin/library*') ? 'active' : '' }}"><span class="sidebar-icon">📁</span> Library</a>
                <div class="sidebar-section-label">Programs</div>
                <a href="/admin/accelerator" class="sidebar-link {{ request()->is('admin/accelerator*') ? 'active' : '' }}"><span class="sidebar-icon">🚀</span> Accelerator</a>
                <a href="/admin/yain"        class="sidebar-link {{ request()->is('admin/yain*')        ? 'active' : '' }}"><span class="sidebar-icon">👥</span> YAIN</a>
                <a href="/admin/wiif"        class="sidebar-link {{ request()->is('admin/wiif*')        ? 'active' : '' }}"><span class="sidebar-icon">📊</span> WIIF</a>
                <a href="/admin/sil"         class="sidebar-link {{ request()->is('admin/sil*')         ? 'active' : '' }}"><span class="sidebar-icon">💡</span> SIL</a>
                <div class="sidebar-section-label">System</div>
                <a href="/admin/pages"    class="sidebar-link {{ request()->is('admin/pages*')   ? 'active' : '' }}"><span class="sidebar-icon">📄</span> Pages</a>
                <a href="/admin/messages" class="sidebar-link {{ request()->is('admin/messages*')? 'active' : '' }}">
                    <span class="sidebar-icon">✉️</span> Messages
                    @php $unread = \App\Models\Message::where('is_read', false)->count(); @endphp
                    @if ($unread > 0)
                        <span class="badge-count">{{ $unread }}</span>
                    @endif
                </a>
                <a href="/admin/settings" class="sidebar-link {{ request()->is('admin/settings*')? 'active' : '' }}"><span class="sidebar-icon">⚙️</span> Settings</a>
            </nav>

            <div class="sidebar-footer">
                <a href="/" class="sidebar-link" target="_blank"><span class="sidebar-icon">🌐</span> View Site</a>
                <form action="/admin/logout" method="POST">
                    @csrf
                    <button type="submit" class="sidebar-link sidebar-logout">
                        <span class="sidebar-icon">⏏</span> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="admin-main">
            <header class="admin-topbar">
                <button class="sidebar-toggle" id="sidebarToggle">☰</button>
                <h1 class="admin-page-title">@yield('page-title', 'Dashboard')</h1>
                <div class="admin-topbar-right">
                    <span class="admin-user">👤 {{ session('admin_user', 'Admin') }}</span>
                </div>
            </header>

            @if (session('success'))
                <div class="alert alert-success">✅ {{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-error">❌ {{ session('error') }}</div>
            @endif

            <div class="admin-content">
                @yield('content')
            </div>
        </div>
    </div>
@endif

<script src="{{ asset('js/admin.js') }}"></script>
@stack('scripts')
</body>
</html>
