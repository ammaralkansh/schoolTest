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
        CRUD::setEntityNameStrings('مكتبة', 'المكتبات');
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
        CRUD::setValidation(LibraryRequest::class);
    
        CRUD::field('name')
            ->label('اسم المكتبة')
            ->wrapper(['class' => 'form-group col-md-6']); // نصف عرض
    
        CRUD::field('location')
            ->label('موقع المكتبة')
            ->wrapper(['class' => 'form-group col-md-6']); // نصف عرض
    
        CRUD::field('status')
            ->label('حالة المكتبة')
            ->type('select_from_array')
            ->options([
                'open' => 'مفتوحة',
                'closed' => 'مغلقة',
            ])
            ->wrapper(['class' => 'form-group col-md-6']); // نصف عرض
    
      
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
