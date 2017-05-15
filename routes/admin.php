<?php

// Backpack\CRUD: Define the resources for the entities you want to CRUD.
CRUD::resource('tag', 'tagCrudController');

CRUD::resource('message', 'messageCrudController');

CRUD::resource('audit', 'auditCrudController');

CRUD::resource('transaction', 'transactionCrudController');