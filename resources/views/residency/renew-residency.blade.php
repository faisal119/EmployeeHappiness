<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تجديد الإقامة</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #EAE3D1 !important;
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
        .btn-back {
            background-color: #8F7B5D !important;
            margin-left: 10px;
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
                <h2 class="text-2xl font-bold">تجديد الإقامة</h2>
                <a href="/residency" class="btn btn-back">رجوع</a>
            </div>

            <div class="bg-white p-6 rounded-lg mb-8">
                <h2 class="text-2xl font-bold mb-4">المستندات المطلوبة</h2>
                <p class="text-gray-700 mb-4">يرجى التأكد من تجهيز المستندات التالية قبل تقديم الطلب</p>

                <ul class="list-disc list-inside text-gray-700 space-y-2 mr-4">
                    <li>نسخة من جواز السفر ساري المفعول</li>
                    <li>نسخة من الهوية الإماراتية سارية المفعول</li>
                    <li>الرقم الموحد</li>
                    <li>شهادة إثبات الحالة الوظيفية</li>
                    <li>صورة شخصية بدون تعديلات</li>
                    <li>نتيجة الفحص الطبي</li>
                </ul>

                <div class="mt-4">
                    <a href="{{ asset('documents/acquaintance_form.docx') }}" download class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        تحميل نموذج وثيقة التعارف
                    </a>
                    <p class="text-sm text-gray-600 mt-2">* يرجى تحميل النموذج وتعبئته قبل إرفاقه مع الطلب</p>
                </div>

                <div class="mt-8">
                    <h3 class="font-bold text-xl mb-4">الشروط والملاحظات</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2 mr-4">
                        <li>يرجى ارسال المتطلبات كاملة</li>
                        <li>يرجى ارسال المتطلبات بوضوح و عدم تصوير المستندات بالهاتف</li>
                        <li>من قبل كل الموظف من الجنسية الباكستانية يرجى ارسال الهوية الباكستانية</li>
                        <li>يرجى التقديم على الإقامة الجديدة قبل انتهاء الإقامة السابقة بستة أشهر</li>
                        <li>لا تتحمل القيادة أي تأخر صادر من الموظف في حال التأخير</li>
                        <li>يرجى ارسال صورة شخصية حديثة ويجب ان تكون مطابقة لجواز السفر</li>
                    </ul>
                    <p class="text-red-600 mt-4 font-bold text-right">لن يتم استلام اي معاملة في حال التخلف عن الشروط والملاحظات</p>
                </div>
            </div>

            <form action="{{ route('residency.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="service_type" value="renew-residency">

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

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="input-group text-right">
                        <label class="block mb-2">الاسم الكامل</label>
                        <input type="text" name="name" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">رقم الجوال</label>
                        <input type="tel" name="phone" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">الرقم العسكري</label>
                        <input type="text" name="military_id" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="input-group text-right">
                        <label class="block mb-2">الرقم الموحد</label>
                        <input type="text" name="unified_number" required 
                               class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الجنسية</label>
                        <select name="nationality" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F] text-right">
                            <option value="">اختر الجنسية</option>
                            <option value="AF">أفغانستان</option>
                            <option value="PK">باكستان</option>
                            <option value="IN">الهند</option>
                            <option value="BD">بنغلاديش</option>
                            <option value="NP">نيبال</option>
                            <option value="LK">سريلانكا</option>
                            <option value="PH">الفلبين</option>
                            <option value="JO">الأردن</option>
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
                            <input type="file" name="id_card" required class="mr-2" accept=".pdf">
                            <span>نسخة الهوية الإماراتية (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="current_residency" required class="mr-2" accept=".pdf">
                            <span>الإقامة الحالية (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="medical_result" required class="mr-2" accept=".pdf">
                            <span>نتيجة الفحص الطبي (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="employment_certificate" required class="mr-2" accept=".pdf">
                            <span>شهادة اثبات الحالة الوظيفية (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="photo" required class="mr-2" accept=".jpg,.jpeg,.png">
                            <span>صورة شخصية (JPEG أو PNG فقط)</span>
                        </div>

                        <div class="flex items-center justify-end">
                            <input type="file" name="acquaintance_document" required class="mr-2" accept=".pdf">
                            <span>وثيقة التعارف (PDF فقط)</span>
                        </div>

                        <div class="flex items-center justify-end pakistani-id-field" style="display: none;">
                            <input type="file" name="pakistani_id" class="mr-2" accept=".pdf">
                            <span>الهوية الباكستانية (PDF فقط)</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn w-full">إرسال الطلب</button>
            </form>

            <script>
                // Update file input labels with selected filename
                document.querySelectorAll('input[type="file"]').forEach(input => {
                    input.addEventListener('change', function() {
                        const fileName = this.files[0]?.name || 'No file chosen';
                        this.nextElementSibling.querySelector('.file-name').textContent = fileName;
                    });
                });

                document.querySelector('select[name="nationality"]').addEventListener('change', function() {
                    const pakistaniIdField = document.querySelector('.pakistani-id-field');
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
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html> 