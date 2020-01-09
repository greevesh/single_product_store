<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/confirmation', 'confirmation')->name('confirmation');
Route::view('/', 'landing')->name('landing'); 

// enables backend form validation
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); 

// enables product retrieval
Route::get('/', 'ProductController@index')->name('product.index');

// places the product in the cart
Route::post('/', 'CartController@store')->name('cart.store');
