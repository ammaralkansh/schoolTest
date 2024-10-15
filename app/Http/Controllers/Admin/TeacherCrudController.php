<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TeacherRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TeacherCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TeacherCrudController extends CrudController
{
    
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Teacher::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/teacher');
        CRUD::setEntityNameStrings('teacher', 'teachers');
        
    }
    protected function setupListOperation()
    {
        CRUD::setValidation(TeacherRequest::class);
        CRUD::setFromDb(); // لجلب الأعمدة من قاعدة البيانات
    
        // إعداد الأعمدة (مثال على بعض الأعمدة فقط)
        CRUD::addColumn([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'image',
            'prefix' => 'uploads/images/teachers/',
            'height' => '50px',
            'width' => '50px',
        ]);
    
        CRUD::addColumn([
            'name' => 'day',
            'label' => 'اليوم',
            'type' => 'text',
        ]);
    
        CRUD::addColumn([
            'name' => 'specialization',
            'label' => 'التخصص',
            'type' => 'text',
        ]);
    
        CRUD::addColumn([
            'name' => 'rate',
            'label' => 'راتب المدرس',
            'type' => 'number',
            'prefix' => '$',
            'decimals' => 2,
        ]);
    
        CRUD::addColumn([
            'name' => 'subject_id',
            'label' => 'المادة الدراسية',
            'type' => 'select',
            'entity' => 'subject',
            'model' => 'App\Models\Subject',
            'attribute' => 'name',
        ]);
    
        // تطبيق شروط البحث عند وجود مدخلات
        if (request()->has('specialization')) {
            CRUD::addClause('where', 'specialization', 'LIKE', '%' . request('specialization') . '%');
        }
    
        if (request()->has('day')) {
            CRUD::addClause('where', 'day', request('day'));
        }
    
        if (request()->has('rate_min') || request()->has('rate_max')) {
            $rateMin = request('rate_min', 0);
            $rateMax = request('rate_max', PHP_INT_MAX);
            CRUD::addClause('whereBetween', 'rate', [(float)$rateMin, (float)$rateMax]);
        }
    
        if (request()->has('subject_id')) {
            CRUD::addClause('where', 'subject_id', request('subject_id'));
        }
    }
    









    

    // protected function setupListOperation()
    // {
    //     CRUD::setValidation(TeacherRequest::class); 
    //     // عمود عرض صورة المعلم
    //     CRUD::addColumn([
    //         'name' => 'image',
    //         'label' => 'صورة المعلم',
    //         'type' => 'image',
    //         'prefix' => 'uploads/images/teachers/', // مسار الصور
    //         'height' => '50px', // حجم الصورة
    //         'width' => '50px',
    //     ]);
    
    //     // عمود عرض اليوم
    //     CRUD::addColumn([
    //         'name' => 'day',
    //         'label' => 'اليوم',
    //         'type' => 'text',
    //         'options' => [
    //             'Sunday' => 'الأحد',
    //             'Monday' => 'الإثنين',
    //             'Tuesday' => 'الثلاثاء',
    //             'Wednesday' => 'الأربعاء',
    //             'Thursday' => 'الخميس',
    //             'Friday' => 'الجمعة',
    //             'Saturday' => 'السبت',
    //         ],
    //     ]);
    
    //     // عمود عرض التخصص
    //     CRUD::addColumn([
    //         'name' => 'specialization',
    //         'label' => 'التخصص',
    //         'type' => 'text',
    //     ]);
    
    //     // عمود عرض راتب المدرس
    //     CRUD::addColumn([
    //         'name' => 'rate',
    //         'label' => 'راتب المدرس',
    //         'type' => 'number',
    //         'prefix' => '$', // إضافة رمز العملة
    //         'decimals' => 2, // عرض عدد محدد من الكسور
    //     ]);
    
    //     // عمود عرض المادة الدراسية
    //     CRUD::addColumn([
    //         'name' => 'subject_id',
    //         'label' => 'المادة الدراسية',
    //         'type' => 'select',
    //         'entity' => 'subject',
    //         'model' => 'App\Models\Subject', // مسار النموذج المرتبط بالمادة
    //         'attribute' => 'name', // عرض اسم المادة في القائمة
    //     ]);
    
    //     // عمود عرض الملاحظات
    //     CRUD::addColumn([
    //         'name' => 'notes',
    //         'label' => 'ملاحظات',
    //         'type' => 'text',
    //     ]);
    
    //     // عمود عرض الوقت المتاح من
    //     CRUD::addColumn([
    //         'name' => 'from',
    //         'label' => 'الوقت المتاح من',
    //         'type' => 'time',
    //     ]);
    
    //     // عمود عرض الوقت المتاح إلى
    //     CRUD::addColumn([
    //         'name' => 'to',
    //         'label' => 'الوقت المتاح إلى',
    //         'type' => 'time',
    //     ]);
    
    //     // إضافة فلاتر البحث
    //     if (request()->has('specialization')) {
    //         CRUD::addClause('where', 'specialization', 'LIKE', '%' . request('specialization') . '%');
    //     }
    
    //     if (request()->has('day')) {
    //         CRUD::addClause('where', 'day', request('day'));
    //     }
    
    //     if (request()->has('rate_min') || request()->has('rate_max')) {
    //         $rateMin = request('rate_min', 0);
    //         $rateMax = request('rate_max', PHP_INT_MAX);
    //         CRUD::addClause('whereBetween', 'rate', [(float)$rateMin, (float)$rateMax]);
    //     }
    
    //     if (request()->has('subject_id')) {
    //         CRUD::addClause('where', 'subject_id', request('subject_id'));
    //     }
    
    //     // تضمين نموذج البحث كـ custom_html
    //     CRUD::addColumn([
    //         'name' => 'custom_filters',
    //         'type' => 'custom_html',
    //         'label' => 'فلاتر البحث',
    //         'value' => function() {
    //             return view('vendor.backpack.filters.custom_search')->render();
    //         }
    //     ]);
    // }
    

