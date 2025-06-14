<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تغيير كلمة المرور</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex justify-center items-center min-h-screen">

    <div class="w-full max-w-md bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold text-center mb-4">تغيير كلمة المرور</h2>

        @if(session('success'))
            <p class="text-green-600 text-center">{{ session('success') }}</p>
        @endif

        @if($errors->any())
            <div class="text-red-600 text-center">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ url('/admin/change-password') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">كلمة المرور الحالية:</label>
                <input type="password" name="current_password" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700">كلمة المرور الجديدة:</label>
                <input type="password" name="new_password" required class="w-full p-2 border rounded">
            </div>

            <div>
                <label class="block text-gray-700">تأكيد كلمة المرور الجديدة:</label>
                <input type="password" name="confirm_password" required class="w-full p-2 border rounded">nfgnfg

            <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                تحديث كلمة المرور
            </button>
        </form>
    </div>

</body>
</html>
