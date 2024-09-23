<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function profile()
    {
        return view('customer.pages.profile');
    }
}
