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

        $products1 = Product::whereIn('id', [1,2,3,4,5])->get()->pluck('id')->toArray();
        $products2 = Product::whereIn('id', [1,3,5,7,8,9,10])->get()->pluck('id')->toArray();
        $products3 = Product::whereIn('id', [11,12,13,14,15])->get()->pluck('id')->toArray();

        Size::first()->products()->attach($products1);
        Size::find(2)->products()->attach($products2);
        Size::find(3)->products()->attach($products3);
        Size::find(4)->products()->attach($products1);
        Size::find(5)->products()->attach($products2);
    }
}
