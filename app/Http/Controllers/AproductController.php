<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AproductController extends Controller
{
    public function index(){

        return view('admin.pages.product.index');
    }
}
