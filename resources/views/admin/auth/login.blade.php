<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل دخول الإدارة</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2D1E0F;
            --secondary-color: #8F7B5D;
            --background-color: #EAE3D1;
        }

        body {
            background-color: var(--background-color);
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: white;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .logo {
            max-width: 200px;
            height: auto;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: var(--primary-color);
            text-align: center;
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .subtitle {
            color: var(--secondary-color);
            text-align: center;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .error-message {
            background-color: #FEE2E2;
            color: #DC2626;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .success-message {
            background-color: #ECFDF5;
            color: #059669;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: var(--primary-color);
            margin-bottom: 8px;
            font-weight: 500;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #DDD;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
            transition: border-color 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--secondary-color);
        }

        button {
            width: 100%;
            background-color: var(--primary-color);
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-family: 'Tajawal', sans-serif;
        }

        button:hover {
            background-color: #4B2E1A;
        }

        .back-link {
            display: inline-block;
            color: var(--primary-color);
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: var(--secondary-color);
        }

        .forgot-password {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: var(--secondary-color);
            text-decoration: none;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 1rem;
            }
            
            .container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="/logo.png" alt="شعار الحرس الأميري" class="logo">
    </header>

    <div class="main-content">
        <div class="container">
            <a href="{{ url('/') }}" class="back-link">
                < العودة للرئيسية
            </a>

            <h2>تسجيل الدخول</h2>
            <div class="subtitle">الدخول مخصص للمخولين فقط</div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/admin/login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">البريد الإلكتروني</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                </div>
                
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">تسجيل الدخول</button>

                <a href="{{ route('admin.password.request') }}" class="forgot-password">
                    نسيت كلمة المرور؟
                </a>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p class="mb-2">© {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html>
