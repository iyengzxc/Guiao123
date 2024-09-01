<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
{
    public function placeOrder(Product $product)
    {
        // Create a new order with the given product
        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'quantity' => 1, // Assuming a default quantity of 1 for simplicity
            'total_price' => $product->price,
        ]);

        // Redirect to the order summary page
        return redirect()->route('order.show', $order->id);
    }

    public function showOrder(Order $order)
    {
        // Ensure the user is authorized to view the order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('order.show', compact('order'));
    }
}
