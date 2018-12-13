<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Product $products)
    {
        $products = $products->all();
        //dd($products);
        return view('shop.index', compact('products'));
    }

}
