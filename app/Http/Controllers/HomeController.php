<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $allProduct = Product::all();
        $allCategory = Category::all();
        // $newProduct = Product::orderBy('created_at', 'desc')->take(4)->get();
        // $popularProduct = Product::orderBy('sold', 'desc')->take(4)->get();
        $bestUMKM = Store::orderBy('created_by', 'desc')->take(6)->get();

        if ($user == null) {
            return view('welcome', compact('allProduct', 'allCategory', 'bestUMKM'));
        }

        $role = Role::where('id', $user->role_id)->first();

        if ($role->role === 'customer') {
            return view('welcome', compact('allProduct', 'allCategory', 'bestUMKM'));
        } elseif ($role->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role->role === 'superAdmin') {
            return redirect('/super-admin/dashboard');
        } else {
            return Redirect('/');
        }
    }
}
