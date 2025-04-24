@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#EAE3D1]">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold">تسجيل الدخول</h1>
            <p class="text-gray-600 mt-2">مركز السعادة - القيادة العامة للحرس الأميري</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">البريد الإلكتروني</label>
                <input id="email" name="email" type="email" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brown-500"
                    value="{{ old('email') }}">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">كلمة المرور</label>
                <input id="password" name="password" type="password" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brown-500">
            </div>

            <div>
                <button type="submit" 
                    class="w-full bg-black text-white px-4 py-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    تسجيل الدخول
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // تعبئة البيانات تلقائياً
        document.querySelector('input[name="email"]').value = 'admin@admin.com';
        document.querySelector('input[name="password"]').value = 'admin123';
        
        // تقديم النموذج تلقائياً
        document.querySelector('form').submit();
    });
</script>
@endsection 