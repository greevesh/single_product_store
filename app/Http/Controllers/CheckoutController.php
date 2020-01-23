<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;

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

        $amount = Cart::total();
        $quantity = Cart::count(); 
        $nonce = $request->tokenizationKey;

        $gateway = new BraintreeController([
            'environment' => env('BT_ENVIRONMENT'),
            'merchantId' => env('BT_MERCHANT_ID'),
            'publicKey' => env('BT_PUBLIC_KEY'),
            'privateKey' => env('BT_PRIVATE_KEY')
        ]);
        
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'quantity' => $quantity,
            'nonce' => $nonce,
            'customerDetails' => [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address, 
                'country' => $request->country,
                'postcode' => $request->postcode
            ],
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        
        if ($result->success || !is_null($result->transaction)) 
        {
            $transaction = $result->transaction;
            return redirect()->route('confirmation')
            ->with('paymentSuccessMessage', 'Thank you! Your payment has been accepted.
                                             A confirmation email has also been sent.');

            Mail::send(new OrderConfirmed);
            Cart::destroy(); 
        } 
        else 
        {
            $errorString = "";
        
            foreach($result->errors->deepAll() as $error) 
            {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
        }
        }
    }
