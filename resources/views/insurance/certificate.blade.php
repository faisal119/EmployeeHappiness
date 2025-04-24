<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>شهادة التأمين</title>
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
                <h2 class="text-2xl font-bold">طلب شهادة تأمين</h2>
                <a href="/insurance" class="btn btn-back">رجوع</a>
            </div>
            <form action="/insurance/submit" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_type" value="certificate">

                <div class="input-group">
                    <label>الرقم العسكري</label>
                    <input type="text" name="military_id" required>
                </div>

                <div class="input-group">
                    <label>رقم الهاتف</label>
                    <input type="tel" name="phone" required>
                </div>

                <div class="input-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" required>
                </div>

                <div class="input-group">
                    <label>الرقم الموحد (لغير المواطنين)</label>
                    <input type="text" name="unified_number" id="unified_number" placeholder="الرجاء إدخال الرقم الموحد إن وجد">
                </div>

                <div class="residency-section" style="display: none;">
                    <div class="input-group">
                        <label>نسخة من الإقامة (لغير المواطنين فقط)</label>
                        <input type="file" name="residency" accept="application/pdf" class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                        <small class="text-gray-500">* يجب رفع نسخة من الإقامة بصيغة PDF فقط</small>
                    </div>
                </div>

                <div class="input-group">
                    <label>الغرض من الشهادة</label>
                    <input type="text" name="description" required>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const unifiedNumberInput = document.getElementById('unified_number');
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
                </script>

                <button type="submit" class="btn btn-submit">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html>
