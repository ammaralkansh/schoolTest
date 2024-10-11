<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CourseRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CourseCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CourseCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('دورة', 'دورات'); // تغيير هنا
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // set columns from db columns.

        // إضافة حقول هنا
        $this->crud->addColumns([
            ['name' => 'name', 'type' => 'text', 'label' => 'اسم الدورة'], // Course Name
            ['name' => 'subject_id', 'type' => 'select2', 'label' => 'المادة', 'entity' => 'subject', 'attribute' => 'name', 'model' => "App\Models\Subject"], // Subject
            ['name' => 'teacher_id', 'type' => 'select2', 'label' => 'المعلم', 'entity' => 'teacher', 'attribute' => 'name', 'model' => "App\Models\Teacher"], // Teacher
            ['name' => 'organizer_id', 'type' => 'select2', 'label' => 'المنظم', 'entity' => 'organizer', 'attribute' => 'name', 'model' => "App\Models\Staff"], // Organizer
            ['name' => 'level', 'type' => 'select_from_array', 'options' => ['المستوى الأول' => 'المستوى الأول', 'المستوى الثاني' => 'المستوى الثاني'], 'label' => 'المستوى'], // Level
            ['name' => 'stage', 'type' => 'select_from_array', 'options' => ['المرحلة الأولى' => 'المرحلة الأولى', 'المرحلة الثانية' => 'المرحلة الثانية'], 'label' => 'المرحلة'], // Stage
            ['name' => 'duration', 'type' => 'number', 'label' => 'المدة (بالأيام)'], // Duration (in days)
            ['name' => 'min_students', 'type' => 'number', 'label' => 'الحد الأدنى للطلاب'], // Minimum Students
            ['name' => 'max_students', 'type' => 'number', 'label' => 'الحد الأقصى للطلاب'], // Maximum Students
            ['name' => 'start_date', 'type' => 'date', 'label' => 'تاريخ البدء'], // Start Date
            ['name' => 'end_date', 'type' => 'date', 'label' => 'تاريخ الانتهاء'], // End Date
            ['name' => 'course_type', 'type' => 'select_from_array', 'options' => ['جماعية' => 'جماعية', 'خاصة' => 'خاصة'], 'label' => 'نوع الدورة'], // Course Type
            ['name' => 'number_of_lessons', 'type' => 'number', 'label' => 'عدد الدروس'], // Number of Lessons
            ['name' => 'status', 'type' => 'select_from_array', 'options' => ['نشطة' => 'نشطة', 'متوقفة' => 'متوقفة', 'منتهية' => 'منتهية'], 'label' => 'الحالة'], // Status
            ['name' => 'whatsapp_group', 'type' => 'checkbox', 'label' => 'مجموعة واتساب'], // WhatsApp Group
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        
      
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
