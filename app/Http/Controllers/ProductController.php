<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
public function index(Request $request)
{
    $search = $request->search;

    $products = Product::when($search, function ($query, $search) {
        return $query->where('name', 'like', '%' . $search . '%');
    })->paginate(5);

    return view('products.index', compact('products', 'search'));
}
    public function create()
    {
        return view('products.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

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
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    $product = Product::find($id);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
    }

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

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}
}