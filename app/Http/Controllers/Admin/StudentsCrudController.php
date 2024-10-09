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
        CRUD::setModel(\App\Models\Students::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/students');
        CRUD::setEntityNameStrings('student', 'students');
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
            'name' => 'status',
            'type' => 'enum',
            'label' => 'Status',
        ]);
    }
    
    
    protected function setupCustomButtons()
    {
        // إضافة الرسم البياني بعد جدول القائمة
        $this->crud->addButtonFromView('top', 'students_chart', 'students_chart', 'end');
    }
    
    
    public function getChartData()
    {
        // استعلام لجلب عدد الطلاب حسب الصف
        $data = \App\Models\Students::selectRaw('COUNT(*) as count, classroom_id')
            ->groupBy('classroom_id')
            ->get();

        // تحويل البيانات إلى تنسيق JSON
        return response()->json($data);
    }

    protected function setupCreateOperation()
{
    CRUD::setValidation(StudentsRequest::class);
    
    CRUD::field('name');
    CRUD::field('age');
    CRUD::field('country');
    CRUD::field('phone');
    CRUD::field('status');
    CRUD::field('email');
    CRUD::field('date_of_birth');
    CRUD::field('classroom_id');
}

protected function setupUpdateOperation()
{
    $this->setupCreateOperation();
}

public function chart()
{
    return view('admin.students.chart'); // تأكد من إنشاء هذا العرض
}
}
