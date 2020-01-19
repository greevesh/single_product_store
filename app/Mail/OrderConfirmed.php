<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class OrderConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
     
    }

    public function build(Request $request)
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), 'Nuzest')
                    ->to($request->email)
                    ->markdown('emails.orders.email_conf')
                    ->with([
                        'productName' => 'Nuzest Protein Powder',
                        'productPrice' => Cart::total(), 
                        'productQuantity' => Cart::count() 
                    ]);
    }
}
