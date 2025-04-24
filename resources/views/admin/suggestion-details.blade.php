@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">تفاصيل الاقتراح</h1>
            <a href="{{ route('admin.suggestions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600">رجوع</a>
        </div>

        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-lg font-semibold mb-4">معلومات مقدم الاقتراح</h2>
                    <div class="space-y-3">
                        <p><strong class="text-gray-600">الاسم:</strong> {{ $suggestion->name }}</p>
                        <p><strong class="text-gray-600">البريد الإلكتروني:</strong> {{ $suggestion->email }}</p>
                        <p><strong class="text-gray-600">رقم الهاتف:</strong> {{ $suggestion->phone ?: 'غير متوفر' }}</p>
                        <p><strong class="text-gray-600">الرقم العسكري:</strong> {{ $suggestion->military_number ?: 'غير متوفر' }}</p>
                    </div>
                </div>

                <div>
                    <h2 class="text-lg font-semibold mb-4">معلومات الاقتراح</h2>
                    <div class="space-y-3">
                        <p><strong class="text-gray-600">تاريخ التقديم:</strong> {{ $suggestion->created_at->format('Y-m-d') }}</p>
                        <p><strong class="text-gray-600">الحالة:</strong>
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $suggestion->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                   ($suggestion->status === 'reviewed' ? 'bg-blue-100 text-blue-800' : 
                                    'bg-green-100 text-green-800') }}">
                                @switch($suggestion->status)
                                    @case('pending')
                                        قيد المراجعة
                                        @break
                                    @case('reviewed')
                                        تمت المراجعة
                                        @break
                                    @case('implemented')
                                        تم التنفيذ
                                        @break
                                @endswitch
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold mb-4">نص الاقتراح</h2>
                <div class="bg-gray-50 p-4 rounded-md">
                    {{ $suggestion->suggestion }}
                </div>
            </div>

            <div class="border-t pt-6">
                <h2 class="text-lg font-semibold mb-4">تحديث حالة الاقتراح</h2>
                <form action="{{ route('admin.suggestions.update', $suggestion->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">الحالة</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brown-500">
                                <option value="pending" {{ $suggestion->status === 'pending' ? 'selected' : '' }}>قيد المراجعة</option>
                                <option value="reviewed" {{ $suggestion->status === 'reviewed' ? 'selected' : '' }}>تمت المراجعة</option>
                                <option value="implemented" {{ $suggestion->status === 'implemented' ? 'selected' : '' }}>تم التنفيذ</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700 mb-2">ملاحظات الإدارة</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brown-500">{{ $suggestion->admin_notes }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-brown-600 text-white px-6 py-2 rounded-md hover:bg-brown-700">
                            حفظ التغييرات
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 