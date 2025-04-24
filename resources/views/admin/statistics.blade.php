<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إحصائيات المشرفين</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Tajawal', sans-serif;
            background-color: #EAE3D1;
        }
        .header {
            background-color: #2D1E0F;
            color: white;
            padding: 15px;
            margin-bottom: 30px;
        }
        .stats-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stats-number {
            font-size: 24px;
            font-weight: bold;
            color: #2D1E0F;
        }
        .table {
            background: white;
            border-radius: 10px;
        }
        .modal-header {
            background-color: #2D1E0F;
            color: white;
        }
        .btn-view-transactions {
            background-color: #2D1E0F;
            color: white;
        }
        .btn-view-transactions:hover {
            background-color: #4a3420;
            color: white;
        }
        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">إحصائيات المشرفين</h1>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-light">عودة للوحة التحكم</a>
            </div>
        </div>
    </div>

    <div class="container">
        @if(session('error'))
            <div class="alert alert-danger mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- إحصائيات عامة -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <h5>إجمالي المعاملات</h5>
                    <div class="stats-number">{{ $totalRequests }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <h5>المعاملات المقبولة</h5>
                    <div class="stats-number">{{ $approvedRequests }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card text-center">
                    <h5>المعاملات المرفوضة</h5>
                    <div class="stats-number">{{ $rejectedRequests }}</div>
                </div>
            </div>
        </div>

        <!-- جدول المشرفين -->
        <div class="stats-card">
            <h4 class="mb-4">تفاصيل المعاملات حسب المشرف</h4>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>اسم المشرف</th>
                            <th>إجمالي المعاملات</th>
                            <th>المعاملات المقبولة</th>
                            <th>المعاملات المرفوضة</th>
                            <th>المعاملات الأخيرة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->total_requests }}</td>
                                <td>{{ $admin->approved_requests }}</td>
                                <td>{{ $admin->rejected_requests }}</td>
                                <td>
                                    <button type="button" class="btn btn-view-transactions btn-sm" data-bs-toggle="modal" data-bs-target="#transactionsModal{{ $admin->id }}">
                                        عرض المعاملات
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">لا توجد إحصائيات متاحة</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modals for Recent Transactions -->
    @foreach($admins as $admin)
        <div class="modal fade" id="transactionsModal{{ $admin->id }}" tabindex="-1" aria-labelledby="transactionsModalLabel{{ $admin->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="transactionsModalLabel{{ $admin->id }}">المعاملات الأخيرة - {{ $admin->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>رقم الطلب</th>
                                        <th>نوع الطلب</th>
                                        <th>اسم مقدم الطلب</th>
                                        <th>الرقم العسكري</th>
                                        <th>الحالة القديمة</th>
                                        <th>الحالة الجديدة</th>
                                        <th>التاريخ</th>
                                        <th>ملاحظات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($admin->recent_transactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction['request_id'] }}</td>
                                            <td>{{ $transaction['request_type'] }}</td>
                                            <td>{{ $transaction['applicant_name'] }}</td>
                                            <td>{{ $transaction['military_id'] }}</td>
                                            <td>{{ $transaction['old_status'] }}</td>
                                            <td>{{ $transaction['new_status'] }}</td>
                                            <td>{{ $transaction['created_at']->format('Y-m-d H:i') }}</td>
                                            <td>{{ $transaction['notes'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">لا توجد معاملات حديثة</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 