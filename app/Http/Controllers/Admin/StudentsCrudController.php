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
    
        CRUD::setFromDb(); // استخدام الأعمدة من قاعدة البيانات.
       // $this->setupCustomButtons();
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
        CRUD::setFromDb(); // set fields from db columns.
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
