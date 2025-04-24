<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمة التأمين الصحي</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color:#EAE3D1 !important;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        header {
            background-color:rgb(255, 255, 255) !important;
        }
        .shadow-lg {
            background-color:rgb(255, 255, 255) !important;
            text-align: center;
            border-radius: 10px;
            padding: 20px;
        }
        h3 {
            color: #2D1E0F !important;
        }
        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #2D1E0F;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 10;
        }
        .back-button:hover {
            background-color: #4B2E1A;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        footer {
            background-color: #8F7B5D;
            width: 100%;
            padding: 1.5rem 0;
            margin-top: auto;
            border-top: 2px solid #2D1E0F;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .footer-text {
            color: white;
            font-size: 1rem;
            text-align: center;
            line-height: 1.5;
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
            padding: 0;
            list-style: none;
        }
        .nav-link {
            background-color: #2D1E0F !important;
            color: white !important;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 120px;
            text-align: center;
            border: 2px solid #2D1E0F;
        }
        .nav-link:hover {
            background-color: #4B2E1A !important;
            transform: translateY(-2px);
        }
        .service-link {
            background-color: #2D1E0F !important;
            color: white !important;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: block;
            margin-top: 0.5rem;
        }
        .service-link:hover {
            background-color: #4B2E1A !important;
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <a href="{{ url('/') }}" class="back-button">
        <i class="fas fa-arrow-right"></i>
        رجوع للرئيسية
    </a>

    <header class="bg-white py-4 shadow">
        <div class="container mx-auto text-center">
            <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto w-24">
            <nav>
                <ul class="nav-links">
                    <li><a href="{{ url('/') }}" class="nav-link">الرئيسية</a></li>
                    <li><a href="{{ route('contact.show') }}" class="nav-link">اتصل بنا</a></li>
                    <li><a href="{{ route('admin.login') }}" class="nav-link">تسجيل الدخول</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        <section class="container mx-auto py-12 text-center">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">خدمة التأمين الصحي</h1>
            <p class="text-gray-700 mb-8">
                تتيح هذه الخدمة للموظفين إمكانية التقديم على التأمين الصحي والاستفادة من المزايا المقدمة. 
                يرجى التأكد من استيفاء جميع الشروط المطلوبة قبل تقديم الطلب.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">طلب تأمين جديد</h3>
                    <p class="text-gray-600 mb-4">طلب تأمين صحي جديد للموظفين</p>
                    <a href="{{ route('insurance.add-new') }}" class="service-link">
                        تقديم طلب جديد
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">إضافة عائلة</h3>
                    <p class="text-gray-600 mb-4">إضافة الزوجة أو الأبناء أو الوالدين</p>
                    <a href="{{ route('insurance.add-spouse') }}" class="service-link">إضافة زوج/زوجة</a>
                    <a href="{{ route('insurance.add-children') }}" class="service-link">إضافة أبناء</a>
                    <a href="{{ route('insurance.add-parents') }}" class="service-link">إضافة والدين</a>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">تحديث بيانات</h3>
                    <p class="text-gray-600 mb-4">تعديل بيانات التأمين الحالية</p>
                    <a href="{{ route('insurance.update') }}" class="service-link">
                        تحديث البيانات
                    </a>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">طلب شهادة تأمين</h3>
                    <p class="text-gray-600 mb-4">استخراج شهادة تأمين صحي</p>
                    <a href="{{ route('insurance.certificate') }}" class="service-link">
                        طلب شهادة
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <p class="footer-text">&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
        </div>
    </footer>
</body>
</html>
