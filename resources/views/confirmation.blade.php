
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الطلب</title>
    <link href="{{ asset('css/tailwind.css') }}" rel="stylesheet">
</head>
<body class="bg-green-100 flex items-center justify-center h-screen">
    <div class="text-center bg-white p-6 rounded shadow-md">
        <h2 class="text-2xl font-bold text-green-600">تم إرسال الطلب بنجاح!</h2>
        <p class="mt-4">سنقوم بمراجعة طلبك والتواصل معك قريبًا.</p>
        <a href="{{ url('/') }}" class="mt-4 inline-block bg-blue-500 text-white px-6 py-2 rounded">العودة للصفحة الرئيسية</a>
    </div>
</body>
</html>
