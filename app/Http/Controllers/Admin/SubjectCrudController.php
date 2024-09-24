<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubjectRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Subject;

/**
 * Class SubjectCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubjectCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Subject::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/subject');
        CRUD::setEntityNameStrings('subject', 'subjects');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // عرض جميع الأعمدة من قاعدة البيانات
        
        // يمكنك تخصيص الأعمدة التي سيتم عرضها
        CRUD::addColumn([
            'name' => 'name',
            'label' => 'اسم المادة الدراسية',
            'type' => 'text',
        ]);

        // عرض تاريخ الإنشاء إذا كنت ترغب في ذلك
        CRUD::addColumn([
            'name' => 'created_at',
            'label' => 'تاريخ الإنشاء',
            'type' => 'datetime',
        ]);

        // عرض تاريخ التحديث إذا كنت ترغب في ذلك
        CRUD::addColumn([
            'name' => 'updated_at',
            'label' => 'تاريخ التحديث',
            'type' => 'datetime',
        ]);
    }

    /**
     * Define what happens when the Show operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-show
     * @return void
     */
    protected function setupShowOperation()
    {
        CRUD::setFromDb(); // عرض جميع الحقول من قاعدة البيانات

        // إذا كنت تريد إضافة حقول إضافية للعرض
        CRUD::addField([
            'name' => 'name',
            'label' => 'اسم المادة الدراسية',
            'type' => 'text',
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
        CRUD::setValidation(SubjectRequest::class);
        CRUD::setFromDb(); // استخدام الحقول من قاعدة البيانات

        // يمكنك تخصيص الحقول هنا
        CRUD::addField([
            'name' => 'name',
            'label' => 'اسم المادة الدراسية',
            'type' => 'text',
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation(); // استخدم نفس الحقول الخاصة بعملية الإنشاء
    }
}
