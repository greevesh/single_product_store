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

Route::view('/', 'landing')->name('landing');
Route::view('/checkout', 'checkout')->name('checkout');
Route::view('/confirmation', 'confirmation')->name('confirmation');

// enables backend form validation
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store'); 

// enables product retrieval
Route::get('/', 'ProductController@index')->name('product.index');

// increases product quantity in the cart
Route::post('/', 'CartController@store')->name('cart.store');

// decreases product quantity in the cart
Route::patch('/{rowId}', 'CartController@update')->name('cart.update'); 
