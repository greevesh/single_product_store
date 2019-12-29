<?php

use Illuminate\Database\Seeder;
use App\Product; 

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Herbalife Protein Powder', 
            'price' => floatval('59.99')
        ]);
    }
}
