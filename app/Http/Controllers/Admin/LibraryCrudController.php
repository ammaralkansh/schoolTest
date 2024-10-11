<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LibraryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LibraryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LibraryCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Library::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/library');
        CRUD::setEntityNameStrings('library', 'libraries');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id')->label('ID');
        CRUD::column('name')->label('اسم المكتبة');
        CRUD::column('location')->label('موقع المكتبة');
        CRUD::column('created_at')->label('تاريخ الإضافة');
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

    CRUD::field('title')->label('اسم الكتاب');
    CRUD::field('price')->label('سعر الكتاب')->type('number')->attributes(['step' => '0.01']);
    CRUD::field('pages')->label('عدد الصفحات')->type('number');
    CRUD::field('status')->label('حالة الكتاب')->type('select_from_array')->options([
        'available' => 'متاح',
        'borrowed' => 'مستعار',
    ]);
    
    // إضافة قائمة منسدلة لاختيار المكتبة
    CRUD::field('library_id')->label('المكتبة')->type('select')->entity('library')->model('App\Models\Library')->attribute('name');
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
