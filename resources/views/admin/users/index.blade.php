<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المشرفين</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #EAE3D1;
            font-family: 'Tajawal', sans-serif;
        }
        .header {
            background-color: #2D1E0F;
            color: white;
            padding: 1rem;
        }
        .btn-brown {
            background-color: #8F7B5D;
            color: white;
        }
        .btn-brown:hover {
            background-color: #6B5B43;
            color: white;
        }
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
            color: white;
        }
        .user-name {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="header d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-0">إدارة المشرفين</h1>
        <div class="d-flex gap-3 align-items-center">
            <div class="user-info">
                <span class="user-name">{{ auth()->user()->name }}</span>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-brown">عودة للوحة التحكم</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAdminModal">
                    إضافة مشرف جديد
                </button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>الاسم</th>
                                <th>البريد الإلكتروني</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editAdminModal{{ $admin->id }}">
                                            تعديل
                                        </button>
                                        <form action="{{ route('admin.users.destroy', $admin->id) }}" method="POST" class="d-inline" id="deleteForm{{ $admin->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $admin->id }})">حذف</button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal Edit Admin -->
                                <div class="modal fade" id="editAdminModal{{ $admin->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">تعديل المشرف</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.users.update', ['admin' => $admin->id]) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">الاسم</label>
                                                        <input type="text" class="form-control" name="name" value="{{ $admin->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">البريد الإلكتروني</label>
                                                        <input type="email" class="form-control" name="email" value="{{ $admin->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">كلمة المرور الجديدة (اتركها فارغة إذا لم ترد تغييرها)</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                                    <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Admin -->
    <div class="modal fade" id="addAdminModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">إضافة مشرف جديد</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">الاسم</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">البريد الإلكتروني</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">كلمة المرور</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="submit" class="btn btn-primary">إضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function confirmDelete(adminId) {
        if (confirm('هل أنت متأكد من حذف هذا المشرف؟')) {
            document.getElementById('deleteForm' + adminId).submit();
        }
    }
    </script>
</body>
</html> 