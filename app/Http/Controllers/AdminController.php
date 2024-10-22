<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure the User model is correctly imported
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) // Use Auth::check() to see if a user is authenticated
        {
            $user_type = Auth::user()->usertype; // Get the user type

            if ($user_type == 'admin') {
                return view('admin.index');
            }
            else if ($user_type == 'user') {
                return view('user.index');
            }
            else if ($user_type == 'clerk') {
                return view('clerk.index'); // Assuming there's a clerk.index view
            }
            else {
                return redirect('/')->with('error', 'Unauthorized access');
            }
        }
        else {
            return redirect('/login')->with('error', 'Please log in first');
        }
    }
}
