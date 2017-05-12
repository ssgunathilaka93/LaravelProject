<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', function () {
   return view('vendor.backpack.base.auth.login');
});

Route::get('assignment', function () {
   return view('customSajith.assignment');
});

Route::get('form','customSajja\firstController@getView');
