<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;

class SuperAdminController extends Controller
{

    public function index()
    {
        return view('superadmin.layouts.dashboard');
    }

    public function show()
    {
        $stores = Store::all();
        return view('superadmin.layouts.data-master.store.show', compact('stores'));
    }
}
