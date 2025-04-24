<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نقل الكفالة</title>
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
        .download-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background-color: #2D1E0F;
            color: white;
            border-radius: 0.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .download-btn:hover {
            background-color: #3D2E1F;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .download-btn:active {
            transform: translateY(0);
        }
        .download-btn svg {
            margin-left: 0.5rem;
            width: 1.25rem;
            height: 1.25rem;
        }
        .submit-button {
            background: linear-gradient(to bottom right, #8F7B5D, #6b5c45);
            color: white;
            padding: 15px 40px;
            border-radius: 8px;
            border: none;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .submit-button:hover {
            background: linear-gradient(to bottom right, #6b5c45, #4d422f);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .submit-button:active {
            transform: translateY(0);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .button-text {
            display: inline-block;
            transition: opacity 0.3s ease;
        }

        .button-loader {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .button-loader.hidden {
            display: none;
        }

        .spinner {
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .back-button {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #EAE3D1;
            color: #2D1E0F;
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
            background-color: #2D1E0F;
            color: #EAE3D1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <header class="bg-white py-4 shadow">
        <div class="container mx-auto text-center">
            <div class="flex justify-center mb-4">
                <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto">
            </div>
            <nav>
                <ul class="flex justify-center space-x-4 mt-3">
                    <li><a href="/" class="text-gray-800 hover:text-gray-600">الرئيسية</a></li>
                    <li><a href="/residency-service" class="text-gray-800 hover:text-gray-600">خدمات الإقامة</a></li>
                    <li><a href="/contact" class="text-gray-800 hover:text-gray-600">اتصل بنا</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="container mx-auto py-12">
        <div class="flex justify-between items-center mb-8">
            <a href="{{ url('/residency') }}" class="back-button" style="position: static;">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                رجوع
            </a>
            <h1 class="text-3xl font-bold text-gray-900">نقل الكفالة</h1>
        </div>
        
        <!-- قسم المستندات المطلوبة -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-4">المستندات المطلوبة</h2>
            <div class="text-right space-y-3">
                <p class="text-gray-700">يرجى التأكد من تجهيز المستندات التالية قبل تقديم الطلب:</p>
                <ul class="list-disc list-inside text-gray-700 space-y-2">
                    <li>نسخة من جواز السفر ساري المفعول</li>
                    <li>نسخة من الهوية الإماراتية سارية المفعول</li>
                    <li>الرقم الموحد</li>
                    <li>الإقامة السابقة</li>
                    <li>شهادة إثبات الحالة الوظيفية</li>
                    <li>صورة شخصية بدون تعديلات (JPEG)</li>
                    <li>نتيجة الفحص الطبي (PDF)</li>
                </ul>

                <div class="mt-4">
                    <a href="{{ asset('documents/acquaintance_form.docx') }}" download class="download-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        تحميل نموذج وثيقة التعارف
                    </a>
                    <p class="text-sm text-gray-600 mt-2">* يرجى تحميل النموذج وتعبئته قبل إرفاقه مع الطلب</p>
                </div>

                <div class="bg-gray-50 p-4 rounded-lg mt-6">
                    <h3 class="font-bold text-gray-900 mb-2">الشروط والملاحظات</h3>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>يرجى ارسال المتطلبات كاملة</li>
                        <li>يرجى ارسال المتطلبات بوضوح و عدم تصوير المستندات بالهاتف</li>
                        <li>في حال كان الموظف من الجنسية الباكستانية يرجى ارسال الهوية الباكستانية</li>
                        <li>يرجى التقديم على الإقامة الجديدة قبل انتهاء الإقامة السابقة بستة أشهر</li>
                        <li>لا تتحمل القيادة أي تأخر صادر من الموظف في حال التأخير</li>
                        <li>يرجى ارسال صورة شخصية حديثة ويجب ان تكون مطابقة لجواز السفر</li>
                    </ul>
                    <p class="text-red-600 mt-4 font-bold">لن يتم استلام اي معاملة في حال التخلف عن الشروط والملاحظات</p>
                </div>
            </div>
        </div>
        
        <div class="form-container">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">نموذج طلب نقل الكفالة</h2>
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('residency.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <input type="hidden" name="service_type" value="sponsorship-transfer">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            الاسم الكامل *
                        </label>
                        <input type="text" name="name" id="name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            البريد الإلكتروني *
                        </label>
                        <input type="email" name="email" id="email" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                            رقم الهاتف *
                        </label>
                        <input type="tel" name="phone" id="phone" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="military_id">
                            الرقم العسكري *
                        </label>
                        <input type="text" name="military_id" id="military_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="unified_number">
                            الرقم الموحد *
                        </label>
                        <input type="text" name="unified_number" id="unified_number" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="nationality">
                            الجنسية *
                        </label>
                        <select name="nationality" id="nationality" required
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                            <option value="">اختر الجنسية</option>
                            <option value="PK">باكستان</option>
                            <option value="IN">الهند</option>
                            <option value="BD">بنغلاديش</option>
                            <option value="NP">نيبال</option>
                            <option value="LK">سريلانكا</option>
                            <option value="PH">الفلبين</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="passport">
                            جواز السفر * (PDF فقط)
                        </label>
                        <input type="file" name="passport" id="passport" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="medical_result">
                            نتيجة الفحص الطبي * (PDF فقط)
                        </label>
                        <input type="file" name="medical_result" id="medical_result" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="id_card">
                            الهوية الإماراتية * (PDF فقط)
                        </label>
                        <input type="file" name="id_card" id="id_card" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="current_residency">
                            الإقامة الحالية * (PDF فقط)
                        </label>
                        <input type="file" name="current_residency" id="current_residency" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="photo">
                            الصورة الشخصية * (JPEG أو PNG فقط)
                        </label>
                        <input type="file" name="photo" id="photo" required accept=".jpg,.jpeg,.png"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right pakistani_id_field" style="display: none;">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="pakistani_id">
                            الهوية الباكستانية * (PDF فقط)
                        </label>
                        <input type="file" name="pakistani_id" id="pakistani_id" accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="employment_certificate">
                           شهادة اثبات الحالة الوظيفية  * (PDF فقط)
                        </label>
                        <input type="file" name="employment_certificate" id="employment_certificate" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div> 

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="sponsorship_transfer_certificate">
                            شهادة نقل الكفالة * (PDF فقط)
                        </label>
                        <input type="file" name="sponsorship_transfer_certificate" id="sponsorship_transfer_certificate" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="acquaintance_document">
                            وثيقة التعارف * (PDF فقط)
                        </label>
                        <input type="file" name="acquaintance_document" id="acquaintance_document" required accept=".pdf"
                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-[#8F7B5D]">
                    </div>
                </div>

                <div class="text-center mt-8">
                    <button type="submit" class="submit-button">
                        <span class="button-text">تقديم الطلب</span>
                        <div class="button-loader hidden">
                            <div class="spinner"></div>
                        </div>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <footer class="py-8 text-center mt-12" style="background-color: #8F7B5D;">
        <p class="text-white">&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>

    <script>
        // التحقق من الجنسية وإظهار حقل الهوية الباكستانية
        document.getElementById('nationality').addEventListener('change', function() {
            const pakistaniIdField = document.querySelector('.pakistani_id_field');
            const pakistaniIdInput = document.querySelector('input[name="pakistani_id"]');
            
            if (this.value === 'PK') {
                pakistaniIdField.style.display = 'block';
                pakistaniIdInput.required = true;
            } else {
                pakistaniIdField.style.display = 'none';
                pakistaniIdInput.required = false;
            }
        });

        document.querySelector('form').addEventListener('submit', function() {
            const button = document.querySelector('.submit-button');
            const buttonText = button.querySelector('.button-text');
            const buttonLoader = button.querySelector('.button-loader');
            
            buttonText.style.opacity = '0';
            buttonLoader.classList.remove('hidden');
            
            setTimeout(() => {
                if (buttonLoader.classList.contains('hidden')) return;
                buttonText.style.opacity = '1';
                buttonLoader.classList.add('hidden');
            }, 3000);
        });
    </script>
</body>
</html> 