<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>مدرسة البراء</title>
    <style>
        /* إعدادات عامة */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            direction: rtl;
            text-align: right;
        }

        .container {
            width: 90%;
            margin: auto;
            overflow: hidden;
        }

        /* رأس الصفحة (Header) */
        header {
            background: #333;
            color: #fff;
            padding-top: 20px;
            min-height: 70px;
            border-bottom: #77d62c 3px solid;
        }

        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }

        header ul {
            padding: 0;
            list-style: none;
        }

        header li {
            display: inline;
            padding: 0 20px;
        }

        .logo {
            float: right;
            width: 120px;
            margin-top: -20px;
        }

        /* قسم المقدمة (Hero Section) */
        .hero {
            background: url('school-bg.jpg') no-repeat center center/cover;
            height: 600px;
            color: #fff;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-content h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-content p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .cta-button {
            background: #77d62c;
            color: #fff;
            padding: 10px 20px;
            text-transform: uppercase;
            text-decoration: none;
            border-radius: 5px;
        }

        /* الأقسام الأخرى */
        section {
            padding: 40px 0;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .about, .services, .news, .contact {
            background: #f4f4f4;
        }

        .service-item, .news-item {
            margin: 20px 0;
        }

        footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }
    </style>
</head>
<body>

    <!-- رأس الصفحة (Header) -->
    <header>
        <div class="container">
            <img src="logo.png" alt="شعار المدرسة" class="logo">
            <nav>
                <ul>
                    <li><a href="#home">الرئيسية</a></li>
                    <li><a href="#about">عن المدرسة</a></li>
                    <li><a href="#services">الخدمات</a></li>
                    <li><a href="#news">الأخبار</a></li>
                    <li><a href="#contact">اتصل بنا</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- قسم المقدمة (Hero Section) -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>مرحبًا بكم في مدرسة البراء</h1>
            <p>تعليم متميز لمستقبل مشرق</p>
            <a href="http://127.0.0.1:8000/admin/login" class="cta-button">تسجيل الدخول</a>
            </div>
    </section>

    <!-- قسم عن المدرسة (About Section) -->
    <section id="about" class="about">
        <div class="container">
            <h2>عن المدرسة</h2>
            <p>نحن نقدم تعليمًا شاملاً ومميزًا يساهم في بناء جيل مثقف وقادر على مواجهة تحديات المستقبل.</p>
        </div>
    </section>

    <!-- قسم الخدمات (Services Section) -->
    <section id="services" class="services">
        <div class="container">
            <h2>الخدمات</h2>
            <div class="service-item">
                <h3>البرامج التعليمية</h3>
                <p>نحن نوفر مجموعة متنوعة من البرامج التعليمية التي تغطي جميع المراحل الدراسية.</p>
            </div>
            <div class="service-item">
                <h3>الأنشطة اللاصفية</h3>
                <p>المدرسة تقدم أنشطة رياضية وفنية وثقافية لبناء مهارات الطلاب المتنوعة.</p>
            </div>
            <div class="service-item">
                <h3>التعليم الإلكتروني</h3>
                <p>توفر المدرسة منصات تعليمية رقمية لمتابعة تقدم الطلاب وتقديم الدروس عبر الإنترنت.</p>
            </div>
        </div>
    </section>

    <!-- قسم الأخبار (News Section) -->
    <section id="news" class="news">
        <div class="container">
            <h2>الأخبار</h2>
            <div class="news-item">
                <h3>افتتاح المكتبة الجديدة</h3>
                <p>يسرنا أن نعلن عن افتتاح مكتبة المدرسة الحديثة التي تحتوي على مجموعة متنوعة من الكتب والمراجع.</p>
            </div>
            <div class="news-item">
                <h3>حفل تخريج الطلاب</h3>
                <p>نحتفل بتخريج دفعة جديدة من طلابنا الذين اجتازوا الامتحانات النهائية بتفوق.</p>
            </div>
        </div>
    </section>

    <!-- قسم اتصل بنا (Contact Section) -->
    <section id="contact" class="contact">
        <div class="container">
            <h2>اتصل بنا</h2>
            <p>العنوان: شارع التعليم، المدينة، البلد</p>
            <p>الهاتف: 0123456789</p>
            <p>البريد الإلكتروني: info@school.com</p>
        </div>
    </section>

    <!-- تذييل الصفحة (Footer) -->
    <footer>
        <div class="container">
            <p>جميع الحقوق محفوظة © 2024 مدرسة البراء</p>
        </div>
    </footer>

</body>
</html>
