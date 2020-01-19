<?php

Route::view('/home', 'landing')->name('landing'); 
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/confirmation', 'confirmation')->name('confirmation');

// enables backend form validation
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); 

// enables product retrieval
Route::get('/', 'ProductController@index')->name('product.index');

// places the product in the cart
Route::post('/', 'CartController@store')->name('cart.store'); 
