<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>طلب التأمين الصحي</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@3.2.36/dist/vue.global.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-color:#EAE3D1 !important;
            text-align: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container {
            max-width: 900px;
            margin: auto;
            padding: 20px;
        }
        header {
            background-color: rgb(255, 255, 255) !important;
        }
        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            margin: 20px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn {
            background-color: #2D1E0F !important;
            color: white !important;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            width: 100%;
            margin-bottom: 10px;
        }
        .btn:hover {
            background-color: #3D2E1F !important;
        }
        .btn-back {
            background-color: #8F7B5D !important;
            margin-left: 10px;
            width: auto;
        }
        footer {
            margin-top: auto;
            background-color: #8F7B5D;
            padding: 20px;
            color: white;
        }
        .nav-link {
            background-color: transparent !important;
            color: #2D1E0F !important;
            margin: 0 10px;
        }
        .nav-link:hover {
            color: #3D2E1F !important;
        }
    </style>
</head>
<body>
    <header class="py-4 shadow">
        <div class="container mx-auto text-center">
            <img src="/logo.png" alt="شعار الحرس الأميري" class="mx-auto" style="max-width: 200px;">
            <nav class="mt-4">
                <a href="/" class="nav-link">الرئيسية</a>
                <a href="/contact" class="nav-link">اتصل بنا</a>
            </nav>
        </div>
    </header>

    <div class="container">
        <div class="form-container">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">طلب التأمين الصحي</h2>
                <a href="/" class="btn btn-back">رجوع</a>
            </div>

            <div id="app">
                <p class="text-center text-gray-700 mb-6">@{{ requestTypeDesc }}</p>

                <div v-if="requestType === 'add-family'" class="space-y-4">
                    <h3 class="text-center text-lg font-semibold mb-6">اختر نوع الإضافة</h3>
                    <div class="grid grid-cols-1 gap-4">
                        <button @click="navigateTo('add-spouse')" class="btn">إضافة الزوج أو الزوجة</button>
                        <button @click="navigateTo('add-children')" class="btn">إضافة الأبناء</button>
                        <button @click="navigateTo('add-parents')" class="btn">إضافة الوالدين (للمواطنين فقط)</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center">
        <p>&copy; 2025 جميع الحقوق محفوظة للقيادة العامة للحرس الأميري</p>
    </footer>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    form: {
                        militaryId: '',
                        name: '',
                        email: '',
                        phone: '',
                        hiringDate: '',
                        passport: null,
                        id: null,
                        photo: null,
                        residency: null
                    },
                    requestType: new URLSearchParams(window.location.search).get('type') || '',
                    requestTypeDesc: "طلب تأمين صحي",
                    message: ""
                };
            },
            mounted() {
                const appElement = document.getElementById("app");
                if (appElement) {
                    this.requestTypeDesc = appElement.dataset.requestTypeDesc || "طلب تأمين صحي";
                }
            },
            methods: {
                navigateTo(type) {
                    window.location.href = `/insurance/request/${type}`;
                },
                handleFileUpload(field, event) {
                    if (event.target.files.length > 0) {
                        this.form[field] = event.target.files[0];
                    }
                },
                async submitRequest() {
                    let formData = new FormData();

                    Object.keys(this.form).forEach(key => {
                        if (this.form[key]) {
                            formData.append(key, this.form[key]);
                        }
                    });

                    formData.append('service_type', this.requestType);

                    let csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                    if (!csrfTokenMeta) {
                        console.error("CSRF Token غير موجود في الصفحة.");
                        this.message = "خطأ في المصادقة، الرجاء تحديث الصفحة.";
                        return;
                    }

                    let csrfToken = csrfTokenMeta.getAttribute('content');
                    formData.append('_token', csrfToken);

                    try {
                        let response = await fetch("/submit-insurance-request", {
                            method: "POST",
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            let errorText = await response.text();
                            throw new Error("خطأ: " + errorText);
                        }

                        let result = await response.json();
                        this.message = result.message || "تم إرسال الطلب بنجاح!";
                        alert(this.message);
                    } catch (error) {
                        console.error("Error:", error);
                        this.message = "حدث خطأ أثناء إرسال الطلب.";
                        alert(this.message);
                    }
                }
            }
        }).mount("#app");
    </script>
</body>
</html>
