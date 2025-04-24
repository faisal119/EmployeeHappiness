<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تفاصيل الطلب</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Droid Arabic Kufi';
            src: url('/fonts/DroidArabicKufi.woff2') format('woff2');
        }
        body {
            font-family: 'Droid Arabic Kufi', sans-serif;
            background-color: #EAE3D1;
        }
        .admin-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        .admin-card {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .status-badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
        }
        .status-pending {
            background-color: #FEF3C7;
            color: #92400E;
        }
        .status-approved {
            background-color: #DEF7EC;
            color: #03543F;
        }
        .status-rejected {
            background-color: #FDE8E8;
            color: #9B1C1C;
        }
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background-color: #2D1E0F;
            color: white;
        }
        .btn-primary:hover {
            background-color: #3D2E1F;
        }
        .btn-secondary {
            background-color: #8F7B5D;
            color: white;
        }
        .btn-secondary:hover {
            background-color: #7F6B4D;
        }
        .file-link {
            color: #2D1E0F;
            text-decoration: underline;
        }
        .file-link:hover {
            color: #3D2E1F;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">تفاصيل الطلب</h1>
            <a href="{{ route('admin.requests', ['category' => 
                $request instanceof \App\Models\ResidencyRequest ? 'residency' : 
                ($request instanceof \App\Models\DiscountCardRequest ? 'discount-card' : 'insurance')
            ]) }}" class="btn btn-secondary">رجوع</a>
        </div>

        @if($request instanceof \App\Models\DiscountCardRequest)
            <div class="admin-card">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- معلومات الطلب الأساسية -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>رقم الطلب:</strong> #{{ $request->id }}</p>
                            <p><strong>نوع الطلب:</strong> طلب بطاقة خصم</p>
                            <p><strong>نوع البطاقة:</strong> {{ $request->card_type }}</p>
                            <p><strong>تاريخ الطلب:</strong> {{ $request->created_at->format('Y-m-d') }}</p>
                            <p><strong>حالة الطلب:</strong>
                                <span class="status-badge {{ $request->status == 'pending' ? 'status-pending' : ($request->status == 'approved' ? 'status-approved' : 'status-rejected') }}">
                                    @switch($request->status)
                                        @case('pending')
                                            قيد المراجعة
                                            @break
                                        @case('approved')
                                            تمت الموافقة
                                            @break
                                        @case('rejected')
                                            مرفوض
                                            @break
                                        @default
                                            قيد المراجعة
                                    @endswitch
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- معلومات مقدم الطلب -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات مقدم الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>الاسم:</strong> {{ $request->full_name }}</p>
                            <p><strong>الرقم العسكري:</strong> {{ $request->employee_id }}</p>
                            <p><strong>العمر:</strong> {{ $request->age }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $request->email }}</p>
                            <p><strong>الإمارة:</strong> {{ $request->emirate }}</p>
                            <p><strong>المنطقة:</strong> {{ $request->area }}</p>
                            <p><strong>هل الأب على قيد الحياة؟:</strong> {{ $request->father_alive }}</p>
                            <p><strong>هل الأم على قيد الحياة؟:</strong> {{ $request->mother_alive }}</p>
                            <p><strong>هل سبق الحصول على بطاقة خصم؟:</strong> {{ $request->previous_card }}</p>
                            <p><strong>الحالة الاجتماعية:</strong> {{ $request->married }}</p>
                            @if($request->married === 'نعم')
                                <p><strong>عدد الأبناء:</strong> {{ $request->children_count }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- المرفقات -->
                    <div class="md:col-span-2">
                        <h2 class="text-xl font-bold mb-4">المرفقات</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($request->passport_copy)
                                <div class="p-4 bg-gray-50 rounded">
                                    <strong>نسخة جواز السفر:</strong>
                                    <a href="/storage/discount_card_files/{{ basename($request->passport_copy) }}" target="_blank" class="file-link block mt-2">
                                        <div class="flex items-center justify-center p-4 bg-white rounded border">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            عرض الملف
                                        </div>
                                    </a>
                                </div>
                            @endif

                            @if($request->emirates_id)
                                <div class="p-4 bg-gray-50 rounded">
                                    <strong>نسخة الهوية الإماراتية:</strong>
                                    <a href="/storage/discount_card_files/{{ basename($request->emirates_id) }}" target="_blank" class="file-link block mt-2">
                                        <div class="flex items-center justify-center p-4 bg-white rounded border">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                            </svg>
                                            عرض الملف
                                        </div>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- تحديث حالة الطلب -->
                    <div class="md:col-span-2 mt-8">
                        <h2 class="text-xl font-bold mb-4">تحديث حالة الطلب</h2>
                        <form action="{{ route('admin.requests.update-status', ['id' => $request->id]) }}" 
                              method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من تحديث حالة الطلب؟');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="category" value="{{ 
                                $request instanceof \App\Models\ResidencyRequest ? 'residency' : 
                                ($request instanceof \App\Models\DiscountCardRequest ? 'discount-card' : 'insurance')
                            }}">
                            <div class="form-group mb-4">
                                <label for="status" class="block mb-2">الحالة:</label>
                                <select name="status" id="status" class="form-control w-full p-2 border rounded">
                                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>موافقة</option>
                                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="notes" class="block mb-2">ملاحظات:</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control w-full p-2 border rounded">{{ old('notes', $request->notes ?? '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">تحديث الحالة</button>
                        </form>
                    </div>
                </div>
            </div>
        @elseif($request instanceof \App\Models\ResidencyRequest)
            <!-- عرض تفاصيل طلب الإقامة -->
            <div class="admin-card">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- معلومات الطلب الأساسية -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>رقم الطلب:</strong> #{{ $request->id }}</p>
                            <p><strong>نوع الطلب:</strong> 
                                @switch($request->service_type)
                                    @case('new-residency')
                                        إقامة جديدة
                                        @break
                                    @case('renew-residency')
                                        تجديد إقامة
                                        @break
                                    @case('visa-request')
                                        طلب تأشيرة
                                        @break
                                    @case('sponsorship-transfer')
                                        نقل كفالة
                                        @break
                                    @default
                                        {{ $request->service_type }}
                                @endswitch
                            </p>
                            <p><strong>تاريخ الطلب:</strong> {{ $request->created_at->format('Y-m-d') }}</p>
                            <p><strong>حالة الطلب:</strong>
                                <span class="status-badge {{ $request->status == 'pending' ? 'status-pending' : ($request->status == 'approved' ? 'status-approved' : 'status-rejected') }}">
                                    @switch($request->status)
                                        @case('pending')
                                            قيد المراجعة
                                            @break
                                        @case('approved')
                                            تمت الموافقة
                                            @break
                                        @case('rejected')
                                            مرفوض
                                            @break
                                        @default
                                            قيد المراجعة
                                    @endswitch
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- معلومات مقدم الطلب -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات مقدم الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>الاسم:</strong> {{ $request->name }}</p>
                            <p><strong>الرقم العسكري:</strong> {{ $request->military_id }}</p>
                            <p><strong>الرقم الموحد:</strong> {{ $request->unified_number }}</p>
                            <p><strong>الجنسية:</strong> {{ $request->nationality }}</p>
                            <p><strong>البريد الإلكتروني:</strong> {{ $request->email }}</p>
                            <p><strong>رقم الهاتف:</strong> {{ $request->phone }}</p>
                        </div>
                    </div>

                    <!-- المرفقات -->
                    <div class="md:col-span-2">
                        <h2 class="text-xl font-bold mb-4">المرفقات</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @php
                                $files = [
                                    'passport' => 'جواز السفر',
                                    'id_card' => 'بطاقة الهوية',
                                    'current_residency' => 'الإقامة الحالية',
                                    'pakistani_id' => 'الهوية الباكستانية',
                                    'medical_result' => 'الفحص الطبي',
                                    'acquaintance_document' => 'وثيقة التعارف'
                                ];
                            @endphp

                            @foreach($files as $key => $title)
                                @if($request->$key)
                                    <div class="p-4 bg-gray-50 rounded">
                                        <strong>{{ $title }}:</strong>
                                        <a href="{{ Storage::url($request->$key) }}" target="_blank" class="file-link block mt-2">
                                            <div class="flex items-center justify-center p-4 bg-white rounded border">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                </svg>
                                                عرض الملف
                                            </div>
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <!-- تحديث حالة الطلب -->
                    <div class="md:col-span-2 mt-8">
                        <h2 class="text-xl font-bold mb-4">تحديث حالة الطلب</h2>
                        
                        @if(session('success'))
                            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('admin.requests.update-status', ['id' => $request->id]) }}" 
                              method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="category" value="{{ 
                                $request instanceof \App\Models\ResidencyRequest ? 'residency' : 
                                ($request instanceof \App\Models\DiscountCardRequest ? 'discount-card' : 'insurance')
                            }}">
                            <div class="form-group mb-4">
                                <label for="status" class="block mb-2 font-semibold">الحالة:</label>
                                <select name="status" id="status" class="form-control w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">
                                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>موافقة</option>
                                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="notes" class="block mb-2 font-semibold">ملاحظات:</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control w-full p-2 border rounded focus:ring-2 focus:ring-blue-500">{{ old('notes', $request->notes ?? '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 w-full" onclick="return confirm('هل أنت متأكد من تحديث حالة الطلب؟');">تحديث الحالة</button>
                        </form>
                    </div>
                </div>
            </div>
        @elseif($request instanceof \App\Models\InsuranceRequest)
            <!-- عرض تفاصيل طلب التأمين -->
            <div class="admin-card">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- معلومات الطلب الأساسية -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>رقم الطلب:</strong> #{{ $request->id }}</p>
                            <p><strong>نوع الطلب:</strong> 
                                @switch($request->service_type)
                                    @case('new')
                                        طلب تأمين جديد
                                        @break
                                    @case('add-spouse')
                                        إضافة زوج/زوجة
                                        @break
                                    @case('add-children')
                                        إضافة أبناء
                                        @break
                                    @case('add-parents')
                                        إضافة والدين
                                        @break
                                    @case('update')
                                        تحديث بيانات
                                        @break
                                    @case('certificate')
                                        طلب شهادة
                                        @break
                                    @default
                                        {{ $request->service_type }}
                                @endswitch
                            </p>
                            <p><strong>تاريخ الطلب:</strong> {{ $request->created_at->format('Y-m-d') }}</p>
                            <p><strong>حالة الطلب:</strong>
                                <span class="status-badge {{ $request->status == 'pending' ? 'status-pending' : ($request->status == 'approved' ? 'status-approved' : 'status-rejected') }}">
                                    @switch($request->status)
                                        @case('pending')
                                            قيد المراجعة
                                            @break
                                        @case('approved')
                                            تمت الموافقة
                                            @break
                                        @case('rejected')
                                            مرفوض
                                            @break
                                        @default
                                            قيد المراجعة
                                    @endswitch
                                </span>
                            </p>
                        </div>
                    </div>

                    <!-- معلومات مقدم الطلب -->
                    <div>
                        <h2 class="text-xl font-bold mb-4">معلومات مقدم الطلب</h2>
                        <div class="space-y-3">
                            <p><strong>الرقم العسكري:</strong> {{ $request->military_id }}</p>
                            @if($request->unified_number)
                            <p><strong>الرقم الموحد (لغير المواطنين):</strong> {{ $request->unified_number }}</p>
                            @endif
                            <p><strong>البريد الإلكتروني:</strong> {{ $request->email }}</p>
                            <p><strong>رقم الهاتف:</strong> {{ $request->phone }}</p>
                            @if($request->child_name)
                            <p><strong>اسم الابن/الابنة:</strong> {{ $request->child_name }}</p>
                            @else
                            <p><strong>الاسم:</strong> {{ $request->name }}</p>
                            @endif
                            @if($request->hiring_date)
                            <p><strong>تاريخ التعيين:</strong> {{ $request->hiring_date }}</p>
                            @endif
                            @if($request->marital_status)
                                <p><strong>الحالة الاجتماعية:</strong> 
                                    @switch($request->marital_status)
                                        @case('single')
                                            أعزب/عزباء
                                            @break
                                        @case('married')
                                            متزوج/ة
                                            @break
                                        @case('divorced')
                                            مطلق/ة
                                            @break
                                        @case('widowed')
                                            أرمل/ة
                                            @break
                                        @default
                                            {{ $request->marital_status }}
                                    @endswitch
                                </p>
                            @endif
                            @if($request->service_type === 'add-parents' && $request->relation_type)
                                <p><strong>نوع القرابة:</strong> 
                                    @switch($request->relation_type)
                                        @case('father')
                                            الأب
                                            @break
                                        @case('mother')
                                            الأم
                                            @break
                                        @default
                                            {{ $request->relation_type }}
                                    @endswitch
                                </p>
                            @endif
                            @if($request->service_type === 'certificate')
                                <p><strong>الغرض من الشهادة:</strong> {{ $request->description }}</p>
                            @endif
                            @if($request->service_type === 'update')
                                <p><strong>سبب التحديث:</strong> {{ $request->update_reason }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- المرفقات -->
                    <div class="mt-8">
                        <h3 class="text-xl font-bold mb-4">المرفقات</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- المستندات الأساسية -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <h4 class="text-lg font-semibold mb-4">المستندات الأساسية</h4>
                                <div class="space-y-4">
                                    @if($request->passport)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">جواز السفر</span>
                                        <a href="{{ route('admin.files.show', basename($request->passport)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif

                                    @if($request->id_card)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">الهوية الإماراتية</span>
                                        <a href="{{ route('admin.files.show', basename($request->id_card)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif

                                    @if($request->unified_number && $request->residency)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">نسخة من الإقامة</span>
                                        <a href="{{ route('admin.files.show', basename($request->residency)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- الصور والمستندات الإضافية -->
                            <div class="bg-white p-6 rounded-lg shadow">
                                <h4 class="text-lg font-semibold mb-4">الصور والمستندات الإضافية</h4>
                                <div class="space-y-4">
                                    @if($request->photo)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">الصورة الشخصية</span>
                                        <a href="{{ route('admin.files.show', basename($request->photo)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض الصورة
                                        </a>
                                    </div>
                                    @endif

                                    @if($request->marriage_contract)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">عقد الزواج</span>
                                        <a href="{{ route('admin.files.show', basename($request->marriage_contract)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif

                                    @if($request->birth_certificate)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">شهادة الميلاد</span>
                                        <a href="{{ route('admin.files.show', basename($request->birth_certificate)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif

                                    @if($request->family_book)
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                        <span class="font-medium">خلاصة القيد</span>
                                        <a href="{{ route('admin.files.show', basename($request->family_book)) }}" 
                                           target="_blank" 
                                           class="bg-[#2D1E0F] text-white px-4 py-2 rounded hover:bg-[#3D2E1F] transition">
                                            عرض المستند
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- تحديث حالة الطلب -->
                    <div class="md:col-span-2 mt-8">
                        <h2 class="text-xl font-bold mb-4">تحديث حالة الطلب</h2>
                        <form action="{{ route('admin.requests.update-status', ['id' => $request->id]) }}" 
                              method="POST" 
                              onsubmit="return confirm('هل أنت متأكد من تحديث حالة الطلب؟');">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="category" value="{{ 
                                $request instanceof \App\Models\ResidencyRequest ? 'residency' : 
                                ($request instanceof \App\Models\DiscountCardRequest ? 'discount-card' : 'insurance')
                            }}">
                            <div class="form-group mb-4">
                                <label for="status" class="block mb-2">الحالة:</label>
                                <select name="status" id="status" class="form-control w-full p-2 border rounded">
                                    <option value="pending" {{ $request->status == 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                    <option value="approved" {{ $request->status == 'approved' ? 'selected' : '' }}>موافقة</option>
                                    <option value="rejected" {{ $request->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="notes" class="block mb-2">ملاحظات:</label>
                                <textarea name="notes" id="notes" rows="3" class="form-control w-full p-2 border rounded" required>{{ old('notes', $request->notes ?? '') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4">تحديث الحالة</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
</body>
</html> 