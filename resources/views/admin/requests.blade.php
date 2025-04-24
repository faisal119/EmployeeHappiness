<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة الطلبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
<style>
    :root {
        --primary-color: #2D1E0F;
        --secondary-color: #8F7B5D;
        --background-color: #EAE3D1;
        --white: #FFFFFF;
        --hover-color: #3d2915;
        --table-border: #dcd3c3;
        --card-shadow: 0 8px 16px rgba(45, 30, 15, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: var(--background-color) !important;
        font-family: 'Tajawal', sans-serif;
        width: 100%;
        min-height: 100vh;
    }

    .admin-container {
        max-width: 1600px;
        margin: 0 auto;
        padding: 3rem;
    }

    .admin-header {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .admin-header .back-link {
        background-color: var(--primary-color);
        color: var(--white);
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-size: 16px;
        font-weight: 500;
    }

    .admin-header .back-link:hover {
        background-color: var(--hover-color);
        transform: translateY(-2px);
    }

    .admin-content {
        background-color: var(--white);
        border-radius: 20px;
        padding: 3rem;
        box-shadow: var(--card-shadow);
        margin-bottom: 3rem;
        border: 1px solid rgba(143, 123, 93, 0.1);
    }

    .admin-card {
        background: linear-gradient(to bottom, rgba(255,255,255,0.8), rgba(255,255,255,1));
        border-radius: 15px;
        padding: 2rem;
    }

    .admin-title {
        color: var(--primary-color);
        font-size: 36px;
        margin-bottom: 50px;
        text-align: center;
        font-weight: bold;
        position: relative;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    }

    .admin-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 150px;
        height: 4px;
        background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        border-radius: 2px;
    }

    .admin-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 8px;
        background-color: transparent;
    }

    .admin-table th {
        background-color: var(--primary-color);
        color: var(--white);
        padding: 25px;
        text-align: center;
        font-weight: bold;
        font-size: 17px;
        letter-spacing: 0.5px;
    }

    .admin-table th:first-child {
        border-radius: 10px 0 0 10px;
    }

    .admin-table th:last-child {
        border-radius: 0 10px 10px 0;
    }

    .admin-table td {
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8);
        border: none;
        font-size: 16px;
        text-align: center;
    }

    .admin-table tr td:first-child {
        border-radius: 10px 0 0 10px;
    }

    .admin-table tr td:last-child {
        border-radius: 0 10px 10px 0;
    }

    .admin-table tr {
        transition: all 0.3s ease;
        margin-bottom: 8px;
    }

    .admin-table tr:hover td {
        background-color: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: var(--card-shadow);
    }

    .action-button {
        background: linear-gradient(to bottom right, var(--primary-color), var(--hover-color));
        color: var(--white) !important;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-weight: 500;
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        font-size: 14px;
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        background: linear-gradient(to bottom right, var(--hover-color), var(--primary-color));
    }

    .details-button {
        background: linear-gradient(to bottom right, #8F7B5D, #6b5c45);
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .details-button:hover {
        background: linear-gradient(to bottom right, #6b5c45, #4d422f);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .admin-footer {
        background-color: var(--secondary-color);
        color: var(--white);
        padding: 25px;
        text-align: center;
        width: 100%;
        border-radius: 10px;
        margin-top: 2rem;
    }

    .admin-footer p {
        margin: 8px 0;
        font-size: 15px;
    }

    .empty-message {
        padding: 40px;
        text-align: center;
        color: #666;
        font-size: 18px;
        font-style: italic;
    }
</style>
</head>
<body>
<div class="admin-container">
    <header class="admin-header">
        <a href="/admin/dashboard" class="back-link">
            رجوع
        </a>
    </header>

    <main class="admin-content">
        <div class="admin-card">
            <h1 class="admin-title">
                @if($category == 'insurance')
                    طلبات خدمات التأمين
                @elseif($category == 'residency')
                    طلبات خدمات الإقامة
                @elseif($category == 'discount-card')
                    طلبات خدمات الخصم
                @else
                    جميع الطلبات
                @endif
            </h1>

            @if($category === 'discount-card')
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الرقم العسكري</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>نوع البطاقة</th>
                            <th>تاريخ الإنشاء</th>
                            <th>حالة الطلب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->employee_id }}</td>
                                <td>{{ $request->full_name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->card_type }}</td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($request->status === 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">قيد المراجعة</span>
                                    @elseif($request->status === 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded">تمت الموافقة</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded">مرفوض</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.requests.show', ['id' => $request->id, 'category' => $category]) }}" class="details-button">
                                        عرض التفاصيل
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">لا توجد طلبات حتى الآن</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @else
                <!-- جدول طلبات التأمين والإقامة -->
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الرقم العسكري</th>
                            <th>الاسم</th>
                            <th>البريد الإلكتروني</th>
                            <th>نوع الطلب</th>
                            <th>تاريخ الإنشاء</th>
                            <th>حالة الطلب</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $request->military_id }}</td>
                                <td>{{ $request->name }}</td>
                                <td>{{ $request->email }}</td>
                                <td>{{ $request->service_type }}</td>
                                <td>{{ $request->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @if($request->status === 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">قيد المراجعة</span>
                                    @elseif($request->status === 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded">تمت الموافقة</span>
                                    @elseif($request->status === 'rejected')
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded">مرفوض</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.requests.show', ['id' => $request->id, 'category' => $category]) }}" class="details-button">
                                        عرض التفاصيل
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">لا توجد طلبات حتى الآن</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            @endif
        </div>
    </main>

    <footer class="admin-footer">
        <p>القيادة العامة للحرس الأميري جميع الحقوق محفوظة 2025 &copy;</p>
    </footer>
</div>
</body>
</html>
