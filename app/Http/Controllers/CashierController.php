<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(){

        return view('cashier.pages.pos.pos');
    }

    public function order(){

        return view('cashier.pages.pos.order');
    }
}
