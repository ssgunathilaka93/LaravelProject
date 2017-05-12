<?php

namespace Backpack\CRUD\app\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\TagCrudRequest as StoreRequest;
use App\Http\Requests\TagCrudRequest as UpdateRequest;

class MessageController extends CrudController {

	public function setup() {
        //$this->crud->setModel("App\Models\Tag");
        $this->crud->setRoute("admin/message");
        $this->crud->setEntityNameStrings('message', 'messages');

        $this->crud->setColumns(['operator']);
		$this->crud->setColumns(['message']);
        $this->crud->addField([
		'name' => 'operator',
		'label' => "Operator"
		]);
    }

	public function store(StoreRequest $request)
	{
		return parent::storeCrud();
	}

	public function update(UpdateRequest $request)
	{
		return parent::updateCrud();
	}
}