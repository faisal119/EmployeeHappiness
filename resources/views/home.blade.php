<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>نظام إسعاد الموظفين - الحرس الأميري</title>
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

        .main-content {
            flex: 1;
        }

        .header {
            background-color: white;
            padding: 0.75rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        .logo {
            height: 50px;
            width: auto;
            margin-bottom: 0.5rem;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
            justify-content: center;
        }

        .nav-link {
            color: var(--primary-color);
            padding: 0.75rem;
            width: 90px;
            height: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            background-color: var(--background-color);
            border-radius: 12px;
            text-align: center;
            font-size: 0.9rem;
        }

        .nav-link i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .nav-link:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        .hero-section {
            background: linear-gradient(rgba(45, 30, 15, 0.7), rgba(45, 30, 15, 0.7));
            padding: 80px 20px 40px;
            text-align: center;
            color: white;
            margin-bottom: 2rem;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: white;
        }

        .hero-subtitle {
            font-size: 1.5rem;
            color: white;
            opacity: 0.9;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            padding: 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .service-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            text-align: center;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--background-color);
            border-radius: 50%;
        }

        .service-icon i {
            font-size: 2.5rem;
            color: var(--primary-color);
        }

        .service-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .service-description {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            line-height: 1.5;
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

        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        .page-title {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .page-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .whatsapp-button img {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            border-radius: 50%;
        }

        .services-title {
            text-align: center;
            margin: 2rem 0;
            position: relative;
            padding-bottom: 1rem;
        }

        .services-title h2 {
            color: var(--primary-color);
            font-size: 2.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
            font-family: "Noto Kufi Arabic", system-ui, -apple-system, sans-serif;
        }

        .services-title::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }

        @media (max-width: 768px) {
            .services-grid {
                grid-template-columns: 1fr;
                padding: 1rem;
                gap: 1rem;
            }

            .service-card {
                padding: 1.2rem;
                margin-bottom: 0.5rem;
            }

            .service-icon {
                width: 60px;
                height: 60px;
            }

            .service-icon i {
                font-size: 2rem;
            }

            .service-title {
                font-size: 1.2rem;
                margin: 0.5rem 0;
            }

            .service-description {
                font-size: 0.9rem;
                margin-bottom: 0.8rem;
            }

            .service-button {
                padding: 0.6rem 1.2rem;
                font-size: 0.9rem;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .page-subtitle {
                font-size: 1rem;
            }

            .hero-section {
                min-height: 300px;
                padding: 60px 15px 30px;
            }

            .whatsapp-button {
                bottom: 20px;
                right: 20px;
            }

            .whatsapp-button img {
                width: 50px;
                height: 50px;
            }

            .nav-links {
                gap: 0.5rem;
            }

            .nav-link {
                width: 80px;
                height: 80px;
                font-size: 0.8rem;
                padding: 0.5rem;
            }

            .nav-link i {
                font-size: 1.25rem;
            }

            .services-title h2 {
                font-size: 1.8rem;
            }
        }

        @media (max-width: 480px) {
            .service-icon {
                width: 50px;
                height: 50px;
            }

            .service-icon i {
                font-size: 1.8rem;
            }

            .service-card {
                padding: 1rem;
            }
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
                        <a href="{{ route('contact.show') }}" class="nav-link">
                            <i class="fas fa-envelope"></i>
                            اتصل بنا
                        </a>
                        <a href="{{ url('/admin/login') }}" class="nav-link">
                            <i class="fas fa-user-shield"></i>
                            دخول المشرف
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>

    <div class="main-content">
        <section class="hero-section">
            <h1 class="hero-title">القيادة العامة للحرس الأميري</h1>
            <p class="hero-subtitle">مرحباً بك في بوابة مركز السعادة</p>
        </section>

        <div class="services-title">
            <h2>الخدمات الذكية لمركز السعادة</h2>
        </div>

        <div class="services-grid">
            <!-- خدمات التأمين -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-heartbeat text-4xl text-primary"></i>
                </div>
                <h3 class="service-title">خدمات التأمين</h3>
                <p class="service-description">تقديم طلبات التأمين الصحي بسهولة</p>
                <a href="{{ url('/insurance') }}" class="service-button">عرض التفاصيل وطلب الخدمة</a>
            </div>

            <!-- خدمات الإقامة -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-id-card text-4xl text-primary"></i>
                </div>
                <h3 class="service-title">خدمات الإقامة</h3>
                <p class="service-description">خدمات الإقامة والتأشيرات الخاصة بالموظفين</p>
                <a href="{{ url('/residency') }}" class="service-button">عرض التفاصيل وطلب الخدمة</a>
            </div>

            <!-- بطاقات الخصم -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-percentage text-4xl text-primary"></i>
                </div>
                <h3 class="service-title">بطاقات الخصم</h3>
                <p class="service-description">احصل على بطاقة الخصم لمختلف الخدمات</p>
                <a href="{{ url('/discount-card') }}" class="service-button">عرض التفاصيل وطلب الخدمة</a>
            </div>

            <!-- الاقتراحات والملاحظات -->
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-comments text-4xl text-primary"></i>
                </div>
                <h3 class="service-title">الاقتراحات والملاحظات</h3>
                <p class="service-description">مشاركة اقتراحاتك لتحسين الخدمات</p>
                <a href="{{ route('suggestions.index') }}" class="service-button">عرض التفاصيل وتقديم اقتراح</a>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p class="mb-2">© {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>

    <!-- زر الواتساب -->
    <div class="whatsapp-button">
        <a href="https://wa.me/971565449090" target="_blank" rel="noopener noreferrer">
            <img src="/whatsapp-icon.png" alt="WhatsApp" style="width: 60px; height: 60px;">
        </a>
    </div>
</body>
</html>
