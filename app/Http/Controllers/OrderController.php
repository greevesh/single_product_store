<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function confirmOrder(Request $request, Product $order) 
    {
        // only 1 product exists in this app so we just retrieve the only product in the database
        $order = Product::findOrFail(1);  
    }
}
