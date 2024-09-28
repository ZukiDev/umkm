<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Customer;
use App\Models\SuperAdmin;
use App\Models\Role;
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

        $role = Role::where('id', $user->role_id)->first();

        if ($role->role === 'customer') {
            return view('welcome');
        } elseif ($role->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role->role === 'superAdmin') {
            return redirect('/super-admin/dashboard');
        } else{
            return Redirect('/');
        }
    }
}
