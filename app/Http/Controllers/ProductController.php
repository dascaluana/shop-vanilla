<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->get();

        if (request()->expectsJson()) {
            return $products;
        }
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    public function save(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->price = $request->get('price');

        if ($request->file('image')) {
            $product->image = '';
        }

        $product->save();

        $file = $request->file('image');

        if ($file) {
            $fileName = $product->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images', $fileName);
            $product->image = $fileName;
        }

        $product->save();

        return $product;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product = $this->save($request, $product);

        if (request()->expectsJson()) {
            return $product;
        }

        return redirect('products')->with('success', 'Product has been added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if (request()->expectsJson()) {
            return $product;
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->find($product->id);

        return view('products.edit', compact('product', $product->id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product = $this->save($request, $product);

        if (request()->expectsJson()) {
            return  $product;
        }

        return redirect('/products')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();

        if (request()->expectsJson()) {
            return $product;
        }

        return redirect('/products')->with('success', 'Product has been deleted Successfully');
    }
}
