<?php

namespace App\Http\Controllers;

use App\Order;

class OrderController extends Controller
{
    /**
     * @param Order $orders
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function index(Order $orders)
    {
        $orders = $orders
            ->with([
                'products',
            ])
            ->get();

        if (request()->expectsJson()) {
            return $orders;
        }

        return view('order.index', compact('orders'));
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        $order->load('products');

        if (request()->expectsJson()) {
            return $order;
        }
        return view('order.show', compact('order'));
    }
}
