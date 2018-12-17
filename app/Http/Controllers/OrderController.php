<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    public function index(Order $orders)
    {
        $orders = $orders->get();

        return view('order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $products = $order->products();

        //dd($products);
        return view('order.view', compact('products'));
    }
}
