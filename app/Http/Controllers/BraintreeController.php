<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BraintreeController extends Controller
{
    public $gateway;

    public function __construct($gateway) 
    {
        $this->gateway = $gateway;
    }

    public static function transaction() 
    {
        //
    }
}
