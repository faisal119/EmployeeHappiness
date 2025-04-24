@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">تفاصيل الاقتراح</h2>
            <a href="{{ route('admin.suggestions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">
                عودة للقائمة
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">الاسم</label>
                    <p class="mt-1 text-lg">{{ $suggestion->name }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">البريد الإلكتروني</label>
                    <p class="mt-1 text-lg">{{ $suggestion->email }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">رقم الهاتف</label>
                    <p class="mt-1 text-lg">{{ $suggestion->phone ?? 'غير متوفر' }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">الرقم العسكري</label>
                    <p class="mt-1 text-lg">{{ $suggestion->military_number ?? 'غير متوفر' }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">تاريخ الإنشاء</label>
                    <p class="mt-1 text-lg">{{ $suggestion->created_at->format('Y-m-d H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">آخر تحديث</label>
                    <p class="mt-1 text-lg">{{ $suggestion->updated_at->format('Y-m-d H:i') }}</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">الحالة</label>
                    <p class="mt-1">
                        <span class="px-3 py-1 rounded-full text-sm
                            @if($suggestion->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($suggestion->status === 'reviewed') bg-blue-100 text-blue-800
                            @else bg-green-100 text-green-800
                            @endif">
                            {{ $suggestion->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">الاقتراح</label>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="whitespace-pre-wrap">{{ $suggestion->suggestion }}</p>
            </div>
        </div>

        @if($suggestion->admin_notes)
        <div class="mt-8">
            <label class="block text-sm font-medium text-gray-700 mb-2">ملاحظات الإدارة</label>
            <div class="bg-gray-50 p-4 rounded-lg">
                <p class="whitespace-pre-wrap">{{ $suggestion->admin_notes }}</p>
            </div>
        </div>
        @endif

        <div class="mt-8">
            <form action="{{ route('admin.suggestions.update', $suggestion) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">تحديث الحالة</label>
                    <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brown-500 focus:ring-brown-500">
                        <option value="pending" {{ $suggestion->status === 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                        <option value="reviewed" {{ $suggestion->status === 'reviewed' ? 'selected' : '' }}>تمت المراجعة</option>
                        <option value="implemented" {{ $suggestion->status === 'implemented' ? 'selected' : '' }}>تم التنفيذ</option>
                    </select>
                </div>

                <div>
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700">إضافة ملاحظات</label>
                    <textarea name="admin_notes" id="admin_notes" rows="4" 
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brown-500 focus:ring-brown-500">{{ $suggestion->admin_notes }}</textarea>
                </div>

                <div class="flex justify-between">
                    <button type="submit" class="bg-brown-600 text-white px-4 py-2 rounded-lg hover:bg-brown-700">
                        حفظ التغييرات
                    </button>

                    <form action="{{ route('admin.suggestions.destroy', $suggestion) }}" method="POST" class="inline"
                        onsubmit="return confirm('هل أنت متأكد من حذف هذا الاقتراح؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                            حذف الاقتراح
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 