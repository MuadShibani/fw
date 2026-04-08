<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | Wathba</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-page">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <span class="logo-arabic">وثبة</span>
                <span class="logo-english">wathba</span>
            </div>
            <h1>Admin Panel</h1>
            <p>Sign in to manage the platform</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="/admin/login" method="POST" class="login-form">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="{{ old('username') }}"
                       class="form-input" placeholder="admin" required autofocus>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password"
                       class="form-input" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-primary btn-full">Sign In</button>
        </form>
        <div class="login-footer">
            <a href="/" target="_blank">← Back to Website</a>
        </div>
    </div>
</body>
</html>
