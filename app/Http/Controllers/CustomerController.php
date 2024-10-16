<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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

    public function detailProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('customer.pages.detail-product', compact('product'));
    }

    public function allProduct()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('customer.pages.all-product', compact('products', 'categories'));
    }

    public function cart()
    {
        return view('customer.pages.cart');
    }

    public function checkout()
    {
        return view('customer.pages.checkout');
    }
}
