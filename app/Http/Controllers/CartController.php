<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

class CartController extends Controller
{
    public function store(Request $request)
    {
        Cart::add(
            $request->id, 
            $request->name,
            1,
            $request->price 
            )
        ->associate('App\Product');
    }

    public function update(Request $request, $rowId)
    {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty + 1);
        
        return back()->with('quantityIncreasedMessage', 'Product quantity has been increased.');
    }

    public function decreaseQuantity(Request $request, $rowId)
    {
        $product = Cart::get($rowId);
        Cart::update($rowId, $product->qty - 1);
        
        return back()->with('quantityDecreasedMessage', 'Product quantity has been decreased.');
    }
}
