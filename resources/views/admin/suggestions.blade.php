@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold mb-6">إدارة الاقتراحات والملاحظات</h2>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        @if($suggestions->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-600">لا توجد اقتراحات حالياً</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="px-6 py-3 text-right font-semibold">الاسم</th>
                            <th class="px-6 py-3 text-right font-semibold">الرقم العسكري</th>
                            <th class="px-6 py-3 text-right font-semibold">البريد الإلكتروني</th>
                            <th class="px-6 py-3 text-right font-semibold">الحالة</th>
                            <th class="px-6 py-3 text-right font-semibold">تاريخ الإنشاء</th>
                            <th class="px-6 py-3 text-right font-semibold">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suggestions as $suggestion)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $suggestion->name }}</td>
                                <td class="px-6 py-4">{{ $suggestion->military_number ?? 'غير متوفر' }}</td>
                                <td class="px-6 py-4">{{ $suggestion->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-sm
                                        @if($suggestion->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($suggestion->status === 'reviewed') bg-blue-100 text-blue-800
                                        @else bg-green-100 text-green-800
                                        @endif">
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
                                </td>
                                <td class="px-6 py-4" dir="ltr">{{ $suggestion->created_at->format('Y-m-d') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.suggestions.show', $suggestion) }}" 
                                           class="text-blue-600 hover:text-blue-800">عرض</a>
                                        <form action="{{ route('admin.suggestions.destroy', $suggestion) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('هل أنت متأكد من حذف هذا الاقتراح؟');"
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">حذف</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $suggestions->links() }}
            </div>
        @endif
    </div>
</div>
@endsection 