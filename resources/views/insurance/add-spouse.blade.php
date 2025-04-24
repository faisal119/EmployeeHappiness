<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة الزوج/الزوجة</title>
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
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        footer {
            margin-top: auto;
            background-color: #8F7B5D;
            padding: 20px;
            color: white;
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
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">إضافة الزوج/الزوجة للتأمين</h2>
                <a href="/insurance" class="btn btn-back">رجوع</a>
            </div>
            <form action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_type" value="add-spouse">

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="input-group text-right">
                        <label class="block mb-2">الرقم العسكري</label>
                        <input type="text" name="military_id" value="{{ old('military_id') }}" required 
                               placeholder="الرجاء إدخال الرقم العسكري"
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">اسم الزوج/الزوجة</label>
                        <input type="text" name="spouse_name" value="{{ old('spouse_name') }}" required 
                               placeholder="الاسم الكامل للزوج/الزوجة"
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
                        <label class="block mb-2">عقد الزواج (PDF فقط)</label>
                        <div class="flex items-center">
                            <input type="file" name="marriage_contract" accept="application/pdf" required 
                                   class="hidden" id="marriage_contract">
                            <label for="marriage_contract" class="w-full p-2 border border-gray-300 rounded cursor-pointer bg-white text-right flex justify-between items-center">
                                <span class="text-gray-500">اختر الملف</span>
                                <span class="file-name text-gray-700"></span>
                            </label>
                        </div>
                        <small class="text-gray-500 block mt-1">* يجب رفع نسخة من عقد الزواج بصيغة PDF فقط</small>
                    </div>

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
                        <label class="block mb-2">نسخة من الإقامة (PDF فقط)</label>
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

                <div class="input-group mt-4">
                    <label>ملاحظات إضافية</label>
                    <textarea name="description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg" 
                        placeholder="أي ملاحظات إضافية تود إضافتها">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-submit">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const unifiedNumberInput = document.querySelector('input[name="unified_number"]');
            const residencySection = document.querySelector('.residency-section');

            function toggleResidencySection() {
                if (unifiedNumberInput.value.trim() !== '') {
                    residencySection.style.display = 'block';
                    const residencyInput = residencySection.querySelector('input[name="residency"]');
                    residencyInput.required = true;
                } else {
                    residencySection.style.display = 'none';
                    const residencyInput = residencySection.querySelector('input[name="residency"]');
                    residencyInput.required = false;
                }
            }

            // التحقق عند تحميل الصفحة
            toggleResidencySection();

            // التحقق عند تغيير قيمة الرقم الموحد
            unifiedNumberInput.addEventListener('input', toggleResidencySection);
        });

        // Update file input labels with selected filename
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const fileName = this.files[0]?.name || 'No file chosen';
                this.nextElementSibling.querySelector('.file-name').textContent = fileName;
            });
        });
    </script>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html>

