<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إضافة تأمين جديد</title>
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
                <h2 class="text-2xl font-bold">إضافة تأمين جديد</h2>
                <a href="/insurance" class="btn btn-back">رجوع</a>
            </div>
            <form action="{{ route('insurance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="service_type" value="new">

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

                <div class="input-group">
                    <label>الاسم الكامل</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="الرجاء إدخال الاسم الكامل">
                </div>

                <div class="input-group">
                    <label>الرقم العسكري</label>
                    <input type="text" name="military_id" value="{{ old('military_id') }}" required placeholder="الرجاء إدخال الرقم العسكري">
                </div>

                <div class="input-group">
                    <label>الحالة الاجتماعية</label>
                    <select name="marital_status" required class="w-full p-2 border border-gray-300 rounded-lg">
                        <option value="">اختر الحالة الاجتماعية</option>
                        <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>أعزب</option>
                        <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>متزوج</option>
                        <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>مطلق</option>
                        <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>أرمل</option>
                    </select>
                </div>

                <div class="input-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@domain.com">
                </div>

                <div class="input-group">
                    <label>رقم الهاتف المتحرك</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="05xxxxxxxx" pattern="[0-9]{10}">
                </div>

                <div class="input-group">
                    <label>الرقم الموحد (لغير المواطنين)</label>
                    <input type="text" name="unified_number" value="{{ old('unified_number') }}" placeholder="الرجاء إدخال الرقم الموحد إن وجد">
                </div>

                <div class="input-group">
                    <label>نسخة من الإقامة (لغير المواطنين فقط)</label>
                    <input type="file" name="residency" accept="application/pdf" class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700
                        hover:file:bg-blue-100">
                    <small class="text-gray-500">* اختياري - يرجى رفع نسخة من الإقامة بصيغة PDF فقط</small>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2 text-right" for="hiring_date">
                        تاريخ التعيين
                    </label>
                    <input type="date" name="hiring_date" id="hiring_date"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline text-right"
                        value="{{ old('hiring_date') }}">
                    @error('hiring_date')
                        <p class="text-red-500 text-xs italic text-right">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="input-group">
                        <label>جواز السفر (PDF فقط)</label>
                        <input type="file" name="passport" accept="application/pdf" required class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                    </div>

                    <div class="input-group">
                        <label>الهوية الإماراتية (PDF فقط)</label>
                        <input type="file" name="id_card" accept="application/pdf" required class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                    </div>

                    <div class="input-group">
                        <label>الصورة الشخصية</label>
                        <input type="file" name="photo" accept="image/*" required class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-full file:border-0
                            file:text-sm file:font-semibold
                            file:bg-blue-50 file:text-blue-700
                            hover:file:bg-blue-100">
                    </div>
                </div>

                <div class="input-group">
                    <label>ملاحظات إضافية</label>
                    <textarea name="description" rows="3" class="w-full p-2 border border-gray-300 rounded-lg" 
                        placeholder="أي ملاحظات إضافية تود إضافتها">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-submit">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>
</body>
</html>
