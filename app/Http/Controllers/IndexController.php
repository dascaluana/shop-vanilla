<?php

namespace App\Http\Controllers;

use App\Product;

class IndexController extends Controller
{
    /**
     * @param Product $products
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Product $products)
    {
        $query = $products->newQuery();

        if ($ids = session()->get('id')) {
            $query->whereNotIn('id', $ids);
        }

        $products = $query->get();

        return view('shop.index', compact('products'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Product $product)
    {
        request()->session()->push('id', $product->getKey());

        return back();
    }
}
