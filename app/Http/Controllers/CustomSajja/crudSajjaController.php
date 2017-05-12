<?php

namespace App\Http\Controllers\customSajja;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class firstController extends Controller
{
    //
	 public function __construct(){
      //$this->middleware('auth');
	}
	
	public function getView(){
		//$this->view('customSajith.assignment');
		return view('customSajith.assignment');
	}
	
}
