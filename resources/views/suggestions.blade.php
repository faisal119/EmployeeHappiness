<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاقتراحات والملاحظات</title>
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
        button[type="submit"] {
            background-color: #2D1E0F !important;
            min-width: 200px;
        }
        input:focus, textarea:focus {
            border-color: #2D1E0F !important;
            ring-color: #2D1E0F !important;
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
            <h1 class="text-3xl font-bold text-gray-900 mb-4">الاقتراحات والملاحظات</h1>
            <p class="text-gray-700 mb-8">
                يمكنك تقديم اقتراحاتك وملاحظاتك من خلال النموذج التالي
            </p>
        </section>

        <section class="container mx-auto pb-12">
            <div class="max-w-3xl mx-auto">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('suggestions.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">الاسم الكامل</label>
                                <input type="text" name="name" id="name" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2D1E0F]"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                                <input type="email" name="email" id="email" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2D1E0F]"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">رقم الهاتف</label>
                                <input type="tel" name="phone" id="phone"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2D1E0F]"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="military_number" class="block text-sm font-medium text-gray-700 mb-2">الرقم العسكري</label>
                                <input type="text" name="military_number" id="military_number"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2D1E0F]"
                                    value="{{ old('military_number') }}">
                                @error('military_number')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="suggestion" class="block text-sm font-medium text-gray-700 mb-2">الاقتراح أو الملاحظة</label>
                            <textarea name="suggestion" id="suggestion" rows="5" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[#2D1E0F]">{{ old('suggestion') }}</textarea>
                            @error('suggestion')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-center mt-8">
                            <button type="submit"
                                class="bg-[#2D1E0F] text-white px-8 py-3 rounded-md hover:bg-[#4B2E1A] focus:outline-none focus:ring-2 focus:ring-[#2D1E0F] focus:ring-offset-2 transition-colors duration-200 text-lg font-semibold">
                                إرسال الاقتراح
                            </button>
                        </div>
                    </form>
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