<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // prevents the seeder from trying to seed 'updated at' or 'created at' columns that
    // don't exist in the table 
    public $timestamps = false;
}
