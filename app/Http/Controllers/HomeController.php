<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $allProduct = Product::where('status', 1)
            ->inRandomOrder()
            ->take(8)
            ->get();

        $allCategory = Category::all();

        $latestProducts = Product::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();

        $popularProducts = Product::where('status', 1)
            ->with(['store'])
            ->withSum('orderDetails as total_quantity', 'quantity')
            ->orderBy('total_quantity', 'desc')
            ->take(8)
            ->get();

        // Calculate sold quantity for each product
        foreach ($allProduct as $product) {
            $product->sold = $product->orderDetails->sum('quantity');
        }
        foreach ($latestProducts as $product) {
            $product->sold = $product->orderDetails->sum('quantity');
        }
        foreach ($popularProducts as $product) {
            $product->sold = $product->orderDetails->sum('quantity');
        }

        $bestUMKM = Store::where('stores.status', 1)
            ->leftJoin('products', 'stores.id', '=', 'products.store_id')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->select('stores.id', 'stores.user_id', 'stores.store_name', 'stores.logo', 'stores.status', 'stores.created_at', 'stores.updated_at', 'stores.deleted_at', DB::raw('SUM(order_details.quantity) as total_quantity'))
            ->groupBy('stores.id', 'stores.user_id', 'stores.store_name', 'stores.logo', 'stores.status', 'stores.created_at', 'stores.updated_at', 'stores.deleted_at')
            ->orderBy('total_quantity', 'desc')
            ->take(6)
            ->get();

        return compact('allProduct', 'allCategory', 'latestProducts', 'popularProducts', 'bestUMKM');
    }
}
