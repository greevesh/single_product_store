<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Braintree extends Model
{
    public $gateway = [
        'environment' => 'sandbox',
        'merchantId' => '7x6bffskqkpyhp6g',
        'publicKey' => 'bgfjdhhntchd53rb',
        'privateKey' => '151eca81838963e10f3e5c518634d31e'
    ];  
}
