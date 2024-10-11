@php
    // استخدم هذا الجزء فقط إذا كنت تريد التأكد من تحميل CSS مع الصفحة.
    // يمكنك أيضاً استخدام ملف CSS خارجي.
@endphp

<style>
    .custom-menu {
        list-style: none;
        padding: 0;
        background-color: #4a4a4a; /* لون خلفية القائمة */
        border-radius: 5px; /* زوايا دائرية */
    }

    .custom-menu li {
        margin: 10px 0;
    }

    .custom-menu li a {
        text-decoration: none;
        color: #ffffff; /* لون النص */
        padding: 10px 15px;
        display: block; /* لجعل الرابط قابلاً للنقر بالكامل */
        border-radius: 3px; /* زوايا دائرية للرابط */
        transition: background-color 0.3s; /* تأثير عند التحويم */
    }

    .custom-menu li a:hover {
        background-color: #f0ad4e; /* لون الخلفية عند التحويم */
    }
</style>

<ul class="custom-menu">
    <li><a href="{{ backpack_url('user') }}">المستخدمين</a></li>
    <li><a href="{{ backpack_url('teacher') }}">المعلمين</a></li>
    <li><a href="{{ backpack_url('students') }}">الطلاب</a></li>
    <li><a href="{{ backpack_url('subject') }}">المواد الدراسية</a></li>
    <li><a href="{{ backpack_url('classroom') }}">الصفوف الدراسية</a></li>
    <li><a href="{{ backpack_url('course') }}">الدورات</a></li>
    <li><a href="{{ backpack_url('library') }}">ادارة المكتبات</a></li>
    <li><a href="{{ backpack_url('book') }}">الكتب</a></li>



</ul>



