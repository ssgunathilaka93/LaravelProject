<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

use app\Models\account;
use app\Models\transaction;
use app\Models\client;
use Illuminate\Support\Facades\DB;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\transactionRequest as StoreRequest;
use App\Http\Requests\transactionRequest as UpdateRequest;

class transactionCrudController extends CrudController
{
	
	public function show($id)
    {
		
		$sajja = transaction::with('auth_account')->where('id' , $id)->get();
		//echo $sajja;
		//echo "-----------------------------------------";
		$phone = json_decode($sajja[0])->auth_account->mobile;
		
		
		$acoount_details = account::with('transaction_relation')->where('mobile' , $phone)->get();
		//echo $acoount_details;
		
		//echo "-----------------------------------------";
		
		$totAmount = DB::table('authorized_account')
					 ->leftJoin('transaction', 'authorized_account.id', '=', 'transaction.account')
                     ->select(DB::raw('authorized_account.client , sum(transaction.amount) as Tot_amount , max(transaction.request_time) as last_charge'))
					 ->where('authorized_account.mobile', $phone)
                     ->groupBy('authorized_account.client')
                     ->get();
		//echo $totAmount;
		
		$this->data['data1'] = $sajja;
		$this->data['data2'] = $acoount_details;
		$this->data['data3'] = $totAmount;
		
        return view('customSajith.clientDetails', $this->data);
    }
	
    public function setup()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\transaction');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/transaction');
        $this->crud->setEntityNameStrings('transaction', 'transactions');

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //$this->crud->setFromDb();
		
		
		$this->crud->setColumns([
			[
				'label' => "Transaction ID",
				'name' => 'id',
			],
            [
                'name'  => 'account',
                'label' => 'Accout No',
                'type'  => 'text',
            ],
            [
                'name'  => 'amount',
                'label' => 'Message',
                'type'  => 'text',
            ],
        ]);
		
		$this->crud->addColumn([  // Select
		   'label' => "Mobile No",
		   'type' => 'select',
		   'name' => 'account', // the db column for the foreign key
		   'entity' => 'auth_account', // the method that defines the relationship in your Model
		   'attribute' => 'mobile', // foreign key attribute that is shown to user
		   'model' => "App\Models\account" // foreign key model
		]);
		
		$this->crud->addColumn(
		/**[	   'label' => "API KEY",
			   'type' => 'select',
			   'name' => 'account', // the db column for the foreign key
			   'entity' => 'client', // the method that defines the relationship in your Model
			   'attribute' => 'api_key', // foreign key attribute that is shown to user
			   'model' => "Models\account" 
		]*/
		
		
		[       // SelectMultiple = n-n relationship (with pivot table)
			'label' => "API KEY",
			'type' => 'select_multiple',
			'name' => 'account', // the method that defines the relationship in your Model
			'entity' => 'client', // the method that defines the relationship in your Model
			'attribute' => 'api_key', // foreign key attribute that is shown to user
			'model' => "Models\account", // foreign key model
		]);
		
		$this->crud->allowAccess(['show']);
        $this->crud->denyAccess(['create', 'update', 'reorder', 'delete']);
		
		
		 //$this->crud->removeAllButtons();

        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);
        // $this->crud->removeAllButtons();
        // $this->crud->removeAllButtonsFromStack('line');

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