//     protected function setupListOperation()
// {
//     CRUD::setValidation(TeacherRequest::class);


//     // عمود عرض صورة المعلم
//     CRUD::addColumn([
//         'name' => 'image',
//         'label' => 'صورة المعلم',
//         'type' => 'image',
//         'prefix' => 'uploads/images/teachers/', // مسار الصور
//         'height' => '50px', // حجم الصورة
//         'width' => '50px',
//     ]);

//     // عمود عرض اليوم
//     CRUD::addColumn([
//         'name' => 'day',
//         'label' => 'اليوم',
//         'type' => 'text', // يفضل استخدام "text" هنا إذا لم يتم استيرادها كقائمة
//         'options' => [
//             'Sunday' => 'الأحد',
//             'Monday' => 'الإثنين',
//             'Tuesday' => 'الثلاثاء',
//             'Wednesday' => 'الأربعاء',
//             'Thursday' => 'الخميس',
//             'Friday' => 'الجمعة',
//             'Saturday' => 'السبت',
//         ],
//     ]);

//     // عمود عرض التخصص
//     CRUD::addColumn([
//         'name' => 'specialization',
//         'label' => 'التخصص',
//         'type' => 'text',
//     ]);

//     // عمود عرض راتب المدرس
//     CRUD::addColumn([
//         'name' => 'rate',
//         'label' => 'راتب المدرس',
//         'type' => 'number',
//         'prefix' => '$', // إضافة رمز العملة
//         'decimals' => 2, // عرض عدد محدد من الكسور
//     ]);

//     // عمود عرض المادة الدراسية
//     CRUD::addColumn([
//         'name' => 'subject_id',
//         'label' => 'المادة الدراسية',
//         'type' => 'select',
//         'entity' => 'subject',
//         'model' => 'App\Models\Subject', // مسار النموذج المرتبط بالمادة
//         'attribute' => 'name', // عرض اسم المادة في القائمة
//     ]);

//     // عمود عرض الملاحظات
//     CRUD::addColumn([
//         'name' => 'notes',
//         'label' => 'ملاحظات',
//         'type' => 'text',
//     ]);

//     // عمود عرض الوقت المتاح من
//     CRUD::addColumn([
//         'name' => 'from',
//         'label' => 'الوقت المتاح من',
//         'type' => 'time',
//     ]);

//     // عمود عرض الوقت المتاح إلى
//     CRUD::addColumn([
//         'name' => 'to',
//         'label' => 'الوقت المتاح إلى',
//         'type' => 'time',
//     ]);

    
    
// }

   













    protected function setupCreateOperation()
    {
        CRUD::setValidation(TeacherRequest::class);
        CRUD::setFromDb(); // set fields from db columns.



        $this->crud->addField([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public', // تأكد من استخدام قرص 'public' لحفظ الملفات
            'prefix' => 'uploads/images/teachers/', // مسار تخزين الصور
        ]);
        $this->crud->addField([
            'name' => 'day',
            'label' => 'اليوم',
            'type' => 'select_from_array',
            'options' => [
                'Sunday' => 'الأحد',
                'Monday' => 'الإثنين',
                'Tuesday' => 'الثلاثاء',
                'Wednesday' => 'الأربعاء',
                'Thursday' => 'الخميس',
                'Friday' => 'الجمعة',
                'Saturday' => 'السبت',
            ],
            'allows_null' => false, // لجعل الاختيار إلزاميًا
        ]);
        
        
        
        $this->crud->addField([
            'name' => 'specialization',
            'label' => 'التخصص',
            'type' => 'text',
        ]);
        

        

        
        $this->crud->addField([
            'name' => 'rate',
            'label' => 'راتب المدرس',
            'type' => 'number',
            'attributes' => ["step" => "0.01"],
        ]);
        $this->crud->addField([
            'name' => 'subject_id',
            'label' => 'المادة الدراسية',
            'type' => 'select',
            'entity' => 'subject',
            'model' => 'App\Models\Subject', // مسار النموذج المرتبط بالمادة
            'attribute' => 'name', // عرض اسم المادة في القائمة المنسدلة
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), // ترتيب الخيارات تصاعديًا حسب الاسم
        ]);
        
        $this->crud->addField([
            'name' => 'notes',
            'label' => 'ملاحظات',
            'type' => 'textarea',
        ]);

        // حقل اختيار الوقت "من"
$this->crud->addField([
    'name' => 'from',
    'label' => 'الوقت المتاح من ',
    'type' => 'time',
]);

// حقل اختيار الوقت "إلى"
$this->crud->addField([
    'name' => 'to',
    'label' => 'الوقت المتاح الى',
    'type' => 'time',
]);

        
        
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
