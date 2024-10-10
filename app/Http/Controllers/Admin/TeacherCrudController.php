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
        CRUD::setValidation(TeacherRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
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
            'label' => 'سعر المدرس',
            'type' => 'number',
            'attributes' => ["step" => "0.01"],
        ]);
        
        $this->crud->addField([
            'name' => 'notes',
            'label' => 'ملاحظات',
            'type' => 'textarea',
        ]);
        
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       
    }

    protected function setupCreateOperation()
    {

        
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
