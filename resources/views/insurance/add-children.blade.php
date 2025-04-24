<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة الأبناء</title>
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
            padding: 20px;
        }
        header {
            background-color: rgb(255, 255, 255) !important;
        }
        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .input-group {
            margin-bottom: 20px;
            text-align: right;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #2D1E0F;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-top: 5px;
        }
        button {
            background-color: #2D1E0F !important;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            width: 100%;
            font-weight: bold;
            margin-top: 20px;
        }
        button:hover {
            background-color: #3D2E1F !important;
        }
        footer {
            margin-top: auto;
            background-color: #8F7B5D;
            padding: 20px;
            color: white;
        }
        .btn {
            background-color: #2D1E0F !important;
            color: white;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #3D2E1F !important;
        }
        .btn-submit {
            width: 100%;
            margin-top: 20px;
        }
        .btn-back {
            background-color: #8F7B5D !important;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <header class="py-4 shadow">
        <div class="container mx-auto text-center">
            <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto" style="max-width: 200px;">
            <nav class="mt-4">
                <a href="/" class="mx-2 text-gray-800 hover:text-gray-600">الرئيسية</a>
                <a href="/contact" class="mx-2 text-gray-800 hover:text-gray-600">اتصل بنا</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <h2 class="text-2xl font-bold mb-6">إضافة الأبناء</h2>
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">إضافة الأبناء للتأمين</h2>
                <a href="/insurance" class="btn btn-back">رجوع</a>
            </div>
            <form action="/insurance/submit" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_type" value="add-children">

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="input-group text-right">
                        <label class="block mb-2">الرقم العسكري</label>
                        <input type="text" name="military_id" value="{{ old('military_id') }}" required 
                               placeholder="الرجاء إدخال الرقم العسكري"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">اسم الابن/الابنة</label>
                        <input type="text" name="child_name" value="{{ old('child_name') }}" required 
                               placeholder="الاسم الكامل للابن/الابنة"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" value="{{ old('email') }}" required 
                               placeholder="example@domain.com"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">رقم الهاتف المتحرك</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required 
                               placeholder="05xxxxxxxx" pattern="[0-9]{10}"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">تاريخ التعيين</label>
                        <input type="date" name="appointment_date" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">الرقم الموحد (لغير المواطنين)</label>
                        <input type="text" name="unified_number" value="{{ old('unified_number') }}" 
                               placeholder="الرجاء إدخال الرقم الموحد إن وجد"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="input-group text-right">
                        <label class="block mb-2">جواز السفر (PDF فقط)</label>
                        <div class="flex items-center">
                            <input type="file" name="passport" accept="application/pdf" required 
                                   class="hidden" id="passport">
                            <label for="passport" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* يجب رفع نسخة من جواز السفر بصيغة PDF فقط</small>
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">الهوية الإماراتية (PDF فقط)</label>
                        <div class="flex items-center">
                            <input type="file" name="id_card" accept="application/pdf" required 
                                   class="hidden" id="id_card">
                            <label for="id_card" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* يجب رفع نسخة من الهوية بصيغة PDF فقط</small>
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">شهادة الميلاد (PDF فقط)</label>
                        <div class="flex items-center">
                            <input type="file" name="birth_certificate" accept="application/pdf" required 
                                   class="hidden" id="birth_certificate">
                            <label for="birth_certificate" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* يجب رفع نسخة من شهادة الميلاد بصيغة PDF فقط</small>
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">صورة شخصية</label>
                        <div class="flex items-center">
                            <input type="file" name="photo" accept="image/*" required 
                                   class="hidden" id="photo">
                            <label for="photo" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* يجب رفع صورة شخصية حديثة</small>
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">نسخة من الإقامة لغير المواطنين (PDF فقط)</label>
                        <div class="flex items-center">
                            <input type="file" name="residency" accept="application/pdf"
                                   class="hidden" id="residency">
                            <label for="residency" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* اختياري - يمكنك رفع نسخة من الإقامة بصيغة PDF</small>
                    </div>
                </div>

                <script>
                    // Update file input labels with selected filename
                    document.querySelectorAll('input[type="file"]').forEach(input => {
                        input.addEventListener('change', function() {
                            const fileName = this.files[0]?.name || 'No file chosen';
                            this.nextElementSibling.querySelector('.file-name').textContent = fileName;
                        });
                    });
                </script>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="submit" class="btn btn-submit">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html>
