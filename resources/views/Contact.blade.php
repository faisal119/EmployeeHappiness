<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتصل بنا - الحرس الأميري</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2D1E0F;
            --secondary-color: #8F7B5D;
            --background-color: #EAE3D1;
        }

        body {
            background-color: var(--background-color);
            font-family: system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background-color: white;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo {
            max-width: 200px;
            height: auto;
            margin: 0 auto;
        }

        .footer {
            background-color: var(--secondary-color);
            color: white;
            text-align: center;
            padding: 1.5rem;
            margin-top: auto;
        }

        .main-content {
            flex: 1;
        }

        .contact-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .contact-card {
            padding: 1.5rem;
            border-radius: 10px;
            background: var(--background-color);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .contact-label {
            color: var(--primary-color);
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .contact-value {
            color: var(--secondary-color);
            direction: ltr;
            text-align: center;
        }

        .contact-value a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-value a:hover {
            color: var(--primary-color);
        }

        .contact-form {
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 2px solid var(--secondary-color);
            border-radius: 8px;
            background-color: white;
        }

        .form-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .submit-button {
            background-color: var(--primary-color);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .submit-button:hover {
            background-color: #3D2E1F;
        }

        @media (max-width: 768px) {
            .contact-container {
                margin: 1rem;
                padding: 1rem;
            }
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .whatsapp-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .whatsapp-button:hover {
            transform: scale(1.1);
        }

        .whatsapp-button img {
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <header class="header">
        <img src="/logo.png" alt="شعار الحرس الأميري" class="logo">
    </header>

    <div class="main-content">
        <div class="contact-container">
            <h1 class="text-3xl font-bold text-center mb-8 text-[#2D1E0F]">اتصل بنا</h1>
            
            <div class="contact-info">
                <div class="contact-card">
                    <i class="fas fa-phone contact-icon"></i>
                    <div class="contact-label">رقم الهاتف</div>
                    <div class="contact-value">065111111</div>
                </div>

                <div class="contact-card">
                    <i class="fab fa-whatsapp contact-icon"></i>
                    <div class="contact-label">واتساب</div>
                    <div class="contact-value">
                        <a href="https://wa.me/971565449090" target="_blank">971565449090</a>
                    </div>
                </div>

                <div class="contact-card">
                    <i class="fas fa-envelope contact-icon"></i>
                    <div class="contact-label">البريد الإلكتروني</div>
                    <div class="contact-value">
                        <a href="mailto:info@guard.gov.ae">info@guard.gov.ae</a>
                    </div>
                </div>

                <div class="contact-card">
                    <i class="fab fa-instagram contact-icon"></i>
                    <div class="contact-label">انستغرام</div>
                    <div class="contact-value">
                        <a href="https://www.instagram.com/shjamiriguard" target="_blank">shjamiriguard</a>
                    </div>
                </div>

                <div class="contact-card">
                    <i class="fab fa-twitter contact-icon"></i>
                    <div class="contact-label">تويتر</div>
                    <div class="contact-value">
                        <a href="https://twitter.com/shjamiriguard" target="_blank">@shjamriguard</a>
                    </div>
                </div>
            </div>

            <form class="contact-form">
                <div class="form-group">
                    <label class="form-label">الاسم</label>
                    <input type="text" class="form-input" placeholder="أدخل اسمك">
                </div>

                <div class="form-group">
                    <label class="form-label">البريد الإلكتروني</label>
                    <input type="email" class="form-input" placeholder="أدخل بريدك الإلكتروني">
                </div>

                <div class="form-group">
                    <label class="form-label">رقم الهاتف</label>
                    <input type="tel" class="form-input" placeholder="أدخل رقم هاتفك">
                </div>

                <div class="form-group">
                    <label class="form-label">الرسالة</label>
                    <textarea class="form-input" rows="4" placeholder="اكتب رسالتك هنا"></textarea>
                </div>

                <button type="submit" class="submit-button">إرسال</button>
            </form>
        </div>
    </div>

    <footer class="footer">
        <p class="mb-2">© {{ date('Y') }} جميع الحقوق محفوظة</p>
        <p>القيادة العامة للحرس الأميري</p>
    </footer>

    <!-- زر الواتساب -->
    <div class="whatsapp-button">
        <a href="https://wa.me/971565449090" target="_blank" rel="noopener noreferrer">
            <img src="/whatsapp-icon.png" alt="WhatsApp" style="width: 60px; height: 60px;">
        </a>
    </div>
</body>
</html>
