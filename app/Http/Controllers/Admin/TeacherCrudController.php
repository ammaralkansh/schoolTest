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

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setValidation(TeacherRequest::class);
        CRUD::setFromDb();

        // إزالة العمود التلقائي للصورة
        CRUD::removeColumn('image');
    
        // إضافة العمود المخصص للصورة كمعاينة مصغرة
        CRUD::addColumn([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'image',
            'prefix' => 'storage/',
            'height' => '50px',
            'width' => '50px',
        ]);

    }

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
            'name' => 'specialization',
            'label' => 'التخصص',
            'type' => 'text',
        ]);
        
        $this->crud->addField([
            'name' => 'available_from',
            'label' => 'الوقت المتاح من',
            'type' => 'time',
        ]);
        
        $this->crud->addField([
            'name' => 'available_to',
            'label' => 'الوقت المتاح إلى',
            'type' => 'time',
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
        
        
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
