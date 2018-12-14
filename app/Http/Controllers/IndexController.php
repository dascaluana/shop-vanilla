<?php

namespace App\Http\Controllers;

use App\Product;

class IndexController extends Controller
{
    public function index(Product $products)
    {
        $query = $products->newQuery();

        if ($ids = session()->get('id')) {
            $query->whereNotIn('id', $ids);
        }

        $products = $query->get();

//        dd(session()->get('id'));
        return view('shop.index', compact('products'));
    }

    public function add(Product $product)
    {
        request()->session()->push('id', $product->getKey());

        return back();
    }
}
