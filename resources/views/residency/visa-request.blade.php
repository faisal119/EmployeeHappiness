<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>طلب التأشيرة</title>
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
            <h1 class="text-3xl font-bold text-gray-900">طلب التأشيرة</h1>
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
                    <li>نسخة من جواز السفر ساري المفعول</li>
                    <li>شهادة إثبات الحالة الوظيفية</li>
                    <li>صورة شخصية بدون تعديلات (PDF فقط)</li>
                    <li>وثيقة التعارف (يمكنك تحميل النموذج أدناه)</li>
                </ul>

                <div class="mt-6 text-center">
                    <a href="{{ asset('documents/acquaintance_form.docx') }}" download class="bg-[#EAE3D1] text-[#2D1E0F] px-8 py-3 rounded-lg hover:bg-[#2D1E0F] hover:text-white transition-all duration-300 inline-flex items-center shadow-lg font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                        <li>لا تتحمل القيادة أي تأخر صادر من الموظف في حال التأخير</li>
                        <li>يرجى عدم تعبئة التدقيق الأمني ووثيقة التعارف بخط اليد</li>
                        <li>يرجى ارسال صورة شخصية حديثة ويجب ان تكون مطابقة لجواز السفر</li>
                    </ul>
                    <p class="text-red-600 mt-4 font-bold">لن يتم استلام اي معاملة في حال التخلف عن الشروط والملاحظات</p>
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
                        <label class="block text-gray-700 mb-2">رقم الجوال</label>
                        <input type="tel" name="phone" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الجنسية</label>
                        <select name="nationality" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F] text-right">
                            <option value="">اختر الجنسية</option>
                            <option value="AF">أفغانستان</option>
                            <option value="AL">ألبانيا</option>
                            <option value="DZ">الجزائر</option>
                            <option value="AD">أندورا</option>
                            <option value="AO">أنغولا</option>
                            <option value="AR">الأرجنتين</option>
                            <option value="AM">أرمينيا</option>
                            <option value="AU">أستراليا</option>
                            <option value="AT">النمسا</option>
                            <option value="AZ">أذربيجان</option>
                            <option value="BH">البحرين</option>
                            <option value="BD">بنغلاديش</option>
                            <option value="BY">بيلاروسيا</option>
                            <option value="BE">بلجيكا</option>
                            <option value="BZ">بليز</option>
                            <option value="BJ">بنين</option>
                            <option value="BT">بوتان</option>
                            <option value="BO">بوليفيا</option>
                            <option value="BA">البوسنة والهرسك</option>
                            <option value="BR">البرازيل</option>
                            <option value="BN">بروناي</option>
                            <option value="BG">بلغاريا</option>
                            <option value="KH">كمبوديا</option>
                            <option value="CM">الكاميرون</option>
                            <option value="CA">كندا</option>
                            <option value="TD">تشاد</option>
                            <option value="CL">تشيلي</option>
                            <option value="CN">الصين</option>
                            <option value="CO">كولومبيا</option>
                            <option value="KM">جزر القمر</option>
                            <option value="CR">كوستاريكا</option>
                            <option value="HR">كرواتيا</option>
                            <option value="CU">كوبا</option>
                            <option value="CY">قبرص</option>
                            <option value="CZ">جمهورية التشيك</option>
                            <option value="DK">الدنمارك</option>
                            <option value="DJ">جيبوتي</option>
                            <option value="EC">الإكوادور</option>
                            <option value="EG">مصر</option>
                            <option value="SV">السلفادور</option>
                            <option value="GQ">غينيا الاستوائية</option>
                            <option value="ER">إريتريا</option>
                            <option value="EE">إستونيا</option>
                            <option value="ET">إثيوبيا</option>
                            <option value="FJ">فيجي</option>
                            <option value="FI">فنلندا</option>
                            <option value="FR">فرنسا</option>
                            <option value="GA">الغابون</option>
                            <option value="GM">غامبيا</option>
                            <option value="GE">جورجيا</option>
                            <option value="DE">ألمانيا</option>
                            <option value="GH">غانا</option>
                            <option value="GR">اليونان</option>
                            <option value="GT">غواتيمالا</option>
                            <option value="GN">غينيا</option>
                            <option value="GY">غيانا</option>
                            <option value="HT">هايتي</option>
                            <option value="HN">هندوراس</option>
                            <option value="HU">المجر</option>
                            <option value="IS">آيسلندا</option>
                            <option value="IN">الهند</option>
                            <option value="ID">إندونيسيا</option>
                            <option value="IR">إيران</option>
                            <option value="IQ">العراق</option>
                            <option value="IE">أيرلندا</option>
                            <option value="IT">إيطاليا</option>
                            <option value="JM">جامايكا</option>
                            <option value="JP">اليابان</option>
                            <option value="JO">الأردن</option>
                            <option value="KZ">كازاخستان</option>
                            <option value="KE">كينيا</option>
                            <option value="KW">الكويت</option>
                            <option value="KG">قيرغيزستان</option>
                            <option value="LA">لاوس</option>
                            <option value="LV">لاتفيا</option>
                            <option value="LB">لبنان</option>
                            <option value="LY">ليبيا</option>
                            <option value="LI">ليختنشتاين</option>
                            <option value="LT">ليتوانيا</option>
                            <option value="LU">لوكسمبورغ</option>
                            <option value="MK">مقدونيا</option>
                            <option value="MG">مدغشقر</option>
                            <option value="MY">ماليزيا</option>
                            <option value="MV">جزر المالديف</option>
                            <option value="ML">مالي</option>
                            <option value="MT">مالطا</option>
                            <option value="MR">موريتانيا</option>
                            <option value="MU">موريشيوس</option>
                            <option value="MX">المكسيك</option>
                            <option value="MD">مولدوفا</option>
                            <option value="MC">موناكو</option>
                            <option value="MN">منغوليا</option>
                            <option value="MA">المغرب</option>
                            <option value="MZ">موزمبيق</option>
                            <option value="MM">ميانمار</option>
                            <option value="NA">ناميبيا</option>
                            <option value="NP">نيبال</option>
                            <option value="NL">هولندا</option>
                            <option value="NZ">نيوزيلندا</option>
                            <option value="NI">نيكاراغوا</option>
                            <option value="NE">النيجر</option>
                            <option value="NG">نيجيريا</option>
                            <option value="NO">النرويج</option>
                            <option value="OM">عمان</option>
                            <option value="PK">باكستان</option>
                            <option value="PS">فلسطين</option>
                            <option value="PA">بنما</option>
                            <option value="PY">باراغواي</option>
                            <option value="PE">بيرو</option>
                            <option value="PH">الفلبين</option>
                            <option value="PL">بولندا</option>
                            <option value="PT">البرتغال</option>
                            <option value="QA">قطر</option>
                            <option value="RO">رومانيا</option>
                            <option value="RU">روسيا</option>
                            <option value="RW">رواندا</option>
                            <option value="SA">المملكة العربية السعودية</option>
                            <option value="SN">السنغال</option>
                            <option value="RS">صربيا</option>
                            <option value="SC">سيشل</option>
                            <option value="SL">سيراليون</option>
                            <option value="SG">سنغافورة</option>
                            <option value="SK">سلوفاكيا</option>
                            <option value="SI">سلوفينيا</option>
                            <option value="SO">الصومال</option>
                            <option value="ZA">جنوب أفريقيا</option>
                            <option value="ES">إسبانيا</option>
                            <option value="LK">سريلانكا</option>
                            <option value="SD">السودان</option>
                            <option value="SE">السويد</option>
                            <option value="CH">سويسرا</option>
                            <option value="SY">سوريا</option>
                            <option value="TW">تايوان</option>
                            <option value="TJ">طاجيكستان</option>
                            <option value="TZ">تنزانيا</option>
                            <option value="TH">تايلاند</option>
                            <option value="TG">توغو</option>
                            <option value="TN">تونس</option>
                            <option value="TR">تركيا</option>
                            <option value="TM">تركمانستان</option>
                            <option value="UG">أوغندا</option>
                            <option value="UA">أوكرانيا</option>
                            <option value="AE">الإمارات العربية المتحدة</option>
                            <option value="GB">المملكة المتحدة</option>
                            <option value="US">الولايات المتحدة</option>
                            <option value="UY">أوروغواي</option>
                            <option value="UZ">أوزبكستان</option>
                            <option value="VE">فنزويلا</option>
                            <option value="VN">فيتنام</option>
                            <option value="YE">اليمن</option>
                            <option value="ZM">زامبيا</option>
                            <option value="ZW">زيمبابوي</option>
                        </select>
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">البريد الإلكتروني</label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>

                    <div class="text-right">
                        <label class="block text-gray-700 mb-2">الرقم الموحد</label>
                        <input type="text" name="unified_number" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-[#2D1E0F]">
                    </div>
                </div>

                <input type="hidden" name="service_type" value="visa-request">

                <div class="text-right mt-6">
                    <label class="block text-gray-700 mb-2">المرفقات المطلوبة</label>
                    <div class="space-y-4">
                        <div class="flex items-center justify-end">
                            <input type="file" name="passport" required class="mr-2" accept=".pdf">
                            <span>نسخة جواز السفر (PDF فقط)</span>
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
                            <span>نموذج وثيقة التعارف (PDF فقط)</span>
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