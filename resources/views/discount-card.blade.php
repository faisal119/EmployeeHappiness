<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>بطاقة الخصم</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(234, 227, 209, 0.95), rgba(234, 227, 209, 0.95)), url('{{ asset("images/bg-pattern.png") }}') repeat;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            width: 100%;
            max-width: 900px;
            margin: auto;
            padding: 1rem;
            position: relative;
            z-index: 1;
        }
        header {
            background-color: rgba(255, 255, 255, 0.98) !important;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin: 1rem;
            backdrop-filter: blur(5px);
        }
        .nav-links {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
            padding: 0;
            list-style: none;
            flex-wrap: wrap;
        }
        .nav-link {
            background-color: #2D1E0F !important;
            color: white !important;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            min-width: 100px;
            text-align: center;
            border: 2px solid #2D1E0F;
            margin: 0.25rem;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .nav-link {
                width: calc(50% - 1rem);
                min-width: auto;
            }
            .form-container {
                padding: 1rem;
                margin: 0.5rem;
            }
            .container {
                padding: 0.5rem;
            }
            h1 {
                font-size: 1.5rem !important;
            }
            h2 {
                font-size: 1.25rem !important;
            }
        }
        .nav-link:hover {
            background-color: #4B2E1A !important;
            transform: translateY(-2px);
        }
        .back-button {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #2D1E0F;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 10;
            font-size: 0.9rem;
        }
        .back-button:hover {
            background-color: #4B2E1A;
        }
        footer {
            background-color: rgba(143, 123, 93, 0.98);
            width: 100%;
            padding: 1rem 0;
            margin-top: auto;
            border-top: 2px solid #2D1E0F;
            position: relative;
            z-index: 1;
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
            font-size: 0.9rem;
            text-align: center;
            line-height: 1.5;
        }
        button[type="submit"] {
            background-color: #2D1E0F !important;
            width: 100%;
            max-width: 300px;
        }
        input:focus, select:focus {
            border-color: #2D1E0F !important;
            ring-color: #2D1E0F !important;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            color: #2D1E0F;
            margin-bottom: 0.5rem;
            font-weight: 600;
            text-align: right;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid #DDD;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        .form-input:focus {
            outline: none;
            border-color: #2D1E0F;
            box-shadow: 0 0 0 2px rgba(45, 30, 15, 0.1);
        }
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .radio-group {
            display: flex;
            gap: 1.5rem;
            justify-content: flex-end;
            align-items: center;
        }
        .radio-label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .file-input {
            width: 100%;
            padding: 0.5rem;
            border: 2px solid #DDD;
            border-radius: 8px;
            background-color: white;
        }
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <a href="{{ url('/') }}" class="back-button">
        <i class="fas fa-arrow-right"></i>
        رجوع للرئيسية
    </a>

    <header>
        <div class="container">
            <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto w-20 md:w-24">
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
        <div class="container py-8">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">طلب بطاقة الخصم</h1>
            
            <div class="bg-white p-4 md:p-6 rounded-lg shadow-lg mb-6">
                <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">المستندات المطلوبة</h2>
                <div class="text-right">
                    <p class="text-gray-700 mb-3">يرجى التأكد من تجهيز المستندات التالية قبل تقديم الطلب:</p>
                    <ul class="list-disc list-inside text-gray-700 space-y-2">
                        <li>نسخة من جواز السفر</li>
                        <li>نسخة من الهوية الإماراتية</li>
                    </ul>
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

                <form action="{{ route('discount-card.store') }}" method="POST" enctype="multipart/form-data" id="discountForm" onsubmit="return combineNames()">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">الاسم</label>
                            <input type="text" id="first_name" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">اسم الأب</label>
                            <input type="text" id="father_name" class="form-input" required>
                        </div>

                        <div class="form-group">
                            <label class="form-label">الاسم الأخير</label>
                            <input type="text" id="last_name" class="form-input" required>
                        </div>

                        <!-- حقل مخفي للاسم الكامل -->
                        <input type="hidden" name="full_name" id="full_name">

                        <div class="form-group">
                            <label class="form-label">العمر</label>
                            <input type="number" name="age" class="form-input" min="1" max="120" required value="{{ old('age') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الرقم الوظيفي</label>
                            <input type="text" name="employee_id" class="form-input" required value="{{ old('employee_id') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">نوع البطاقة</label>
                            <select name="card_type" class="form-input" required>
                                <option value="">اختر نوع البطاقة</option>
                                <option value="إسعاد" {{ old('card_type') == 'إسعاد' ? 'selected' : '' }}>إسعاد</option>
                                <option value="وفر" {{ old('card_type') == 'وفر' ? 'selected' : '' }}>وفر</option>
                                <option value="فزعة" {{ old('card_type') == 'فزعة' ? 'selected' : '' }}>فزعة</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">البريد الإلكتروني الشخصي</label>
                            <input type="email" name="email" class="form-input" required value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label class="form-label">الإمارة</label>
                            <select name="emirate" class="form-input" required>
                                <option value="">اختر الإمارة</option>
                                <option value="أبوظبي" {{ old('emirate') == 'أبوظبي' ? 'selected' : '' }}>أبوظبي</option>
                                <option value="دبي" {{ old('emirate') == 'دبي' ? 'selected' : '' }}>دبي</option>
                                <option value="الشارقة" {{ old('emirate') == 'الشارقة' ? 'selected' : '' }}>الشارقة</option>
                                <option value="عجمان" {{ old('emirate') == 'عجمان' ? 'selected' : '' }}>عجمان</option>
                                <option value="أم القيوين" {{ old('emirate') == 'أم القيوين' ? 'selected' : '' }}>أم القيوين</option>
                                <option value="رأس الخيمة" {{ old('emirate') == 'رأس الخيمة' ? 'selected' : '' }}>رأس الخيمة</option>
                                <option value="الفجيرة" {{ old('emirate') == 'الفجيرة' ? 'selected' : '' }}>الفجيرة</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="form-label">المنطقة</label>
                            <input type="text" name="area" class="form-input" required value="{{ old('area') }}">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">هل الأب على قيد الحياة؟</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="father_alive" value="نعم" required {{ old('father_alive') == 'نعم' ? 'checked' : '' }}>
                                    <span>نعم</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="father_alive" value="لا" required {{ old('father_alive') == 'لا' ? 'checked' : '' }}>
                                    <span>لا</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">هل الأم على قيد الحياة؟</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="mother_alive" value="نعم" required {{ old('mother_alive') == 'نعم' ? 'checked' : '' }}>
                                    <span>نعم</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="mother_alive" value="لا" required {{ old('mother_alive') == 'لا' ? 'checked' : '' }}>
                                    <span>لا</span>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="parents_alive" id="parents_alive">

                        <div class="form-group">
                            <label class="form-label">هل سبق الحصول على بطاقة خصم؟</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="previous_card" value="نعم" required {{ old('previous_card') == 'نعم' ? 'checked' : '' }}>
                                    <span>نعم</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="previous_card" value="لا" required {{ old('previous_card') == 'لا' ? 'checked' : '' }}>
                                    <span>لا</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">هل أنت متزوج؟</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="married" value="نعم" required onchange="toggleChildrenCount(this)" {{ old('married') == 'نعم' ? 'checked' : '' }}>
                                    <span>نعم</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="married" value="لا" required onchange="toggleChildrenCount(this)" {{ old('married') == 'لا' ? 'checked' : '' }}>
                                    <span>لا</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group" id="children_count_div" style="display: none;">
                            <label class="form-label">عدد الأبناء</label>
                            <input type="number" name="children_count" class="form-input" min="0" value="{{ old('children_count') }}">
                        </div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">نسخة جواز السفر</label>
                            <input type="file" name="passport_copy" class="file-input" required accept=".pdf,.jpg,.jpeg,.png">
                        </div>

                        <div class="form-group">
                            <label class="form-label">نسخة الهوية الإماراتية</label>
                            <input type="file" name="emirates_id" class="file-input" required accept=".pdf,.jpg,.jpeg,.png">
                        </div>
                    </div>

                    <div class="mt-8 text-center">
                        <button type="submit" class="bg-[#2D1E0F] text-white px-8 py-3 rounded-lg hover:bg-[#4B2E1A] focus:outline-none focus:ring-2 focus:ring-[#2D1E0F] focus:ring-offset-2 transition-colors duration-200 text-lg font-semibold w-full md:w-auto min-w-[200px]">
                            إرسال الطلب
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-content">
            <p class="footer-text">&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
        </div>
    </footer>

    <script>
        // دالة تحديث الاسم الكامل
        function updateFullName() {
            const firstName = document.getElementById('first_name').value.trim();
            const fatherName = document.getElementById('father_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            
            document.getElementById('full_name').value = `${firstName} ${fatherName} ${lastName}`.trim();
        }

        // إضافة مستمعي الأحداث لحقول الاسم
        document.getElementById('first_name').addEventListener('input', updateFullName);
        document.getElementById('father_name').addEventListener('input', updateFullName);
        document.getElementById('last_name').addEventListener('input', updateFullName);

        // التحقق قبل إرسال النموذج
        document.getElementById('discountForm').addEventListener('submit', function(e) {
            const firstName = document.getElementById('first_name').value.trim();
            const fatherName = document.getElementById('father_name').value.trim();
            const lastName = document.getElementById('last_name').value.trim();
            
            if (!firstName || !fatherName || !lastName) {
                e.preventDefault();
                alert('الرجاء تعبئة جميع حقول الاسم');
                return false;
            }
            
            updateFullName();
            return true;
        });

        function toggleChildrenCount(radio) {
            const childrenCountDiv = document.getElementById('children_count_div');
            if (radio.value === 'نعم') {
                childrenCountDiv.style.display = 'block';
            } else {
                childrenCountDiv.style.display = 'none';
            }
        }

        // تحديث حالة الوالدين عند تغيير أي من الخيارات
        function updateParentsStatus() {
            const fatherStatus = document.querySelector('input[name="father_alive"]:checked')?.value || '';
            const motherStatus = document.querySelector('input[name="mother_alive"]:checked')?.value || '';
            
            if (fatherStatus && motherStatus) {
                document.getElementById('parents_alive').value = fatherStatus;
            }
        }

        // إضافة مستمعي الأحداث
        document.querySelectorAll('input[name="father_alive"], input[name="mother_alive"]').forEach(input => {
            input.addEventListener('change', updateParentsStatus);
        });

        // تحديث عند تحميل الصفحة
        document.addEventListener('DOMContentLoaded', updateParentsStatus);
    </script>
</body>
</html> 