<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تحديث التأمين</title>
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
                <h2 class="text-2xl font-bold">تحديث التأمين</h2>
                <a href="/insurance" class="btn btn-back">رجوع</a>
            </div>

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
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- ملاحظة مهمة -->
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle ml-2"></i>
                <strong>ملاحظة مهمة:</strong> يرجى التواصل مع مركز إسعاد العاملين لمعرفة متطلبات التحديث قبل تقديم الطلب.
            </div>

            <form action="{{ route('insurance.update-request') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="service_type" value="update">

                <div class="input-group">
                    <label>تحديث البيانات لـ:</label>
                    <select name="update_for" id="update_for" class="w-full p-2 border rounded" required>
                        <option value="">اختر...</option>
                        <option value="self">تحديث بياناتي</option>
                        <option value="spouse">تحديث بيانات الزوج/الزوجة</option>
                        <option value="children">تحديث بيانات الأبناء</option>
                        <option value="parents">تحديث بيانات الوالدين</option>
                    </select>
                </div>

                <!-- Common fields for all types -->
                <div class="input-group">
                    <label>الرقم العسكري</label>
                    <input type="text" name="military_id" class="w-full p-2 border rounded" required>
                </div>

                <!-- حقل اسم الابن - يظهر فقط عند تحديث بيانات الأبناء -->
                <div class="input-group" id="child_name_field" style="display: none;">
                    <label>اسم الابن/البنت</label>
                    <input type="text" name="child_name" class="w-full p-2 border rounded">
                </div>

                <div class="input-group">
                    <label>رقم الهاتف</label>
                    <input type="tel" name="phone" class="w-full p-2 border rounded" required>
                </div>

                <div class="input-group">
                    <label>البريد الإلكتروني</label>
                    <input type="email" name="email" class="w-full p-2 border rounded" required>
                </div>

                <div class="input-group">
                    <label>سبب التحديث</label>
                    <textarea name="update_reason" class="w-full p-2 border rounded" required></textarea>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2 text-right">
                        الملفات المطلوب تحديثها
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="passport" id="passport" class="ml-2">
                            <label for="passport" class="text-sm">جواز السفر</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="id_card" id="id_card" class="ml-2">
                            <label for="id_card" class="text-sm">الهوية الإماراتية</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="photo" id="photo" class="ml-2">
                            <label for="photo" class="text-sm">الصورة الشخصية</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="marriage_contract" id="marriage_contract" class="ml-2">
                            <label for="marriage_contract" class="text-sm">عقد الزواج</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="family_book" id="family_book" class="ml-2">
                            <label for="family_book" class="text-sm">خلاصة القيد</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="update_items[]" value="residency" id="residency" class="ml-2">
                            <label for="residency" class="text-sm">نسخة من الإقامة (لغير المواطنين فقط)</label>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">* يرجى اختيار الملفات التي تريد تحديثها فقط</p>
                </div>

                <div id="file_upload_sections" class="space-y-4">
                    <!-- أقسام رفع الملفات ستظهر هنا -->
                </div>

                <div class="input-group">
                    <label>الرقم الموحد (لغير المواطنين)</label>
                    <input type="text" name="unified_number" id="unified_number" class="w-full p-2 border rounded">
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                        const uploadSection = document.getElementById('file_upload_sections');
                        const updateForSelect = document.getElementById('update_for');
                        const childNameField = document.getElementById('child_name_field');
                        const unifiedNumberInput = document.getElementById('unified_number');
                        const residencyCheckbox = document.getElementById('residency');
                        
                        function createFileInput(id, label, accept) {
                            return `
                                <div id="${id}_section" class="mb-4 p-4 bg-white rounded-lg shadow">
                                    <label class="block text-gray-700 text-sm font-bold mb-2 text-right">
                                        ${label}
                                    </label>
                                    <input type="file" name="${id}" accept="${accept}" required
                                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                    <p class="text-xs text-gray-500 mt-1">* يجب أن يكون الملف ${id === 'photo' ? 'بصيغة JPG أو PNG' : 'بصيغة PDF'}</p>
                                </div>
                            `;
                        }

                        function updateFileInputs() {
                            uploadSection.innerHTML = '';
                            checkboxes.forEach(checkbox => {
                                if (checkbox.checked) {
                                    const id = checkbox.id;
                                    const label = checkbox.nextElementSibling.textContent;
                                    const accept = id === 'photo' ? 'image/jpeg,image/png' : 'application/pdf';
                                    uploadSection.insertAdjacentHTML('beforeend', createFileInput(id, label, accept));
                                }
                            });
                        }

                        checkboxes.forEach(checkbox => {
                            checkbox.addEventListener('change', updateFileInputs);
                        });

                        updateForSelect.addEventListener('change', function() {
                            if (this.value === 'children') {
                                childNameField.style.display = 'block';
                                childNameField.querySelector('input').required = true;
                            } else {
                                childNameField.style.display = 'none';
                                childNameField.querySelector('input').required = false;
                            }
                        });

                        function toggleResidencyOption() {
                            if (unifiedNumberInput.value.trim() !== '') {
                                residencyCheckbox.parentElement.style.display = 'flex';
                            } else {
                                residencyCheckbox.checked = false;
                                residencyCheckbox.parentElement.style.display = 'none';
                            }
                        }

                        // التحقق عند تحميل الصفحة
                        toggleResidencyOption();

                        // التحقق عند تغيير قيمة الرقم الموحد
                        unifiedNumberInput.addEventListener('input', toggleResidencyOption);
                    });
                </script>

                <!-- Conditional fields -->
                <div id="spouse_fields" class="hidden">
                    <div class="input-group">
                        <label>اسم الزوج/الزوجة</label>
                        <input type="text" name="spouse_name" class="w-full p-2 border rounded">
                    </div>
                </div>

                <div id="parents_fields" class="hidden">
                    <div class="input-group">
                        <label>اسم الوالد/الوالدة</label>
                        <input type="text" name="parent_name" class="w-full p-2 border rounded">
                    </div>
                    <div class="input-group">
                        <label>نوع القرابة</label>
                        <select name="relation_type" class="w-full p-2 border rounded">
                            <option value="">اختر...</option>
                            <option value="father">الأب</option>
                            <option value="mother">الأم</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-submit">إرسال الطلب</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateForSelect = document.getElementById('update_for');
            const spouseFields = document.getElementById('spouse_fields');
            const childrenFields = document.getElementById('children_fields');
            const parentsFields = document.getElementById('parents_fields');
            const marriageContractDiv = document.getElementById('marriage_contract_div');
            const familyBookDiv = document.getElementById('family_book_div');

            // إظهار/إخفاء حقول الملفات عند تحديد/إلغاء تحديد صناديق الاختيار
            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const fileField = document.getElementById(this.value + '_field');
                    if (fileField) {
                        fileField.style.display = this.checked ? 'block' : 'none';
                        // إذا تم إلغاء تحديد الصندوق، قم بمسح الملف المحدد
                        if (!this.checked) {
                            const fileInput = fileField.querySelector('input[type="file"]');
                            if (fileInput) fileInput.value = '';
                        }
                    }
                });
            });

            updateForSelect.addEventListener('change', function() {
                // إخفاء جميع الحقول الشرطية
                spouseFields.style.display = 'none';
                childrenFields.style.display = 'none';
                parentsFields.style.display = 'none';
                marriageContractDiv.style.display = 'none';
                familyBookDiv.style.display = 'none';

                // إظهار الحقول المناسبة حسب الاختيار
                switch(this.value) {
                    case 'spouse':
                        spouseFields.style.display = 'block';
                        marriageContractDiv.style.display = 'block';
                        break;
                    case 'children':
                        childrenFields.style.display = 'block';
                        break;
                    case 'parents':
                        parentsFields.style.display = 'block';
                        familyBookDiv.style.display = 'block';
                        break;
                }
            });
        });
    </script>

    <footer>
        <div class="container mx-auto text-center">
            <p>جميع الحقوق محفوظة © {{ date('Y') }} الحرس الأميري</p>
        </div>
    </footer>
</body>
</html>
