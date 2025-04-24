<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>خدمات الإقامة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2D1E0F;
            --secondary-color: #8F7B5D;
            --background-color: #EAE3D1;
        }
        
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-family: system-ui, -apple-system, sans-serif;
            background-color: var(--background-color);
        }

        .header {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
            justify-content: center;
        }

        .nav-link {
            color: var(--primary-color);
            padding: 1rem;
            width: 120px;
            height: 120px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: white;
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            text-align: center;
        }

        .nav-link i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .nav-link:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-5px);
        }

        .service-card {
            background-color: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin: 1rem;
            flex: 1;
            min-width: 250px;
            max-width: 300px;
            transition: transform 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: inline-block;
        }

        .service-button:hover {
            background-color: #3D2E1F;
        }

        @media (max-width: 768px) {
            .nav-links {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                gap: 1rem;
            }

            .nav-link {
                width: 100px;
                height: 100px;
                font-size: 0.9rem;
            }

            .service-card {
                min-width: 100%;
                margin: 0.5rem 0;
            }
        }

        .main-content {
            margin-top: 200px;
            padding: 1rem;
        }

        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container mx-auto">
            <div class="flex flex-col items-center">
                <img src="/logo.png" alt="شعار الحرس الأميري" class="h-16 w-auto">
                <nav class="mt-4">
                    <div class="nav-links">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            الرئيسية
                        </a>
                        <a href="{{ url('/contact') }}" class="nav-link">
                            <i class="fas fa-envelope"></i>
                            اتصل بنا
                        </a>
                        <a href="{{ url('/login') }}" class="nav-link">
                            <i class="fas fa-user"></i>
                            تسجيل الدخول
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="main-content">
        <h1 class="text-2xl md:text-3xl font-bold text-center mb-2">خدمات الإقامة</h1>
        <p class="text-center text-gray-600 mb-8 px-4">خدمات الإقامة والتأشيرات الخاصة بالموظفين يرجى التأكد من استيفاء جميع الشروط المطلوبة قبل تقديم الطلب</p>

        <div class="flex flex-wrap justify-center items-stretch gap-4">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-passport text-4xl text-primary"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">التأشيرة</h3>
                <p class="text-gray-600 mb-4">خدمة طلب التأشيرة للموظفين</p>
                <a href="{{ url('/residency/visa-request') }}" class="service-button">طلب التأشيرة</a>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-exchange-alt text-4xl text-primary"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">نقل الكفالة</h3>
                <p class="text-gray-600 mb-4">خدمة نقل الكفالة للموظفين</p>
                <a href="{{ url('/residency/sponsorship') }}" class="service-button">نقل الكفالة</a>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-sync text-4xl text-primary"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">تجديد الإقامة</h3>
                <p class="text-gray-600 mb-4">خدمة تجديد الإقامة للموظفين</p>
                <a href="{{ url('/residency/renewal') }}" class="service-button">تجديد الإقامة</a>
            </div>

            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-id-card text-4xl text-primary"></i>
                </div>
                <h3 class="text-xl font-bold mb-3">الإقامة والهوية</h3>
                <p class="text-gray-600 mb-4">خدمة طلب الإقامة والهوية للموظفين</p>
                <a href="{{ url('/residency/residence-id') }}" class="service-button">طلب الإقامة والهوية</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p class="mb-2">© {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html> 