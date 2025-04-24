<!DOCTYPE html>
<html lang="ar" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>خدمات الإقامة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color:#EAE3D1 !important; /* لون الخلفية الأساسي */
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
            background-color:rgb(255, 255, 255) !important; /* لون الهيدر */
        }
        section#services {
            background-color: #EAE3D1; /* لون الخلفية لمنطقة الخدمات */
            padding: 40px 0;
            flex: 1;
        }
        .shadow-lg {
            background-color:rgb(255, 255, 255) !important; /* لون المربعات */
            text-align: center;
            border-radius: 10px;
            padding: 20px;
        }
        h3 {
            color: #2D1E0F !important; /* لون العناوين */
        }
        a {
            background-color: #2D1E0F !important; /* لون الأزرار */
            color: white !important;
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            border-radius: 8px;
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
    </style>
</head>
<body class="flex flex-col min-h-screen">
    <a href="{{ url('/') }}" class="back-button">
        <i class="fas fa-arrow-right"></i>
        رجوع للرئيسية
    </a>
    
    <header class="bg-white py-4 shadow">
        <div class="container mx-auto text-center">
            <img src="{{ asset('logo.png') }}" alt="شعار الحرس الأميري" class="mx-auto w-24">
            <nav>
                <ul class="flex justify-center space-x-4 mt-3">
                    <li><a href="{{ url('/') }}" class="text-[#2D1E0F] hover:text-[#3D2E1F] px-4 py-2 rounded-lg bg-white">الرئيسية</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-[#2D1E0F] hover:text-[#3D2E1F] px-4 py-2 rounded-lg bg-white">اتصل بنا</a></li>
                    <li><a href="{{ url('/login') }}" class="text-[#2D1E0F] hover:text-[#3D2E1F] px-4 py-2 rounded-lg bg-white">تسجيل الدخول</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        <section class="container mx-auto py-12 text-center">
            <h1 class="text-3xl font-bold text-gray-900">خدمات الإقامة</h1>
            <p class="mt-4 text-gray-700">
                خدمات الإقامة والتأشيرات الخاصة بالموظفين  
                يرجى التأكد من استيفاء جميع الشروط المطلوبة قبل تقديم الطلب
            </p>
        </section>

        <section class="container mx-auto py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">التأشيرة</h3>
                    <p class="text-gray-600 mb-4">خدمة طلب التأشيرة للموظفين</p>
                    <a href="{{ url('/residency/visa-request') }}" class="inline-block bg-[#2D1E0F] text-white px-6 py-3 rounded-lg hover:bg-[#3D2E1F] transition duration-300">
                        التأشيرة
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">نقل الكفالة</h3>
                    <p class="text-gray-600 mb-4">خدمة نقل الكفالة للموظفين</p>
                    <a href="{{ url('/residency/sponsorship-transfer') }}" class="inline-block bg-[#2D1E0F] text-white px-6 py-3 rounded-lg hover:bg-[#3D2E1F] transition duration-300">
                        نقل الكفالة
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">تجديد الإقامة</h3>
                    <p class="text-gray-600 mb-4">خدمة تجديد الإقامة للموظفين</p>
                    <a href="{{ url('/residency/renew-residency') }}" class="inline-block bg-[#2D1E0F] text-white px-6 py-3 rounded-lg hover:bg-[#3D2E1F] transition duration-300">
                        تجديد الإقامة
                    </a>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <h3 class="text-xl font-bold mb-4">الإقامة والهوية</h3>
                    <p class="text-gray-600 mb-4">خدمة طلب الإقامة والهوية للموظفين</p>
                    <a href="{{ url('/residency/residence-id') }}" class="inline-block bg-[#2D1E0F] text-white px-6 py-3 rounded-lg hover:bg-[#3D2E1F] transition duration-300">
                        الإقامة والهوية
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="mt-auto">
        <div class="footer-content">
            <p class="footer-text">&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
        </div>
    </footer>
</body>
</html>
