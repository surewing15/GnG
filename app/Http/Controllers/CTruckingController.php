<?php

namespace App\Http\Controllers;

use App\Models\TruckModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CTruckingController extends Controller
{
    public function index()
    {
        return view('cashier.pages.trucking.index');
    }

    public function create()
    {
        return view('cashier.pages.trucking.create');
    }

    // public function store(Request $request)
    // {
    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'truck_driver' => 'required|string|max:255',
    //         'truck_helper' => 'nullable|string|max:255',
    //         'cus_name' => 'required|string|max:255',
    //         'truck_destination' => 'required|string|max:255',
    //         'truck_allowance' => 'required|numeric|min:0',
    //         'total_price' => 'required|numeric|min:0',
    //         'total_kilo' => 'required|numeric|min:0',
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }

    //     // Store the data
    //     TruckModel::create([
    //         'truck_driver' => $request->truck_driver,
    //         'truck_helper' => $request->truck_helper,
    //         'cus_name' => $request->cus_name,
    //         'truck_destination' => $request->truck_destination,
    //         'truck_allowance' => $request->truck_allowance,
    //         'total_price' => $request->total_price,
    //         'total_kilo' => $request->total_kilo,
    //     ]);

    //     return redirect()->route('cashier.pages.trucking.index')->with('success', 'Truck record created successfully');
    // }
}
