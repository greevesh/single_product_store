<?php

Route::get('/checkout', function() {
    $gateway = new Braintree\Gateway([
        'environment' => env('BT_ENVIRONMENT'),
        'merchantId' => env('BT_MERCHANT_ID'),
        'publicKey' => env('BT_PUBLIC_KEY'),
        'privateKey' => env('BT_PRIVATE_KEY')
    ]);

    return view('checkout'); 
})->name('checkout');

Route::view('/', 'landing')->name('landing'); 
Route::view('/confirmation', 'confirmation')->name('confirmation');

// enables backend form validation
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); 

// places the product in the cart
Route::post('/', 'CartController@store')->name('cart.store'); 
