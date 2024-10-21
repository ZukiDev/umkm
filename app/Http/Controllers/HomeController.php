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
        $data = $this->getData();

        if ($user == null) {
            return view('welcome', $data);
        }

        $role = Role::where('id', $user->role_id)->first();

        if ($role->role === 'customer') {
            return view('welcome', $data);
        } elseif ($role->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($role->role === 'superAdmin') {
            return redirect('/super-admin/dashboard');
        } else {
            return Redirect('/');
        }
    }

    private function getData()
    {
        $allProduct = Product::inRandomOrder()->get();
        $allCategory = Category::all();
        $latestProducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        $popularProducts = Product::orderBy('created_at', 'desc')->take(10)->get();
        $bestUMKM = Store::orderBy('created_at', 'desc')->take(6)->get();

        return compact('allProduct', 'allCategory', 'latestProducts', 'popularProducts', 'bestUMKM');
    }
}
