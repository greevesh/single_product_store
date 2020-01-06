<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Gloudemans\Shoppingcart\Facades\Cart;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:5',
            'email' => 'required|min:10',
            'address' => 'required|min:10',
            'address2',
            'country' => 'required',
            'postcode' => 'required',
            'card-name' => 'required'
        ]);

        // storing Stripe data
        $stripe = new Stripe();
        $stripe = Stripe::make('sk_test_IkkC8sO6532nzHtuCLayswle00ny0pBcZ4');

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Thank you for your purchase.',
                'receipt_email' => $request->email,
                'metadata' => [
                    'quantity' => Cart::count(),
                ],
            ]);

            $customer = $stripe->customers()->create(['email' => $request->email]);

            Cart::destroy();

            Mail::send(new OrderConfirmed);

            return redirect()->route('confirmation')
            ->with('paymentSuccessMessage', 'Thank you! Your payment has been accepted.
                   Please check your inbox for a confirmation email.');

        } 
            catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
