<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookCrudController extends CrudController
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
        $this->crud->setModel(Book::class); // تأكد من استخدام Book::class
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/book');
        $this->crud->setEntityNameStrings('كتاب', 'الكتب');

        // إعداد الحقول
        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        $this->crud->addField([
            'name' => 'price',
            'label' => 'Price',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'pages',
            'label' => 'Number of Pages',
            'type' => 'number',
        ]);

        $this->crud->addField([
            'name' => 'status',
            'label' => 'Status',
            'type' => 'select_from_array',
            'options' => [
                'available' => 'Available',
                'borrowed' => 'Borrowed',
            ],
            'allows_null' => false,
        ]);

        // إضافة الحقول الإضافية الخاصة بالمكتبة إذا كان لديك
        $this->crud->addField([
            'name' => 'library_id',
            'label' => 'Library',
            'type' => 'select',
            'entity' => 'library',
            'model' => "App\Models\Library", // نموذج المكتبة
            'attribute' => 'name', // الحقل لعرضه في القائمة المنسدلة
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
        CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BookRequest::class);
    
        CRUD::field('title')
            ->label('اسم الكتاب')
            ->wrapper(['class' => 'form-group col-md-6']); // جعل هذا الحقل في نصف العرض
    
        CRUD::field('price')
            ->label('سعر الكتاب')
            ->type('number')
            ->attributes(['step' => '0.01'])
            ->wrapper(['class' => 'form-group col-md-6']); // جعل هذا الحقل في نصف العرض
    
        CRUD::field('pages')
            ->label('عدد الصفحات')
            ->type('number')
            ->wrapper(['class' => 'form-group col-md-6']); // جعل هذا الحقل في نصف العرض
    
        CRUD::field('status')
            ->label('حالة الكتاب')
            ->type('select_from_array')
            ->options([
                'available' => 'متاح',
                'borrowed' => 'مستعار',
            ])
            ->wrapper(['class' => 'form-group col-md-6']); // جعل هذا الحقل في نصف العرض
    
        CRUD::field('library_id')
            ->label('المكتبة')
            ->type('select')
            ->entity('library')
            ->model('App\Models\Library')
            ->attribute('name')
            ->wrapper(['class' => 'form-group col-md-6']); // جعل هذا الحقل في نصف العرض
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
