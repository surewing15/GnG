<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcustomerController extends Controller
{
  public function index(){
    return view('admin.pages.customer.index');
  }


  public function edit(){
    return view('admin.pages.customer.edit');
  }
}
