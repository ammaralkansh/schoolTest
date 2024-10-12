<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StudentsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

class StudentsCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        CRUD::setModel(\App\Models\Student::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/students');
        CRUD::setEntityNameStrings('طالب', 'الطلاب');
    }

    protected function setupListOperation()
    {
        CRUD::setFromDb(); // Use columns from the database.

        // Add custom columns to list
        $this->crud->addColumn([
            'name' => 'age',
            'type' => 'number',
            'label' => 'Age',
        ]);

        $this->crud->addColumn([
            'name' => 'country',
            'type' => 'text',
            'label' => 'Country',
        ]);

        $this->crud->addColumn([
            'name' => 'email',
            'type' => 'text',
            'label' => 'Email',
        ]);

        $this->crud->addColumn([
            'name' => 'status',
            'type' => 'enum',
            'label' => 'Status',
        ]);

        // Add Classroom column
        $this->crud->addColumn([
            'name' => 'classroom_id',
            'type' => 'select',
            'label' => 'Classroom',
            'entity' => 'classroom',
            'model' => "App\Models\Classroom",
            'attribute' => 'name',
        ]);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(StudentsRequest::class);

        CRUD::field('name');
        CRUD::field('age');
        CRUD::field('country');
        CRUD::field('phone');
        CRUD::field('email'); // Ensure email field is present
        CRUD::field('date_of_birth');

        CRUD::addField([
            'name' => 'status',
            'type' => 'select_from_array',
            'options' => [
                'active' => 'نشطة',
                'paused' => 'متوقفة مؤقتا',
                'ended' => 'منتهية',
            ],
            'label' => 'الحالة',
            'allows_null' => false,
        ]);

        CRUD::addField([
            'name' => 'classroom_id',
            'label' => "Classroom",
            'type' => 'select',
            'entity' => 'classroom',
            'model' => "App\Models\Classroom",
            'attribute' => 'name',
            'options' => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function chart()
    {
        return view('admin.students.chart'); // Make sure this view exists
    }
}
