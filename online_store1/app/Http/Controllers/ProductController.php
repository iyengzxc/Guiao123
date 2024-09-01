<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function admin()
    {
        $products = Product::all(); // Fetch all products
        return view('admin.dashboard', compact('products'));
    }

    public function staff()
    {
        $products = Product::all(); // Fetch all products
        return view('staff.dashboard', compact('products'));
    }

    public function customer()
    {
        $products = Product::all(); // Fetch all products
        return view('customer.dashboard', compact('products'));
    }

    public function index()
    {
         $products = Product::all();
         return view('products.index', compact('products'));
    }
    public function home()
{
    $products = Product::all();
    return view('home', compact('products'));
}


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
         // Validate the request
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Store the image in storage/app/public/images
    $imagePath = $request->file('image')->store('images', 'public');

    // Create a new product record
    $product = Product::create([
        'name' => $validatedData['name'],
        'description' => $validatedData['description'],
        'price' => $validatedData['price'],
        'image_url' => $imagePath,
    ]);

    // Redirect back with a success message
    return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::with('category')->find($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());
        return redirect()->route('products.index')
                         ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')
                         ->with('success', 'Product deleted successfully.');
    }
    public function categ()
{
    $categories = Category::all();

    return view('products.index', [
        'categories' => $categories,
    ]);
}

public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return view('customer.dashboard', compact('products'));
    }
    
    public function shows($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}
