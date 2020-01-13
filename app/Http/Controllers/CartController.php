<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;

class CartController extends Controller
{
    public function store(Request $request)
    {
        Cart::add(1, 'Nuzest Protein Powder', 1, '59.99')->associate('App\Product');
        
        return redirect()->route('landing')->with('quantityIncreasedMessage', 'Product quantity has been increased.');
    }

    public function decreaseProductQuantity()
    {
        Cart::destroy();
        
        return redirect()->route('landing')->with('quantityDecreasedMessage', 'Product quantity has been decreased.');
    }
}
