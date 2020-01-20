<?php

Route::view('/', 'landing')->name('landing'); 
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/confirmation', 'confirmation')->name('confirmation');

// enables backend form validation
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); 

// places the product in the cart
Route::post('/', 'CartController@store')->name('cart.store'); 
