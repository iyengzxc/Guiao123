<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.dashboard');
    }
    public function dashboard()
{
    $categories = Category::all(); // Fetch all categories

    return view('customer.dashboard', [
        'categories' => $categories,
    ]);
}

public function checkout()
    {
        $cart = CartItem::where('user_id', auth()->id())->get();
        return view('checkout.index', compact('cart'));
    }

public function categ()
{
    $categories = Category::all();

    return view('products.index', [
        'categories' => $categories,
    ]);
}

public function buyNow($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->withErrors('Product not found.');
        }

        if ($product->stock <= 0) {
            return redirect()->back()->withErrors('Product out of stock.');
        }

        // Reduce the product stock by 1
        $product->stock -= 1;
        $product->save();

        // Create an order
        $order = Order::create([
            'product_id' => $product->id,
            'quantity' => 1,
            'total_price' => $product->price,
        ]);

        return redirect()->route('products')->with('success', 'Product purchased successfully!');
    }

    public function processCheckout(Request $request)
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('checkout')->withErrors('Your cart is empty.');
        }

        // Create a new order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
            'status' => 'pending'
        ]);

        // Create order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            // Reduce the product stock
            $item->product->stock -= $item->quantity;
            $item->product->save();
        }

        // Clear the cart
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('products.index')->with('success', 'Order placed successfully!');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return view('customer.dashboard', compact('products'));
    }
    public function dashboards()
    {
        // Fetch all products
        $products = Product::all();

        // Pass products to the view
        return view('customer.dashboard', compact('products'));
    }
}
