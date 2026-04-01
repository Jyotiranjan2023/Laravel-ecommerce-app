<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($id)
    {
        $product = Product::find($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => 1
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart');
    }

    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    public function increase($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    }

    session()->put('cart', $cart);
    return redirect()->back();
}

public function decrease($id)
{
    $cart = session()->get('cart');

    if(isset($cart[$id])) {
        if($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }
    }

    session()->put('cart', $cart);
    return redirect()->back();
}


public function remove($id)
{
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect('/cart');
}

public function checkout()
{
    session()->forget('cart');

    return redirect('/products')->with('success', 'Order placed successfully!');
}


}
