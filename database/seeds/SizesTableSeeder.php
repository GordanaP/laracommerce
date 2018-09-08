<?php

use App\Product;
use App\Size;
use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
            'extra small' => 'XS',
            'small' => 'S',
            'medium' => 'M',
            'large' => 'L',
            'extra large' => 'XL',
        ];

        foreach ($sizes as $name => $code)
        {
            factory('App\Size')->create([
                'name' => $name,
                'code' => $code,
            ]);
        }
    }
}
