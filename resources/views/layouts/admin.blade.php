<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - الحرس الأميري</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #EAE3D1;
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #2D1E0F;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .header-logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-right: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .logout-button {
            background-color: #8F7B5D;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .logout-button:hover {
            background-color: #6B5B43;
        }

        footer {
            background-color: #8F7B5D;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            margin-right: 2rem;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            transition: background-color 0.2s;
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .nav-link.active {
            background-color: #8F7B5D;
        }
    </style>
</head>
<body>
    <header>
        <div class="flex items-center">
            <span class="header-title">لوحة التحكم</span>
            <nav class="nav-links">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">الرئيسية</a>
                <a href="{{ route('admin.requests') }}" class="nav-link {{ request()->routeIs('admin.requests') ? 'active' : '' }}">الطلبات</a>
                <a href="{{ route('admin.suggestions.index') }}" class="nav-link {{ request()->routeIs('admin.suggestions.*') ? 'active' : '' }}">الاقتراحات</a>
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">المشرفين</a>
                <a href="{{ route('admin.statistics') }}" class="nav-link {{ request()->routeIs('admin.statistics') ? 'active' : '' }}">الإحصائيات</a>
            </nav>
        </div>

        <div class="header-logo">
            <img src="/logo.png" alt="شعار الحرس الأميري">
        </div>

        <div class="user-info">
            <span class="user-name">{{ auth()->guard('admin')->user()->name }}</span>
            <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="logout-button">تسجيل خروج</button>
            </form>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>

    @stack('scripts')
</body>
</html> 