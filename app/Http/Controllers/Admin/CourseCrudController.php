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

    public function setup()
    {
        CRUD::setModel(\App\Models\Course::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/course');
        CRUD::setEntityNameStrings('دورة', 'دورات');
    }

    protected function setupListOperation()
    {
        CRUD::addColumns([
            ['name' => 'name', 'type' => 'text', 'label' => 'اسم الدورة'],
            ['name' => 'subject_id', 'type' => 'select', 'label' => 'المادة', 'entity' => 'subject', 'attribute' => 'name', 'model' => "App\Models\Subject"], // تعديل إلى select
            ['name' => 'teacher_id', 'type' => 'select', 'label' => 'المعلم', 'entity' => 'teacher', 'attribute' => 'name', 'model' => "App\Models\Teacher"], // تعديل إلى select
            ['name' => 'organizer_id', 'type' => 'select', 'label' => 'المنظم', 'entity' => 'organizer', 'attribute' => 'name', 'model' => "App\Models\Staff"], // تعديل إلى select
            ['name' => 'level', 'type' => 'select_from_array', 'options' => ['المستوى الأول' => 'المستوى الأول', 'المستوى الثاني' => 'المستوى الثاني'], 'label' => 'المستوى'],
            ['name' => 'stage', 'type' => 'select_from_array', 'options' => ['المرحلة الأولى' => 'المرحلة الأولى', 'المرحلة الثانية' => 'المرحلة الثانية'], 'label' => 'المرحلة'],
            ['name' => 'duration', 'type' => 'number', 'label' => 'المدة (بالأيام)'],
            ['name' => 'min_students', 'type' => 'number', 'label' => 'الحد الأدنى للطلاب'],
            ['name' => 'max_students', 'type' => 'number', 'label' => 'الحد الأقصى للطلاب'],
            ['name' => 'start_date', 'type' => 'date', 'label' => 'تاريخ البدء'],
            ['name' => 'end_date', 'type' => 'date', 'label' => 'تاريخ الانتهاء'],
            ['name' => 'course_type', 'type' => 'select_from_array', 'options' => ['جماعية' => 'جماعية', 'خاصة' => 'خاصة'], 'label' => 'نوع الدورة'],
            ['name' => 'number_of_lessons', 'type' => 'number', 'label' => 'عدد الدروس'],
            ['name' => 'status', 'type' => 'select_from_array', 'options' => ['نشطة' => 'نشطة', 'متوقفة' => 'متوقفة', 'منتهية' => 'منتهية'], 'label' => 'الحالة'],
            ['name' => 'whatsapp_group', 'type' => 'checkbox', 'label' => 'مجموعة واتساب'],
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(CourseRequest::class);
        
        CRUD::addFields([
            ['name' => 'name', 'type' => 'text', 'label' => 'اسم الدورة'],
            ['name' => 'subject_id', 'type' => 'select', 'label' => 'المادة', 'entity' => 'subject', 'attribute' => 'name', 'model' => "App\Models\Subject"],
            ['name' => 'teacher_id', 'type' => 'select', 'label' => 'المعلم', 'entity' => 'teacher', 'attribute' => 'name', 'model' => "App\Models\Teacher"],
            ['name' => 'organizer_id', 'type' => 'select', 'label' => 'المنظم', 'entity' => 'organizer', 'attribute' => 'name', 'model' => "App\Models\Staff"],
            ['name' => 'level', 'type' => 'select_from_array', 'options' => ['المستوى الأول' => 'المستوى الأول', 'المستوى الثاني' => 'المستوى الثاني'], 'label' => 'المستوى'],
            ['name' => 'stage', 'type' => 'select_from_array', 'options' => ['المرحلة الأولى' => 'المرحلة الأولى', 'المرحلة الثانية' => 'المرحلة الثانية'], 'label' => 'المرحلة'],
            ['name' => 'duration', 'type' => 'number', 'label' => 'المدة (بالأيام)'],
            ['name' => 'min_students', 'type' => 'number', 'label' => 'الحد الأدنى للطلاب'],
            ['name' => 'max_students', 'type' => 'number', 'label' => 'الحد الأقصى للطلاب'],
            ['name' => 'start_date', 'type' => 'date', 'label' => 'تاريخ البدء'],
            ['name' => 'end_date', 'type' => 'date', 'label' => 'تاريخ الانتهاء'],
            ['name' => 'course_type', 'type' => 'select_from_array', 'options' => ['جماعية' => 'جماعية', 'خاصة' => 'خاصة'], 'label' => 'نوع الدورة'],
            ['name' => 'number_of_lessons', 'type' => 'number', 'label' => 'عدد الدروس'],
            ['name' => 'status', 'type' => 'select_from_array', 'options' => ['نشطة' => 'نشطة', 'متوقفة' => 'متوقفة', 'منتهية' => 'منتهية'], 'label' => 'الحالة'],
            ['name' => 'whatsapp_group', 'type' => 'checkbox', 'label' => 'مجموعة واتساب'],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
