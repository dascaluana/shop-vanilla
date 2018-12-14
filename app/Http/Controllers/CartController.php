<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Order;
use App\Product;
use mysql_xdevapi\Session;

class CartController extends Controller
{
    public function index(Product $products)
    {
        $products = $products
            ->newQuery()
            ->whereIn('id',session()->get('id') ?: [0])
            ->get();

        return view('cart.cart', compact('products'));
    }

    public function remove(Product $product)
    {
        $session = session()->get('id');

        foreach ($session as $key => $value) {
            if ($value == $product->id) {
                session()->forget('id.' . $key);
                break;
            }
        }

        return back();
    }

    public function checkout()
    {
        $data = request(['name', 'email', 'comments']);

        /** @var Order $order */
        $order =  Order::create($data);

        $order->products()->sync(session()->get('id'));

        //dd($order->load('products'));
        \Mail::to(config('app.admin_email'))->send(new OrderCreated($order));

        session()->forget('id');

        return redirect('/cart');
    }
}
