<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\SuperAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user == null) {
            return view('welcome');
        }

        $customer = Customer::where('user_id', $user->id)->first();
        if ($customer != null) {
            return view('welcome');
        }

        $admin = Admin::where('user_id', $user->id)->first();
        if ($admin != null) {
            return Redirect('/dashboard-admin');
        }

        $superAdmin = SuperAdmin::where('user_id', $user->id)->first();
        if ($superAdmin != null) {
            return Redirect('/dashboard-superadmin');
        }

        // Add a default return statement
        return Redirect('/');
    }
}
