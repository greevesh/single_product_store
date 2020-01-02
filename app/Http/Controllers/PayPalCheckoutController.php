<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayPalCheckoutController extends Controller
{
    public function store(Request $request)
    {
        // sends confirmation email to the buyers email address
        Mail::to($request->email)->send(new OrderConfirmed);
    }
}
