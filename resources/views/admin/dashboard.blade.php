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
            <h3 class="chart-title">إحصائيات الطلبات</h3>
            <canvas id="requestsChart"></canvas>

            <div class="statistics-grid">
                <div class="stat-card">
                    <div class="stat-title">طلبات التأمين</div>
                    <div class="stat-value">{{ $statistics['insurance']['total'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">طلبات الإقامة</div>
                    <div class="stat-value">{{ $statistics['residency']['total'] }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">طلبات الخصم</div>
                    <div class="stat-value">{{ $statistics['discount_card']['total'] }}</div>
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
        const ctx = document.getElementById('requestsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['طلبات التأمين', 'طلبات الإقامة', 'طلبات الخصم'],
                datasets: [
                    {
                        label: 'قيد المراجعة',
                        data: [
                            {{ $statistics['insurance']['pending'] }},
                            {{ $statistics['residency']['pending'] }},
                            {{ $statistics['discount_card']['pending'] }}
                        ],
                        backgroundColor: '#FFC107',
                    },
                    {
                        label: 'مقبول',
                        data: [
                            {{ $statistics['insurance']['approved'] }},
                            {{ $statistics['residency']['approved'] }},
                            {{ $statistics['discount_card']['approved'] }}
                        ],
                        backgroundColor: '#4CAF50',
                    },
                    {
                        label: 'مرفوض',
                        data: [
                            {{ $statistics['insurance']['rejected'] }},
                            {{ $statistics['residency']['rejected'] }},
                            {{ $statistics['discount_card']['rejected'] }}
                        ],
                        backgroundColor: '#F44336',
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                family: 'Tajawal'
                            }
                        }
                    },
                    title: {
                        display: false
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            font: {
                                family: 'Tajawal'
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            font: {
                                family: 'Tajawal'
                            }
                        }
                    }
                }
            }
        });
    </script>
    @endif
</body>
</html>
