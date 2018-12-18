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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        /** @var Product $product */
        $product = new Product();

        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->image = '';

        $product->save();

        $lastId = $product->id;

        $file = $request->file('image');
        $fileName = $lastId . '.' . $file->getClientOriginalExtension();

        $file->storeAs('images', $fileName);

        $product->newQuery()
            ->where('id', $lastId)
            ->update([
                'image' => $fileName
            ]);

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
        return view('products.create', compact('product'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        //dd($request->file('image'));

        $file = $request->file('image');
        $fileName = $product->id . '.' . $file->getClientOriginalExtension();

        $file->storeAs('images', $fileName);

        $product->newQuery()
            ->where('id', $product->getKey())
            ->update([
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'image' => $fileName
            ]);

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

        return redirect('/products')->with('success', 'Product has been deleted Successfully');
    }
}
