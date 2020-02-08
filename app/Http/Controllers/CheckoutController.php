<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmed;
use Braintree; 
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CheckoutController extends Controller
{
    public function index()
    {
        $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
        ]);

        $paypalToken = $gateway->clientToken()->generate();
        // try {
        //     $result = $gateway->paymentMethodNonce()->create();
        //     $nonce = $result->paymentMethodNonce->nonce;
        // } 
        // catch(Braintree_Exception_NotFound $e)
        // {
        //     echo $e->getMessage();
        // }

        return view('checkout', compact('paypalToken'));
    }

    public function store(Request $request)
    {
        // request()->validate([
        //     'name' => 'required|min:5',
        //     'email' => 'required|min:10',
        //     'address' => 'required|min:10',
        //     'address2',
        //     'country' => 'required',
        //     'postcode' => 'required',
        //     'card-name' => 'required'
        // ]);

        // instantiating Stripe
        $stripe = new Stripe();
        // creating the secret key
        $stripe = Stripe::make(config('services.stripe.secret'));

        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::total(),
                'currency' => 'GBP',
                'source' => $request->stripeToken,
                'description' => 'Thank you for your purchase.',
                'receipt_email' => $request->email,
                'metadata' => [
                    'Quantity' => Cart::count(),
                    'Name' => $request->name,
                    'Email' => $request->email,
                    'Address' => $request->address, 
                    'Country' => $request->country,
                    'Postcode' => $request->postcode
                ],
            ]);

            $customer = $stripe->customers()->create(['email' => $request->email]);

            Cart::destroy();

            return redirect()->route('confirmation')
            ->with('paymentSuccessMessage', 'Thank you! Your payment has been accepted.');

        } 
            catch (CardErrorException $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function paypal(Request $request)
    {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
            ]); 

        $amount = Cart::total();
        $nonce = $request->nonce; 

        // dd($nonce);
        
        $result = $gateway->transaction()->sale([
            'amount' => $amount, 
            'nonce' => $nonce,         
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        
        if ($result->success or !is_null($result->transaction)) 
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

            return $errorString;
        }
        }
    }