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
        CRUD::setEntityNameStrings('معلم', 'المعلمين');
    }

    /**
     * Setup the list operation to display the fields.
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // لجلب الأعمدة من قاعدة البيانات

        // تخصيص بعض الأعمدة بعد `setFromDb` إذا لزم الأمر

        // عرض صورة المعلم
        CRUD::modifyColumn('image', [
            'type' => 'image',
            'disk' => 'public',
            'prefix' => 'uploads/images/teachers/',
            'height' => '50px',
            'width' => '50px',
            'label' => 'صورة المعلم'
        ]);

        // عرض الأيام المتاحة
        CRUD::modifyColumn('days_available', [
            'type' => 'array',
            'label' => 'الأيام المتاحة'
        ]);
    }

    /**
     * Setup the create operation to define fields.
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TeacherRequest::class);
        CRUD::setFromDb(); // لجلب الأعمدة من قاعدة البيانات

        // حقل اختيار الأيام المتاحة
        $this->crud->addField([
            'name' => 'days_available',
            'label' => 'الأيام المتاحة',
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
            'allows_multiple' => true, // يتيح اختيار عدة أيام
        ]);

        // حقل اسم المعلم
        $this->crud->addField([
            'name' => 'name',
            'label' => 'اسم المعلم',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل البريد الإلكتروني
        $this->crud->addField([
            'name' => 'email',
            'label' => 'البريد الإلكتروني',
            'type' => 'email',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل صورة المعلم
        $this->crud->addField([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'uploads/images/teachers/',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل التخصص
        $this->crud->addField([
            'name' => 'specialization',
            'label' => 'التخصص',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل راتب المدرس
        $this->crud->addField([
            'name' => 'rate',
            'label' => 'راتب المدرس',
            'type' => 'number',
            'attributes' => ["step" => "0.01"],
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل المادة الدراسية
        $this->crud->addField([
            'name' => 'subject_id',
            'label' => 'المادة الدراسية',
            'type' => 'select',
            'entity' => 'subject',
            'model' => 'App\Models\Subject',
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
            'wrapper' => ['class' => 'form-group col-md-6'],
        ]);

        // حقل الملاحظات
        $this->crud->addField([
            'name' => 'notes',
            'label' => 'ملاحظات',
            'type' => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-12'],
        ]);

        // حقل الوقت المتاح من
        $this->crud->addField([
            'name' => 'from',
            'label' => 'الوقت المتاح من ',
            'type' => 'time',
        ]);

        // حقل الوقت المتاح إلى
        $this->crud->addField([
            'name' => 'to',
            'label' => 'الوقت المتاح الى',
            'type' => 'time',
        ]);
    }

    /**
     * Setup the update operation with the same fields as create operation.
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
