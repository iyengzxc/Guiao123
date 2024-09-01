<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cartItem = CartItem::where('user_id', auth()->id())
                            ->where('product_id', $product->id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.view')->with('success', 'Product added to cart.');
    }

    public function viewCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        return view('cart.cart', ['cart' => $cartItems]);
    }

    public function removeFromCart($id)
    {
        CartItem::where('user_id', auth()->id())->where('product_id', $id)->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart.');
    }

    

    public function updateCart(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        foreach ($request->quantities as $productId => $quantity) {
            $cartItem = CartItem::where('user_id', auth()->id())
                                ->where('product_id', $productId)
                                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        return response()->json(['success' => true]);
    }
    public function update(Request $request)
{
    $quantities = $request->input('quantities');

    foreach ($quantities as $productId => $quantity) {
        $cartItem = CartItem::where('product_id', $productId)->first();
        if ($cartItem) {
            $cartItem->quantity = $quantity;
            $cartItem->save();
        }
    }

    return response()->json(['success' => true]);
}

public function checkout(Request $request)
    {
        // Retrieve selected products from the request
        $selectedProducts = $request->input('selected_products', []);

        // Validate that at least one product is selected
        if (empty($selectedProducts)) {
            return redirect()->back()->with('error', 'Please select at least one product to checkout.');
        }

        // Process the checkout for the selected products
        // Implement your checkout logic here (e.g., payment processing, order creation, etc.)

        return redirect()->route('thank-you')->with('success', 'Order placed successfully!');
    }

    public function add(Request $request, $id)
    {
        // Your logic to add the product to the cart
        $product = Product::find($id);
        if ($product) {
            CartItem::add($product);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    public function remove(Request $request, $id)
    {
        // Your logic to remove the product from the cart
        CartItem::remove($id);
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }
    public function saveCustomization(Request $request)
{
    // Validate the form data if necessary
    $validatedData = $request->validate([
        'product_id' => 'required|exists:products,id',
        // Add more validation rules as needed
    ]);

    // Logic to save customization (example)
    $product = Product::findOrFail($request->input('product_id'));

    // Save customization logic here

    // Redirect back to a suitable page (example: customer dashboard)
    return redirect()->route('customer.dashboard')->with('success', 'Customization saved successfully!');
}
}
