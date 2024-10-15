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
        CRUD::addColumn([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'image',
            'prefix' => 'uploads/images/teachers/',
            'height' => '50px',
            'width' => '50px',
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

        CRUD::addColumn([
            'name' => 'notes',
            'label' => 'ملاحظات',
            'type' => 'text',
        ]);

        CRUD::addColumn([
            'name' => 'days_available',
            'label' => 'الأيام المتاحة',
            'type' => 'array', // عرض الأيام المتاحة كقائمة
        ]);

        CRUD::addColumn([
            'name' => 'from',
            'label' => 'الوقت المتاح من',
            'type' => 'time',
        ]);

        CRUD::addColumn([
            'name' => 'to',
            'label' => 'الوقت المتاح إلى',
            'type' => 'time',
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

        $this->crud->addField([
            'name' => 'name',
            'label' => 'اسم المعلم',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'email',
            'label' => 'البريد الإلكتروني',
            'type' => 'email',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'image',
            'label' => 'صورة المعلم',
            'type' => 'upload',
            'upload' => true,
            'disk' => 'public',
            'prefix' => 'uploads/images/teachers/',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'specialization',
            'label' => 'التخصص',
            'type' => 'text',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'rate',
            'label' => 'راتب المدرس',
            'type' => 'number',
            'attributes' => ["step" => "0.01"],
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

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
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'notes',
            'label' => 'ملاحظات',
            'type' => 'textarea',
            'wrapper' => ['class' => 'form-group col-md-12'], // عرض كامل
        ]);

        $this->crud->addField([
            'name' => 'from',
            'label' => 'الوقت المتاح من',
            'type' => 'time',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
        ]);

        $this->crud->addField([
            'name' => 'to',
            'label' => 'الوقت المتاح إلى',
            'type' => 'time',
            'wrapper' => ['class' => 'form-group col-md-6'], // نصف عرض
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
