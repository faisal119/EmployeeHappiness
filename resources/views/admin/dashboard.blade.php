<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - إدارة الطلبات</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #EAE3D1;
            font-family: 'Tajawal', sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background-color: #2D1E0F;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .header-logo {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 60px;
        }

        .header-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .header-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-right: 1rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-name {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        .logout-button {
            background-color: #8F7B5D;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-family: 'Tajawal', sans-serif;
            font-weight: bold;
            transition: background-color 0.2s;
        }

        .logout-button:hover {
            background-color: #6B5B43;
        }

        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        h2 {
            color: #2D1E0F;
            text-align: center;
            font-size: 28px;
            margin-bottom: 2rem;
            font-weight: bold;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        .card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            text-align: center;
            text-decoration: none;
            color: #2D1E0F;
            font-weight: bold;
            font-size: 1.2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        footer {
            background-color: #8F7B5D;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: auto;
        }

        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .chart-title {
            color: #2D1E0F;
            text-align: center;
            font-size: 20px;
            margin-bottom: 1rem;
            font-weight: bold;
        }

        .statistics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-top: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stat-title {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #2D1E0F;
        }
    </style>
</head>
<body>
    <header>
        <span class="header-title">لوحة التحكم - إدارة الطلبات</span>
        <div class="header-logo">
            <img src="/logo.png" alt="شعار الحرس الأميري">
        </div>
        <div class="user-info">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-button">تسجيل خروج</button>
            </form>
        </div>
    </header>

    <div class="container">
        <h2>إدارة الطلبات</h2>

        <div class="grid">
            <a href="{{ route('admin.requests') }}?category=insurance" class="card">
                طلبات خدمات التأمين
            </a>

            <a href="{{ route('admin.requests') }}?category=residency" class="card">
                طلبات خدمات الإقامة
            </a>

            <a href="{{ route('admin.requests') }}?category=discount-card" class="card">
                طلبات خدمات الخصم
            </a>

            <a href="{{ route('admin.users.index') }}" class="card">
                إدارة المشرفين
            </a>

            <a href="{{ route('admin.statistics') }}" class="card" onclick="event.preventDefault(); window.location.href='/admin/statistics';">
                إحصائيات المشرفين
            </a>

            <a href="{{ route('admin.suggestions.index') }}" class="card">
                الاقتراحات والملاحظات
            </a>
        </div>

        @if(isset($statistics))
        <div class="chart-container">
            <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 1rem;">
                <label for="statsFilter" style="margin-left: 8px; font-weight: bold; color: #2D1E0F;">تصفية حسب:</label>
                <select id="statsFilter" style="padding: 8px 16px; border-radius: 8px; border: 1px solid #ccc; font-family: 'Tajawal', sans-serif; font-size: 1rem;">
                    <option value="all">الكل</option>
                    <option value="year">سنة محددة</option>
                    <option value="month">شهر محدد</option>
                </select>
                <select id="yearSelect" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #ccc; font-family: 'Tajawal', sans-serif; font-size: 1rem; margin-right: 8px; display: none;"></select>
                <select id="monthSelect" style="padding: 8px 12px; border-radius: 8px; border: 1px solid #ccc; font-family: 'Tajawal', sans-serif; font-size: 1rem; margin-right: 8px; display: none;"></select>
            </div>
            <h3 class="chart-title">إحصائيات الطلبات</h3>
            <canvas id="requestsChart"></canvas>

            <div class="statistics-grid">
                <div class="stat-card">
                    <div class="stat-title">طلبات التأمين</div>
                    <div class="stat-value" id="insurance-total">{{ $statistics['insurance']['total'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">طلبات الإقامة</div>
                    <div class="stat-value" id="residency-total">{{ $statistics['residency']['total'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">طلبات الخصم</div>
                    <div class="stat-value" id="discount-total">{{ $statistics['discount_card']['total'] }}</div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>

    @if(isset($statistics))
    <script>
        // إعداد السنوات والشهور
        const yearSelect = document.getElementById('yearSelect');
        const monthSelect = document.getElementById('monthSelect');
        const statsFilter = document.getElementById('statsFilter');
        // السنوات من 2015 حتى السنة الحالية
        const currentYear = new Date().getFullYear();
        yearSelect.innerHTML = '';
        for(let y = currentYear; y >= 2015; y--) {
            const opt = document.createElement('option');
            opt.value = y;
            opt.textContent = y;
            yearSelect.appendChild(opt);
        }
        // الشهور بالعربي
        const months = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
        monthSelect.innerHTML = '';
        for(let m = 1; m <= 12; m++) {
            const opt = document.createElement('option');
            opt.value = m;
            opt.textContent = months[m-1];
            monthSelect.appendChild(opt);
        }
        // إظهار/إخفاء القوائم حسب الفلتر
        statsFilter.addEventListener('change', function() {
            if(this.value === 'year') {
                yearSelect.style.display = '';
                monthSelect.style.display = 'none';
            } else if(this.value === 'month') {
                yearSelect.style.display = '';
                monthSelect.style.display = '';
            } else {
                yearSelect.style.display = 'none';
                monthSelect.style.display = 'none';
            }
            fetchStatistics();
        });
        yearSelect.addEventListener('change', fetchStatistics);
        monthSelect.addEventListener('change', fetchStatistics);
        // عند تحميل الصفحة، إخفاء القوائم
        statsFilter.dispatchEvent(new Event('change'));

        // تحديث الإحصائيات عبر AJAX
        let chartInstance = null;
        // عند تحميل الصفحة أول مرة، أنشئ الرسم البياني
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('requestsChart').getContext('2d');
            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['طلبات التأمين', 'طلبات الإقامة', 'طلبات الخصم'],
                    datasets: [
                        {
                            label: 'قيد المراجعة',
                            data: [{{ $statistics['insurance']['pending'] }}, {{ $statistics['residency']['pending'] }}, {{ $statistics['discount_card']['pending'] }}],
                            backgroundColor: '#FFC107',
                        },
                        {
                            label: 'مقبول',
                            data: [{{ $statistics['insurance']['approved'] }}, {{ $statistics['residency']['approved'] }}, {{ $statistics['discount_card']['approved'] }}],
                            backgroundColor: '#4CAF50',
                        },
                        {
                            label: 'مرفوض',
                            data: [{{ $statistics['insurance']['rejected'] }}, {{ $statistics['residency']['rejected'] }}, {{ $statistics['discount_card']['rejected'] }}],
                            backgroundColor: '#F44336',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: { font: { family: 'Tajawal' } }
                        },
                        title: { display: false }
                    },
                    scales: {
                        x: { ticks: { font: { family: 'Tajawal' } } },
                        y: { beginAtZero: true, ticks: { font: { family: 'Tajawal' } } }
                    }
                }
            });
        });
        function fetchStatistics() {
            let filter = statsFilter.value;
            let year = yearSelect.value;
            let month = monthSelect.value;
            let params = { filter };
            if(filter === 'year') params.year = year;
            if(filter === 'month') { params.year = year; params.month = month; }
            fetch('/admin/dashboard/statistics?' + new URLSearchParams(params), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.json())
            .then(data => {
                // تحديث الصناديق
                document.getElementById('insurance-total').textContent = data.insurance.total;
                document.getElementById('residency-total').textContent = data.residency.total;
                document.getElementById('discount-total').textContent = data.discount_card.total;
                // تحديث بيانات الرسم البياني فقط
                if(chartInstance) {
                    chartInstance.data.datasets[0].data = [data.insurance.pending, data.residency.pending, data.discount_card.pending];
                    chartInstance.data.datasets[1].data = [data.insurance.approved, data.residency.approved, data.discount_card.approved];
                    chartInstance.data.datasets[2].data = [data.insurance.rejected, data.residency.rejected, data.discount_card.rejected];
                    chartInstance.update();
                }
            });
        }
    </script>
    @endif
</body>
</html>
