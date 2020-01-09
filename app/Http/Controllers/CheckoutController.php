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
            $charge = $stripe->charges()->create([
                // 'amount' => getNumbers()->get('newTotal') / 100,
                'amount' => Cart::total(),
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Thank you for your purchase.',
                'receipt_email' => $request->email,
                'metadata' => [
                    // 'contents' => $contents,
                    'quantity' => Cart::count(),
                ],
            ]);

            $customer = $stripe->customers()->create(['email' => 'john@doe.com']);

            Cart::destroy();

            return redirect()->route('confirmation')
            ->with('paymentSuccessMessage', 'Thank you! Your payment has been accepted.');

        } 
            catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
}
