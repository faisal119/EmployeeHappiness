<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب الإقامة والهوية</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color:#EAE3D1 !important;
            text-align: center;
        }
        .container {
            max-width: 900px;
            margin: auto;
        }
        header {
            background-color:rgb(255, 255, 255) !important;
        }
        .form-container {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        header img {
            max-width: 200px;
            height: auto;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white py-4 shadow">
        <div class="container mx-auto text-center">
            <div class="flex justify-center mb-4">
                <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto">
            </div>
            <nav class="mt-4">
                <ul class="flex justify-center gap-4 mt-3">
                    <li><a href="{{ url('/') }}" class="block px-6 py-2 bg-[#EAE3D1] text-[#2D1E0F] rounded hover:bg-[#2D1E0F] hover:text-white transition duration-300">الرئيسية</a></li>
                    <li><a href="{{ url('/residency') }}" class="block px-6 py-2 bg-[#EAE3D1] text-[#2D1E0F] rounded hover:bg-[#2D1E0F] hover:text-white transition duration-300">خدمات الإقامة</a></li>
                    <li><a href="{{ url('/contact') }}" class="block px-6 py-2 bg-[#EAE3D1] text-[#2D1E0F] rounded hover:bg-[#2D1E0F] hover:text-white transition duration-300">اتصل بنا</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="container mx-auto py-12">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">طلب الإقامة والهوية</h1>
            <a href="{{ url('/residency') }}" class="flex items-center gap-2 px-6 py-2 text-lg font-semibold text-black bg-[#EAE3D1] rounded-lg shadow-md hover:bg-black hover:text-white transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 transform rotate-180" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                رجوع
            </a>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">المستندات المطلوبة</h2>
            <div class="text-right space-y-3">
                <p class="text-gray-700">يرجى التأكد من تجهيز المستندات التالية قبل تقديم الطلب:</p>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>نسخة من جواز السفر (PDF فقط)</li>
                    <li>الفحص الطبي (PDF فقط)</li>
                    <li>صورة شخصية حديثة (JPEG فقط)</li>
                </ul>

                <div class="mt-4">
                    <a href="{{ asset('documents/acquaintance_form.docx') }}" download class="bg-[#2D1E0F] text-white px-6 py-2 rounded-lg hover:bg-[#4B2E1A] transition-all duration-300 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        تحميل نموذج وثيقة التعارف
                    </a>
                    <p class="text-sm text-gray-600 mt-2">* يرجى تحميل النموذج وتعبئته قبل إرفاقه مع الطلب</p>
                </div>
            </div>
        </div>

        <div class="form-container">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('residency.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="service_type" value="residence-id">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الاسم الكامل</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الرقم العسكري</label>
                        <input type="text" name="military_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">رقم الهاتف</label>
                        <input type="tel" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الرقم الموحد</label>
                        <input type="text" name="unified_number" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الجنسية</label>
                        <select name="nationality" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F] text-right">
                            <option value="">اختر الجنسية</option>
                            <option value="PK">باكستان</option>
                            <option value="IN">الهند</option>
                            <option value="BD">بنغلاديش</option>
                            <option value="NP">نيبال</option>
                            <option value="LK">سريلانكا</option>
                            <option value="PH">الفلبين</option>
                        </select>
                    </div>
                </div>

                <div class="text-right mt-6">
                    <label class="block text-gray-700 mb-2">المرفقات المطلوبة</label>
                    <div class="space-y-4">
                        <div class="flex items-center justify-end">
                            <input type="file" name="passport" required class="mr-2" accept=".pdf">
                            <span>نسخة جواز السفر (PDF فقط)</span>
                        </div>
                        <div class="flex items-center justify-end">
                            <input type="file" name="medical_result" required class="mr-2" accept=".pdf">
                            <span>الفحص الطبي (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="employment_certificate" required class="mr-2" accept=".pdf">
                            <span>شهادة اثبات الحالة الوظيفية (PDF فقط)</span>
                        </div>
                        <div class="flex items-center justify-end">
                            <input type="file" name="photo" required class="mr-2" accept=".jpeg,.jpg,.png">
                            <span>صورة شخصية (JPEG أو PNG فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="acquaintance_document" required class="mr-2" accept=".pdf">
                            <span>وثيقة التعارف (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end pakistani_id_field" style="display: none;">
                            <input type="file" name="pakistani_id" class="mr-2" accept=".pdf">
                            <span>الهوية الباكستانية (PDF فقط)</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 text-center">
                    <button type="submit" class="bg-black text-white text-xl px-12 py-4 rounded-lg hover:bg-gray-800 transition duration-300 w-full md:w-auto font-bold">
                        تقديم الطلب
                    </button>
                </div>
            </form>
        </div>
    </section>

    <footer class="py-8 text-center mt-12" style="background-color: #8F7B5D;">
        <p class="text-white">&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>

    <script>
        document.querySelector('select[name="nationality"]').addEventListener('change', function() {
            const pakistaniIdField = document.querySelector('.pakistani_id_field');
            const pakistaniIdInput = document.querySelector('input[name="pakistani_id"]');
            
            if (this.value === 'PK') {
                pakistaniIdField.style.display = 'flex';
                pakistaniIdInput.required = true;
            } else {
                pakistaniIdField.style.display = 'none';
                pakistaniIdInput.required = false;
            }
        });
    </script>
</body>
</html> 