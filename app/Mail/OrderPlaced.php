<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product; 
    }

    public function build()
    {
        return $this->from('nuzest.harrisongreeves.com')
                    ->view('view.name')
                    ->with([
                        'productName' => $this->product->name,
                        'productPrice' => $this->product->price, 
                        'productQuantity' => Cart::count() 
                    ]);
    }
}
