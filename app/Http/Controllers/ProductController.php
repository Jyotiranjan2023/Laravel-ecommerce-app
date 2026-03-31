<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

   public function store(Request $request)
{
    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect('/products')->with('success', 'Product added successfully');
}


    public function edit($id)
{
    $product = Product::find($id);
    return view('products.edit', compact('product'));
}

public function update(Request $request, $id)
{
    $product = Product::find($id);

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    return redirect('/products')->with('success', 'Product updated');
}

public function destroy($id)
{
    $product = Product::find($id);
    $product->delete();

    return redirect('/products')->with('success', 'Product deleted');
}
}