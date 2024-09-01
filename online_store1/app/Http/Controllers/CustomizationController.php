<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Customization;

class CustomizationController extends Controller
{
    public function creates($productId)
    {
        $product = Product::findOrFail($productId);
        return view('customization.customize', compact('product'));
    }

    public function stores(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        Customization::create([
            'product_id' => $productId,
            'customization_option' => $request->customization_option,
            'customization_value' => $request->customization_value,
        ]);

        return redirect()->route('cart.index')->with('success', 'Product customized successfully!');
    }

    public function create($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return view('customization.create', compact('product'));
    }

    public function store(Request $request, $id)
    {
        // Validate and save the customized product data

        return redirect()->route('cart.cart')->with('success', 'Product customized successfully.');
    }
}