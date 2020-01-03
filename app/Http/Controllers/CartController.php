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

        return back()->with('quantityIncreasedMessage', 'Quantity has been increased.'); 

        // storing Stripe data
        $stripe = new Stripe();
        $stripe = Stripe::make('sk_test_IkkC8sO6532nzHtuCLayswle00ny0pBcZ4');

        try {
            $charge = Stripe::charges()->create([
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
